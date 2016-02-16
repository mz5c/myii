<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/14
 * Time: 16:12
 */

trait ApiTraitCommon{
    public $_commonApiNameList=array(
        'Login',
        'Logout',
        'Init',
        'SearchIp'
    );

    /**
     * Login
     * @param string $username
     * @param string $password
     * @return string 是否通过
     */
    public function actionLogin() {
        $this->success('success');
    }

    /**
     * Logout
     * @param string $username
     * @param string $password
     * @return string 是否通过
     */
    public function actionLogout() {
        $this->success('success');
    }

    /**
     * Init
     * @param string $username
     * @param string $password
     * @return string 是否通过
     */
    public function actionInit() {
        $this->success('success');
    }

    /**
     * Search Ip
     * @param string $ip
     * @return json
     */
    public function actionSearchIp(){
        $ip = Yii::app()->request->getParam('ip');
        if(!empty($ip) && preg_match('/^((\d|([1-9]\d)|(1\d\d)|(2[0-4]\d)|(25[0-5]))\.){3}(\d|([1-9]\d)|(1\d\d)|(2[0-4]\d)|(25[0-5]))$/',$ip)){
            $res = $this->_apiTestServices->getAreaByIp($ip);
            $this->success(array('ip'=>$ip,'area'=>$res));
        }else{
            $this->error();
        }
    }
}