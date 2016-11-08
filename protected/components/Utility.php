<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/30
 * Time: 14:54
 */
class Utility
{
    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    public static function getRandNum($min=0,$max=255){
        return rand($min,$max);
    }

    /**
     * @return bool
     */
    public static function isMobile() {
        //判断手机发送的客户端标志
        if(isset($_SERVER['HTTP_USER_AGENT'])) {
            //return $_SERVER['HTTP_USER_AGENT'];
            $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
            $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'opera mobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if(preg_match("/(".implode('|',$clientkeywords).")/i",$userAgent)&&strpos($userAgent,'ipad') === false){
                return true;
            }
        }
        return false;
    }

    /**
     * @param $module
     * @param $fc
     * @return string
     */
    public static function getDocumentInfo($module,$fc){
        $func  = new ReflectionMethod($module,$fc);
        $tmp   = $func->getDocComment();
        return $tmp;
    }

    /**
     * @param $str
     * @return string
     */
    public static function getMd5Str($str){
        return md5(Yii::app()->params['uniqueId'].$str);
    }

    public static function jsonOutput($code, $msg, $data = [])
    {
        $params = array(
            'code' => $code,
            'msg'  => $msg,
            'data' => $data
        );
        header('Content-Type:application/json; charset=utf-8');
        //header('Access-Control-Allow-Origin:*');
        echo CJSON::encode($params);
        exit();
    }

    public static function myCurl($url, $data = '')
    {
        $curl_options = array(
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_HEADER          => false,
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_ENCODING        => '',
            CURLOPT_USERAGENT       => '',
            CURLOPT_REFERER         => true,
            CURLOPT_CONNECTTIMEOUT  => 120,
            CURLOPT_TIMEOUT         => 120,
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_POST            => empty($data) ? false : true,
            CURLOPT_POSTFIELDS      => $data,
            CURLOPT_SSL_VERIFYPEER  => false,
            CURLOPT_SSL_VERIFYHOST  => false,
            CURLOPT_VERBOSE         => true,
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $curl_options);
        $content = curl_exec($ch);
        $err     = curl_errno($ch);
        $errmsg  = curl_error($ch);
        $header  = curl_getinfo($ch);
        curl_close($ch);

        $header['errno'] = $err;
        $header['errmsg'] = $errmsg;
        $header['content'] = $content;

        return $header;
    }
}