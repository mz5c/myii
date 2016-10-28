<?php

class SiteController extends Controller
{
	public function actionIndex()
	{
		return true;
	}

    public function actionError()
    {
        $this->layout = '//layouts/index';
        if ($error=Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionUserDetail(){
		echo Yii::app()->user->id;
		echo '<br>';
		echo Yii::getVersion();
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