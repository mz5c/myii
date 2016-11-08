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
        $page = Yii::app()->request->getParam('page', 1);
        $res = Brief::getList($page, 6, 'uid=' . Yii::app()->user->id);
        $res['page_baseUrl'] = '/user/brief/index';
		$this->render('index', $res);
	}

    public function actionAdd()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $title = Yii::app()->request->getParam('title');
            $content = Yii::app()->request->getParam('content');
            if (empty($title) || empty($content)) {
                Utility::jsonOutput(-1, Langs::PARAM_INCOMPLETE);
            }
            $brief = new Brief();
            $brief->uid = Yii::app()->user->id;
            $brief->bid = date('YmdHis') . Yii::app()->user->id;
            $brief->title = $title;
            $brief->content = $content;
            $brief->create_time = date('Y-m-d H:i:s');
            $brief->modify_time = date('Y-m-d H:i:s');
            if ($brief->save()) {
                Utility::jsonOutput(200, Langs::SUCCESS);
            }
            Utility::jsonOutput(-1, Langs::FAILED);
        }
        $this->render('add');
    }

    public function actionDelete()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $bid = Yii::app()->request->getParam('bid');
            if (empty($bid)) {
                Utility::jsonOutput(-1, Langs::PARAM_INCOMPLETE);
            }
            $brief = Brief::model()->findByAttributes(array('uid' => Yii::app()->user->id, 'bid' => $bid));
            if (empty($brief)) {
                Utility::jsonOutput(-1, Langs::FAILED);
            }
            $brief->status = 0;
            if ($brief->save()) {
                Utility::jsonOutput(200, Langs::SUCCESS);
            }
            Utility::jsonOutput(-1, Langs::FAILED);
        }
    }

    public function actionDetail()
    {
        $bid = Yii::app()->request->getParam('bid');
        $brief = Brief::model()->findByAttributes(array('bid' => $bid, 'uid' => Yii::app()->user->id));
        if (empty($brief)) {
            $this->redirect('/user/brief/index');
        }
        $this->render('detail', array('info' => $brief));
    }

    public function actionEdit()
    {
        $bid = Yii::app()->request->getParam('bid');
        $brief = Brief::model()->findByAttributes(array('bid' => $bid, 'uid' => Yii::app()->user->id));
        if (Yii::app()->request->isAjaxRequest) {
            if (empty($brief)) {
                Utility::jsonOutput(-1, Langs::FAILED);
            }
            $title = Yii::app()->request->getParam('title');
            $content = Yii::app()->request->getParam('content');
            $brief->title = $title;
            $brief->content = $content;
            $brief->modify_time = date('Y-m-d H:i:s');
            if ($brief->save()) {
                Utility::jsonOutput(200, Langs::SUCCESS);
            }
            Utility::jsonOutput(-1, Langs::FAILED);
        }
        if (empty($brief)) {
            $this->redirect('/user/brief/index');
        }
        $this->render('edit', array('info' => $brief));
    }
}