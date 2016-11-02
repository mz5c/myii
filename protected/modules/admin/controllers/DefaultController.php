<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$res = Yii::app()->db->createCommand('select * from tbl_user;')->queryAll();
		$this->render('index',array('data'=>$res));
	}

	public function actionHello($words='hello world'){
		$this->render('hello',array('words' => $words));
	}

	public function actionCallAjax(){
		$words = Yii::app()->request->getParam('words');
		if(!empty($words)){
			echo json_encode(array('errcode'=>'success','res'=>md5($words)));
		}
	}

	public function actionTest(){
		echo $this->id;
		//echo Yii::app()->user->id;
		//echo $this->module->id;
		//echo $this->getModule()->getId();
		//echo $this->id;
		//echo $this->getId();
		//echo $this->action->id;
		//echo $this->getAction()->getId();
		//echo $this->uniqueId;
		//echo $this->getUniqueId();
	}

	public function actionLogin($name='abc',$passwd='123456'){
		$user = new UserIdentity($name,$passwd);
		Yii::app()->user->login($user,5);
		$this->redirect('/admin/default/test');
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect('/admin/default/hello');
	}
}