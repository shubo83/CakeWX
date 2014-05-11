<?php
App::import('Vendor', 'wx/Oauth');
class Wxauth {
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function __construct($token, $appid = null, $appsecret = null)
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
	function curlStData()
	{
		$url = "http://st.liunian.mobi/status";
		$params = array('url' => Router:url("/"));
		$debug = 1;
		$data = curlData($url, $params, $type, $debug);
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