<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		if(Utility::isMobile()){
			echo 'yes';die;
		}
		$this->render('index');
	}

	public function actionLogin($user_name='abc',$passwd='123456'){
		$user = new UserIdentity($user_name,$passwd);
		Yii::app()->user->login($user,5);
		$this->redirect('/user/default/index');
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect('/user/default/index');
	}

	public function actionUserDetail(){
		echo Yii::app()->user->id;
	}
}