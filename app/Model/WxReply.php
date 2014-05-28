<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxReply extends AppModel {
	
	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	public $msType = 'text';
	public $useTable = FALSE;
	
	/**
	 * 微信valid
	 *
	 * @return void
	 * @author niancode
	 **/
	function wx_valid()
	{
		$wx = new Wxauth();	
		return $wx->wx_valid();
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author niancode
	 **/
	function saveMenus($webchat, $appid, $appsecret)
	{	
		$wxmus = ClassRegistry::init('WxDataMus');
		$data = $wxmus->getMenuApi($webchat);
		$wx = new Wxauth('liunian', $appid, $appsecret);	
		return $wx->saveMenus($data, 0);		// debug..
	}
	
	/**
	 * 初始化
	 *
	 * @return void
	 * @author apple
	 **/
	function init($xmlData) {
		$this->xmlData = $xmlData;
		$this->fromUsername = $xmlData->FromUserName;
		$this->toUsername = $xmlData->ToUserName;
		$this->keyword = trim($xmlData->Content);
		$this->time = time();
		$this->msType = trim($xmlData->MsgType);
		$this->event = $xmlData->Event;
		$this->eventKey = $xmlData->EventKey;
		$this->webchat = ClassRegistry::init('WxWebchat')->getWxId($this->toUsername);
	}
	
	/**
	 * 自动回复
	 *
	 * @return void
	 * @author apple
	 **/
	function getReply($xmlData) {
		$this->init($xmlData);				// 初始化WX_DATA
		$resultStr = "";
		if ($this->webchat) {
			switch ($this->msType) {
				case 'event':
					if ($this->event == 'subscribe') {
						$vars['keyword'] = $this->keyword;
						$wxData = ClassRegistry::init('WxWebchat')->getMsg('subscribe', $vars, $this->toUsername);
						$resultStr = $this->_getTPL($wxData['type'], $wxData);
					} else if ($this->event == 'CLICK') {
						$vars['keyword'] = $this->eventKey;
						$wxData = ClassRegistry::init('WxWebchat')->getMsg("text", $vars, $this->toUsername);
						$resultStr = $this->_getTPL($wxData['type'], $wxData);
					}
					break;
				default:
					$vars['keyword'] = $this->keyword;
					$wxData = ClassRegistry::init('WxWebchat')->getMsg("text", $vars, $this->toUsername);
					$resultStr = $this->_getTPL($wxData['type'], $wxData);
			}
		} else {
			$resultStr = $this->_getTPL('text', array('data' => "亲，您的账号还没有配置成功。［CakeWX］"));
		}
		return $resultStr;
	}
	
	/**
	 * 获取TPL模板数据
	 *
	 * @return void
	 * @author apple
	 **/
	function _getTPL($msgType = 'text', $data) {
		extract($data, EXTR_PREFIX_ALL, "WX");
		$wxTpl = array(
					'text' => "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<Content><![CDATA[%s]]></Content>
								<FuncFlag>0</FuncFlag>
								</xml>",
					'news' => "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<ArticleCount>%s</ArticleCount>
								<Articles>
								%s
								</Articles>
								</xml>"
				);
		$resultStr = "";
		$wxTpl = $wxTpl[$msgType];
		switch ($msgType) {
			case 'text':
				$resultStr = sprintf($wxTpl, $this->fromUsername, $this->toUsername, $this->time, $msgType, $WX_data);
				break;
			case 'news':
				$WX_suffixTpl = "";
				$WX_itemTpl = "<item>
				<Title><![CDATA[%s]]></Title> 
				<Description><![CDATA[%s]]></Description>
				<PicUrl><![CDATA[%s]]></PicUrl>
				<Url><![CDATA[%s]]></Url>
				</item>";
				foreach ($WX_data['items'] as $key => $vals) {
					$WX_suffixTpl .= sprintf($WX_itemTpl, $vals['Title'], $vals['Description'], $vals['PicUrl'], $vals['Url']);
				}
				$resultStr = sprintf($wxTpl, $this->fromUsername, $this->toUsername, $this->time, $msgType, $WX_data['ArticleCount'], $WX_suffixTpl);
				break;
			default:
		}
		return $resultStr;
	}
}
