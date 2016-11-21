<?php

class SetupController extends Controller
{
	public function init()
	{
		$this->layout = '//layouts/user_index';
		if (empty(Yii::app()->user->id)) {
			$this->redirect('/');
		}
	}

	public function actionIndex()
	{
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('index', array('user' => $user));
	}

    //修改密码
    public function actionSetpwd()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $user = User::model()->findByPk(Yii::app()->user->id);
            $origin_pwd = Yii::app()->request->getParam('origin_pwd');
            $new_pwd = Yii::app()->request->getParam('new_pwd');
            $confirm_pwd = Yii::app()->request->getParam('confirm_pwd');
            if ($user->password != Utility::getMd5Str($origin_pwd)) {
                Utility::jsonOutput(-1, Langs::WRONG_PASSWORD);
            }
            if ($new_pwd != $confirm_pwd) {
                Utility::jsonOutput(-1, Langs::PASSWORD_NOT_CONSISTENT);
            }
            $user->password = Utility::getMd5Str($confirm_pwd);
            if ($user->save()) {
                Utility::jsonOutput(200, Langs::SUCCESS);
            }
            Utility::jsonOutput(-1, Langs::FAILED);
        }
    }
}