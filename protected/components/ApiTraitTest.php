<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/14
 * Time: 16:12
 */

trait ApiTraitTest{
    public $_testApiNameList=array(
        'GetRandNum',
        'SayHi',
        'Hello',
    );

    /**
     * GetRandNum
     * @param $a
     * @param $b
     * @return mt_rand(a,b)
     */
    public function actionGetRandNum() {
        $a = Yii::app()->request->getParam('a');
        $b = Yii::app()->request->getParam('b');
        if(empty($a) || empty($b) || !is_int((int)$a) || !is_int((int)$b) || $a<0 || $b < $a){
            $this->error('invalid params');
        }
        $this->success(mt_rand($a,$b));
    }

    /**
     * SayHi
     * @param string $username
     * @param string $password
     * @return string 是否通过
     */
    public function actionSayHi() {
        $field = Yii::app()->request->getParam('field');
        $this->success($field);
    }

    /**
     * Hello
     * @param string $username
     * @param string $password
     * @return string 是否通过
     */
    public function actionHello() {
        $this->success('Hello');
    }
}