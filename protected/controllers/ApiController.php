<?php

class ApiController extends Controller
{
	//use ApiTraitCommon;
	//use ApiTraitTest; traits php5.4+

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
			preg_match_all("#\\$([a-zA-Z_]*)#",$doc,$params);
			echo json_encode(array('url'=>$url,'doc'=>$doc,'parameter'=>$params[1]));
			exit();
		}
	}

	/*--------------------------------------------------------------------------------------------------------------------------------*/
	public $_commonApiNameList=array(
		'Login',
		'Logout',
		'Init',
		'SearchIp'
	);

	/**
	 * Login
	 * @param string $username
	 * @param string $password
	 * @return string 是否通过
	 */
	public function actionLogin() {
		$this->success('success');
	}

	/**
	 * Logout
	 * @param string $username
	 * @param string $password
	 * @return string 是否通过
	 */
	public function actionLogout() {
		$this->success('success');
	}

	/**
	 * Init
	 * @param string $username
	 * @param string $password
	 * @return string 是否通过
	 */
	public function actionInit() {
		$this->success('success');
	}

	/**
	 * Search Ip
	 * @param string $ip
	 * @return json
	 */
	public function actionSearchIp(){
		$ip = Yii::app()->request->getParam('ip');
		if(!empty($ip) && preg_match('/^((\d|([1-9]\d)|(1\d\d)|(2[0-4]\d)|(25[0-5]))\.){3}(\d|([1-9]\d)|(1\d\d)|(2[0-4]\d)|(25[0-5]))$/',$ip)){
			$res = $this->_apiTestServices->getAreaByIp($ip);
			$this->success(array('ip'=>$ip,'area'=>$res));
		}else{
			$this->error();
		}
	}
	/*--------------------------------------------------------------------------------------------------------------------------------*/
	public $_testApiNameList=array(
		'GetRandNum',
		'SayHi',
		'Hello',
	);

	/**
	 * GetRandNum
	 * @param $a
	 * @param $b
	 * @return mt_rand(a,b)
	 */
	public function actionGetRandNum() {
		$a = Yii::app()->request->getParam('a');
		$b = Yii::app()->request->getParam('b');
		if(empty($a) || empty($b) || !is_int((int)$a) || !is_int((int)$b) || $a<0 || $b < $a){
			$this->error('invalid params');
		}
		$this->success(mt_rand($a,$b));
	}

	/**
	 * SayHi
	 * @param string $username
	 * @param string $password
	 * @return string 是否通过
	 */
	public function actionSayHi() {
		$field = Yii::app()->request->getParam('field');
		$this->success($field);
	}

	/**
	 * Hello
	 * @param string $username
	 * @param string $password
	 * @return string 是否通过
	 */
	public function actionHello() {
		$this->success('Hello');
	}
	/*--------------------------------------------------------------------------------------------------------------------------------*/

	private function success($msg="操作成功！"){
		header('Content-Type:application/json; charset=utf-8');
		header('Access-Control-Allow-Origin:*');
		echo CJSON::encode(array("status"=>1,"info"=>$msg));
		exit();
	}

	private function error($msg="操作失败！"){
		header('Content-Type:application/json; charset=utf-8');
		header('Access-Control-Allow-Origin:*');
		echo CJSON::encode(array("status"=>0,"info"=>$msg));
		exit();
	}
}