<?php
App::import('Vendor', 'wx/Oauth');
class Wxauth {
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function __construct($token = 'liunian', $appid = null, $appsecret = null)
	{
		$this->wechatObj = new wechatCallbackapiTest();
		$this->wechatObj->setGloabl(array(
						'token' => $token,
						'appid' => $appid,
						'appsecret' => $appsecret
					));
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function wx_valid()
	{
		$this->wechatObj->wx_valid();
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function saveMenus($data, $debug = 0)
	{
		return $this->wechatObj->saveMenus($data, $debug);
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getuserinfo()
	{
		$userinfo = $this->wechatObj->getUserInfo();
		return $userinfo;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function curlStData($url, $params = array(), $type = 'GET', $debug = 0, $options = array())
	{
		return curlData($url, $params, $type, $debug, $options);
	}
	
	function curlData($url, $params = array(), $type = 'GET', $debug = 0, $options = array())
	{
		$fp = fopen($url,'wb'); 
		$options = array("CURLOPT_FILE", $fp);
		$data = curlData($url, $params, $type, $debug, $options);
		fclose($fp);  
		return $data;
	}
}