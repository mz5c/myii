<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$res = Yii::app()->db->createCommand('select * from tbl_user;')->queryAll();
		$this->render('index',array('data'=>$res));
	}
}