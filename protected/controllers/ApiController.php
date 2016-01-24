<?php

class ApiController extends Controller
{
	use ApiTraitCommon;
	use ApiTraitTest;

	private $_apiTestServices;

	public function init(){
		$this->_apiTestServices = new ApiTestServices();
		parent::init();
	}

	public function actionIndex()
	{
		//echo Yii::app()->homeUrl;die;
		$this->renderPartial('index',array('he'=>'rico'));
	}

	public function actionDoc(){
		if(!Yii::app()->request->isAjaxRequest){
			$apiList = array(
				'api_common' => $this->_commonApiNameList,
				'api_test' => $this->_testApiNameList,
			);
			$defaultDoc = $this->_apiTestServices->getDocumentInfo('ApiController','actionLogin');
			$homeUrl = Yii::app()->homeUrl;
			$defaultUrl= Yii::app()->request->hostInfo.$homeUrl.'Api/Login';
			$this->renderPartial('doc',array('apiList'=>$apiList,'defaultDoc'=>$defaultDoc,'defaultUrl'=>$defaultUrl));
		}else{
			$method = 'action'.Yii::app()->request->getParam('name');
			$homeUrl = Yii::app()->homeUrl;
			$url = Yii::app()->request->hostInfo.$homeUrl.'Api/'.Yii::app()->request->getParam('name');
			$doc = $this->_apiTestServices->getDocumentInfo('ApiController',$method);
			$params = array();
			preg_match_all("#\\$([a-zA-Z]*)#",$doc,$params);
			echo json_encode(array('url'=>$url,'doc'=>$doc,'parameter'=>$params[1]));
			exit();
		}
	}

	private function success($msg="操作成功！"){
		header('Content-Type:application/json; charset=utf-8');
		echo CJSON::encode(array("status"=>1,"info"=>$msg));
		exit();
	}

	private function error($msg="操作失败！"){
		header('Content-Type:application/json; charset=utf-8');
		echo CJSON::encode(array("status"=>0,"info"=>$msg));
		exit();
	}
}