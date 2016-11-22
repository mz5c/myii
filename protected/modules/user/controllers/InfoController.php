<?php

class InfoController extends Controller
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

    public function actionEdit()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if (Yii::app()->request->isAjaxRequest) {
            $user_sex = Yii::app()->request->getParam('user_sex');
            $user_email = Yii::app()->request->getParam('user_email');
            $nick_name = Yii::app()->request->getParam('nick_name');
            if (!in_array($user_sex, array(0, 1, 2))) {
                Utility::jsonOutput(-1, Langs::FAILED);
            }
            $user->sex = $user_sex;
            $user->email = $user_email;
            $user->nick_name = $nick_name;
			$user->modify_time = date('Y-m-d H:i:s');
            if ($user->save()) {
                Utility::jsonOutput(200, Langs::SUCCESS);
            }
            Utility::jsonOutput(-1, Langs::FAILED);
        }
        $this->render('edit', array('user' => $user));
    }
}
