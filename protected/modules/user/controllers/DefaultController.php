<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->pageTitle = 'user-index';
		$this->layout = '//layouts/index';
		$this->render('index');
	}

	public function actionLogin(){
		$this->layout = '//layouts/index';
		$this->pageTitle = 'login';
		$errmsg = '';
		if(!empty($_POST)){
			$user_info = UserInfo::model()->findByAttributes(array('user_name'=>$_POST['user_name']));
			if(isset($user_info) && $user_info->password == Utility::getMd5Str($_POST['password'])){
				$user = new UserIdentity($_POST['user_name'],$_POST['password']);
				Yii::app()->user->login($user,isset($_POST['remember_me']) ? 5 : 3600);
				$this->redirect('/');
			}else{
				$errmsg = '用户名或密码错误！';
			}
		}
		$this->render('login',array('errmsg'=>$errmsg));
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect('/');
	}

	public function actionUserDetail(){
		$a = '';
		$t = microtime(true);
		for($i = 0;$i<10000;$i++){
			$a .= 'sljkfdddddddddddddddddddddddddddlsdkjflksdjlkfjlskdjflksdjflkjsdlkjflksddddddddddddddddddddd';
		}
		echo microtime(true)-$t;die;
		var_dump(Yii::app()->user->id);
	}

    public function actionQuora(){
        $this->layout = '//layouts/index';
        $this->pageTitle = 'Quora';
        $this->render('quora');
    }
}