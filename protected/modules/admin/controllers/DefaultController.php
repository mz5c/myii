<?php

class DefaultController extends Controller
{
    public function init()
    {
        $this->layout = '//layouts/index';
        if (Yii::app()->user->name != 'admin') {
            $this->redirect('/');
        }
    }

    /*public function beforeAction()
    {
        //echo 'before';
        return true;
    }

    public function afterAction()
    {
        //echo 'after';
        return true;
    }*/

	public function actionIndex()
	{
		$res = Yii::app()->db->createCommand('select * from user;')->queryAll();
		$this->render('index',array('data'=>$res));
	}

	public function actionTest(){
		//echo Yii::app()->user->id;            //用户id
        //echo Yii::app()->user->name;          //用户名
		//echo $this->module->id;               //当前module名
		//echo $this->getModule()->getId();
		//echo $this->id;                       //当前controller名
		//echo $this->getId();
		//echo $this->action->id;               //当前action名
		//echo $this->getAction()->getId();
		//echo $this->uniqueId;                 //当前module/controller
		//echo $this->getUniqueId();
	}
}