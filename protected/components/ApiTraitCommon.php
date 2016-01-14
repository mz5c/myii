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
}