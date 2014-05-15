<?php
App::uses('AppController', 'Controller');
/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class WxapiController extends AppController {
	
	public $layout = "default";
	public $components = array('RequestHandler');
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->loadModel('TPerson');
		$this->loadModel('WxReply');
		$this->loadModel('WxSession');
		
		// Debug API
		$this->_debug();
	}
	
	/**
	 * Debug..
	 *
	 * @return void
	 * @author apple
	 **/
	function _debug() {
		// $wxid = $this->WxWebchat->getWxId("gh_552dce125e18");
		// $this->loadModel('WxSession');
		// 	
		// 	$this->WxSession->write('5320ba72-3d7c-44cf-8d7b-01b1352441c2', 'RWX.APPIDd', '564');
			// $this->WxSession->setWxId('5320ba72-3d7c-44cf-8d7b-01b1352441c2');
			// $this->WxSession->write('RWX.APPID', '23232');
			// $this->WxSession->write('RWX.APPID', '123222222222');exit;
			// $this->WxSession->delete('RWX.APPID');
	
		// $str = $this->WxWcdata->getMsg('lnbook55');
		// echo $str;exit;
		// $contentStr = $this->WxWebchat->getMsg('text', "0dfdf", 'gh_552dce125e18');
		// $postObj = "";
		// $this->WxReply->webchat = md5("5320c144-0264-405b-9611-01b4352441c2");
		// $this->WxReply->msgType = "news";
		// $this->WxReply->keyword = "sdfaaaa";
		// echo $this->WxReply->getReply($postObj); exit;
		// 	echo $c// ontentStr;exit;
		// 				// 
		// 				$this->loadModel('WxDataTw');
		// 				$this->WxDataTw->getMsg(array('5347ae1a-7a70-427d-8793-7ae3352441c2'));exit;
	}
	
	/**
	 * undocumented function
	 *
	 * @param string $id 
	 * @return void
	 * @author apple
	 */
	public function index($id) {
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)) {
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$returnStr = $this->WxReply->getReply($postObj);  
			echo $returnStr;
		} else {
			$this->WxReply->wx_valid();
		}	
		exit;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	public function add() {
		if ($this->TPerson->validates()) {
			$pdata = $this->request->data['TPerson']; 
			$pdata = $this->arrayToObject($pdata);
			$edata = $this->request->data['TEducation'];
			$edata = $this->arrayToObject($edata);
			$uid = $this->TPerson->addPerson();
			$query = $this->TPerson->saveAndEduInfo($uid, $pdata, $edata, 1);
			if ($query) {
				$wx_avatar = file_get_contents($pdata->wx_avatar);
				$isAvatar = ClassRegistry::init('TPersonIcon')->addAvatar($uid, $wx_avatar);
				if ($isAvatar) {
					// 推送到又拍云
					$upyun = new Upcdn();
					$upyun->wtImage("{$uid}.jpg", $wx_avatar, 'avatar');
				}
				$user = $this->TPerson->getUserInfo($uid);
				$this->set('data', $user);
				$this->render('/Wx/success');
			}
		} else {
			$wx = new Wxauth();
			$data = $wx->getuserinfo();
			$this->set('data', $data);
			$this->render('/Wx/index');
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @param string $e 
	 * @return void
	 * @author apple
	 */
	function arrayToObject($e) {
		if (gettype($e)!='array' ) return;
		foreach ($e as $k => $v) {
			if(gettype($v) =='array' || getType($v) =='object') {
				$e[$k] = (object)arrayToObject($v);
			}	
		}
		return (object)$e;
	}
}
