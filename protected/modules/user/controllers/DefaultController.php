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

	public function actionRegister(){
		$this->layout = '//layouts/index';
		$this->pageTitle = 'Register';
		$errmsg = '';
		if(!empty($_POST)){
			$userinfo = UserInfo::model()->findByAttributes(array('user_name'=>$_POST['user_name']));
			if(isset($userinfo)){
				$errmsg = '用户名已存在!';
			}else{
				$userinfo = new UserInfo();
				$userinfo->user_name = $_POST['user_name'];
				$userinfo->password = Utility::getMd5Str($_POST['password']);
				$userinfo->email = 'w11w23c58@126.com';
				$userinfo->create_time = date('Y-m-d H:i:s');
				$userinfo->save();
				$user = new UserIdentity($_POST['user_name'],$_POST['password']);
				Yii::app()->user->login($user,3600);
				$this->redirect('/');
			}
		}
		$this->render('register',array('errmsg'=>$errmsg));
	}

	public function actionGetUserList(){
		$this->layout = '//layouts/index';
		$this->pageTitle = 'user_list';
		$res = Yii::app()->db->createCommand("select id,user_name,email,create_time from myii_user")->queryAll();
		$this->render('user_list',array('data'=>$res));
	}

	public function actionModifyUserInfo(){
		$user_name = Yii::app()->request->getParam('user_name');
		$email = Yii::app()->request->getParam('email');
		if(empty($user_name) || empty($email)){
			echo json_encode(array('status'=>0,'info'=>'参数不能为空'));
			exit();
		}else{
			$userinfo = UserInfo::model()->findByAttributes(array('user_name'=>$user_name));
			if(!isset($userinfo)){
				echo json_encode(array('status'=>0,'info'=>'用户名不存在'));
				exit();
			}else{
				$userinfo->email = $email;
				if($userinfo->save()){
					echo json_encode(array('status'=>1,'info'=>'修改成功'));
					exit();
				}else{
					echo json_encode(array('status'=>0,'info'=>'修改失败'));
					exit();
				}
			}
		}
	}
}