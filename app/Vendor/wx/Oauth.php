<?php
/**
  * wechat php test
  */

//define your token
define("APPID", "wx903c19fcf0626385");
define("APPSECRET", "4f9734b004e3944872f3e72039e3a28f");
define("TOKEN", "ohnuw2oob0Aiweequoh3");

include ("lib/func.php");
include ("lib/curl.php");
$userinfo = array();
$cl = new Curl();
// $code = isset($_GET['code']) ? $_GET['code'] : FALSE;
// $wechatObj = new wechatCallbackapiTest();
// $userinfo = $wechatObj->getUserInfo($aToken, $openId);

// ====================class
class wechatCallbackapiTest
{
	var $token = '';

	public function wx_valid()
	{
		if($this->checkSignature()){
        	$echoStr = $_GET["echostr"];
			echo $echoStr;
        	exit;
        }
	}
	
	public function valid()
    {
        if($this->checkSignature()){
        	return TRUE;
        }
    }

	public function setGloabl($data)
	{
		while (list($key, $vals) = each($data))
		{
			$this->$key = $vals;
		}
	}

	public function getUserInfo()
	{
		$code = isset($_GET['code']) ? $_GET['code'] : FALSE;
		if (!$code) return FALSE;
		$acode = $this->getAccessCode($code);
		$aToken = $acode['access_token'];
		$openId = $acode['openid'];
		if ($aToken && $openId)
		{
			$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$aToken}&openid={$openId}&lang=zh_CN";
			$data = curlData($url);
			return $data;
		}
	}
	
	/**
	 * 菜单功能
	 *
	 * @return void
	 * @author niancode
	 **/
	public function saveMenus($mdata, $debug = 0) {
		$acode = $this->getAccessCode();
		$aToken = $acode['access_token'];
		if ($aToken) {
			$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$aToken}";
			$data = curlData($url, $mdata, 'POST', $debug);
			// print_r($data);
			if ($data['errcode'] == 0) {
				$msg['state'] = 1;
				return $msg;
			} else {
				$msg['state'] = 0;
				$msg['msg'] = "错误：{$data['errcode']}，{$data['errmsg']}";
				return $msg;
			}
		}
	}

	public function getAccessCode()
	{
		$appid = $this->appid;
		$secret = $this->appsecret;
		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$secret}";
		$data = curlData($url);
		return $data;
	}

    public function responseMsg()
    {
		//get post data, May be due to the different environments
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

      	//extract post data
		if (!empty($postStr)){
                
              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty( $keyword ))
                {
					$rsStr = array(
									'流年' => "如花美眷，似水流年。", 
									'ln' => "如花美眷，似水流年。",
									'liunian' => "流年班级录：http://liunian.mobi",
									'校友' => "曾经在同一个学校或研究院、所共同学习、工作过的人。一般指共同学习半年以上才构成校友。校友的别称：同窗。欢迎使用流年班级录：http://liunian.mobi",
									'陈俊年' => "流年班级录：创始人兼产品经理。",
									'李珂' => "流年班级录：创始人兼设计总监。",
									'石秀峰' => "流年班级录：创始人兼技术总监。",
									'小然' => "她是小年的女朋友。"
								);
					$contentStr = $rsStr[$keyword];
					if (!in_array($keyword, array_keys($rsStr)))
					{
						$contentStr = "你好，我是流年小秘书。";
					}
              		$msgType = "text";
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	echo "Input something...";
                }

        }else {
        	echo "";
        	exit;
        }
    }
		
	private function checkSignature()
	{
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];	
        		
		$token = $this->token;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
}

?>