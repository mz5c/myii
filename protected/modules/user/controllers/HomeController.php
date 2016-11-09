<?php

class HomeController extends Controller
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
        $res = Brief::getList(1, 9, 'uid=' . Yii::app()->user->id);
        $this->render('index', $res);
	}

	public function actionTest()
	{
		$res = Utility::myCurl('https://www.xxx.com/');
        echo '<xmp>';var_dump($res);die;
        echo $res['content'];
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
