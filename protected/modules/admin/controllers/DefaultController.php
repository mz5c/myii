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
}