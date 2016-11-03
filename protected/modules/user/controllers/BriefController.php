<?php

class BriefController extends Controller
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
		$this->render('index');
	}
}