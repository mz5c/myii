<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0x11FFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			//var_dump($error);die;
			//var_dump(Yii::app()->request->isAjaxRequest);die;
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm();
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		/*if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}*/

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionHello($words='hello world'){
		//$this->redirect(array('/site/index'));die;
		//Yii::app()->request->redirect(Yii::app()->createUrl('user'));die;
		/*$words = Yii::app()->request->getParam('words');
		if(!empty($words)){
			echo json_encode(array('errcode'=>'success','res'=>$words));
		}
		if(Yii::app()->request->isAjaxRequest){
			$count = (int)Yii::app()->request->getParam('num');
			$c = new CDbCriteria;
			$c->select = 'aid,title';
			$c->limit = $count;
			$c->order = "create_time DESC";
			$data = Article::model()->findAll($c);
			echo CJSON::encode($data);
		}*/
		$this->render('hello',array('words' => $words));
	}

	public function actionUserDetail(){
		echo Yii::app()->user->id;
		echo '<br>';
		echo Yii::getVersion();
	}

	public function actionCallAjax(){
		$words = Yii::app()->request->getParam('words');
		if(!empty($words)){
			echo json_encode(array('errcode'=>'success','res'=>md5($words)));
		}
	}

	public function actionTestMem(){
		//var_dump($this->isMobile());die;
		$var = Yii::app()->memcache->get('uid');
		if(!$var){
			echo 'none';
			Yii::app()->memcache->set('uid','none_uid',30);
		}else{
			var_dump($var);
			echo 'yes';
		}
	}

	public function isMobile() {
		//判断手机发送的客户端标志
		if(isset($_SERVER['HTTP_USER_AGENT'])) {
			//return $_SERVER['HTTP_USER_AGENT'];
			$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
			$clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel', 'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi', 'opera mobi', 'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile');
			// 从HTTP_USER_AGENT中查找手机浏览器的关键字
			if(preg_match("/(".implode('|',$clientkeywords).")/i",$userAgent)&&strpos($userAgent,'ipad') === false){
				return true;
			}
		}
		return false;
	}
}