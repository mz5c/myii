<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/14
 * Time: 16:24
 */

class ApiTestServices extends CComponent{
    public function sayHi(){
        return 'hi';
    }

    /**
     * 获取方法解释说明
     * @param string $module
     * @param string $fc
     * @return string 返回方法解释说明
     */
    public function getDocumentInfo($module,$fc){
        $func  = new ReflectionMethod($module,$fc);
        $tmp   = $func->getDocComment();
        return $tmp;
    }

    public function getAreaByIp($ip){
        $url = 'http://www.ip138.com/ips138.asp?ip='.$ip.'&action=2';
        $res = $this->https_request($url);
        $res = mb_convert_encoding($res, "UTF-8", "GBK");
        $area = array();
        preg_match_all('|<td align="center"><ul class="ul1"><li>本站主数据：([^\r\n]*)</li><li>参考数据|', $res, $area);
        return $area[1][0];
    }

    //https请求（支持GET和POST）
    public function https_request($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}