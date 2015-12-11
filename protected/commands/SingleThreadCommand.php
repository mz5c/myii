<?php
/**
 * basic class for single thread command
 * @author iefreer
 */
class SingleThreadCommand extends CConsoleCommand {
	
	private $_start_time;
	private $_debug_mode = true;

        public function init(){
            self::_isRunning();
            $this->_start_time = microtime(true);

            $logInfo = "Duration: ".(microtime(true) - $this->_start_time)."second(s).\n";
            self::_sLog($logInfo);
        }
	
        public function run($args) {
            //TODO: add your specific task
	}
	
	/**
	 * check if this command is running or not
	 */
	static private function _isRunning() {
            $pidFile = Yii::app()->basePath.'/../assets/'.strtolower(__CLASS__).'.pid';
            $processName = self::_getCurrentCommand();
            
            if (file_exists($pidFile) && $fp = fopen($pidFile, 'rb')) {
                    flock($fp, LOCK_SH);
                    $last_pid = trim(fread($fp, filesize($pidFile)));
                    fclose($fp);

                    if (!empty($last_pid)) {
                            $command = exec("/bin/ps -p $last_pid -o command=");
                            if ($command == $processName) {
                                    die("Sorry, the command has already been running ...\n");
                            }
                    }
            }

            $cur_pid = posix_getpid();
            if ($fp = fopen($pidFile, 'wb')) {	
                    fputs($fp,$cur_pid);
                    ftruncate($fp, strlen($cur_pid));
                    fclose($fp);
            }
	} 
	
	/**
	 * get current command process name
	 */
	static private function _getCurrentCommand() {	
            $pid = posix_getpid();
            $command = exec("/bin/ps -p $pid -o command=");
            return $command;
	}
        
	/**
	 * Write system log
	 * 
	 * @param string $message
	 * @param int $priority
	 * @access private
	 */
	private function _sLog($message, $priority = LOG_NOTICE) {
	    if ($this->_debug_mode) {
	        syslog($priority, __CLASS__ . ': ' . $message . "\n");
	    }
	}

        /**
	 * request external url with get
	 *
	 * @param array $dbtag
	 * @return object
	 */
	public function r($req_url,$req_arr,$secret) {
            $scheme = 'HTTP';
            $method = 'GET';

            $arr_url = parse_url($req_url);
            $host = $arr_url['host'];
            $path = $arr_url['path'];    
	    $params  = http_build_query($req_arr);
	    $message = "{$scheme} {$method} {$path}?{$params}";
	    $digest  = hash_hmac ("sha1", $message, $secret);
	    $req_arr['signature'] = $digest;
	    $request_params = http_build_query($req_arr);
	    $request_uri = $arr_url['scheme'].'://' . $host . ':' . $arr_url['port'] . $path . '?' . $request_params;
	    $timeout = 50;
	    $hCurl = curl_init();
	    $copt = Array (
	        CURLOPT_URL             => $request_uri,
	        CURLOPT_RETURNTRANSFER  => true,
	        CURLOPT_HEADER          => false,
	        CURLOPT_HTTPPROXYTUNNEL => true,
	        CURLOPT_CONNECTTIMEOUT  => $timeout,
	        CURLOPT_TIMEOUT         => $timeout
	    );
	    curl_setopt_array( $hCurl, $copt );
	    $response = curl_exec( $hCurl );
            $http_status = curl_getinfo($hCurl, CURLINFO_HTTP_CODE);
            if($http_status == 403) {
                    self::_sLog('Response from ' . $host . ': signature error');
            }
            if($http_status == 400) {
                    self::_sLog('Response from ' . $host . ': bad request');
            }
	    curl_close( $hCurl );
	    return $response;
	}        
}
