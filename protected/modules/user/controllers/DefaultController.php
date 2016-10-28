<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->pageTitle = 'welcome';
		$this->layout = '//layouts/index';
		$this->render('index');
	}

	public function actionLogin(){
		$this->layout = '//layouts/index';
		$this->pageTitle = '用户登录';
        if (Yii::app()->request->isAjaxRequest) {
            $user_name = Yii::app()->request->getParam('user_name');
            $password  = Yii::app()->request->getParam('password');
            $remember_me = Yii::app()->request->getParam('remember_me');
            $this->validateLogin($user_name, $password, $remember_me);
        }
		$this->render('login');
	}

	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect('/');
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
        die;
		$this->layout = '//layouts/index';
		$this->pageTitle = '用户列表';
		$res = Yii::app()->db->createCommand("select id,user_name,email,create_time from user")->queryAll();
		$this->render('user_list',array('data'=>$res));
	}

	public function actionModifyUserInfo(){
        die;
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

    protected function validateLogin($user_name, $password, $remember_me)
    {
        if (empty($user_name) || empty($password)) {
            Utility::jsonOutput(-1, Langs::PARAM_INCOMPLETE);
        }
        $user = User::model()->findByAttributes(array('user_name' => $user_name));
        if (empty($user)) {
            Utility::jsonOutput(-1, Langs::USER_NOT_EXISTS);
        }
        if ($user->password != Utility::getMd5Str($password)) {
            Utility::jsonOutput(-1, Langs::WRONG_PASSWORD);
        }
        $user_login = new UserIdentity($user->user_name, $user->password);
        Yii::app()->user->login($user_login, $remember_me == 1 ? 7*24*3600 : 3600);
        Utility::jsonOutput(200, Langs::SUCCESS);
    }
}