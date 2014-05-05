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
						$contentStr = ClassRegistry::init('WxWebchat')->getMsg('subscribe', $keyword, $toUsername);
						$wxData['data'] = $contentStr;
						$resultStr = $this->_getTPL("text", $wxData);
					}
					break;
				default:
					$vars['keyword'] = $this->keyword;
					$wxData = ClassRegistry::init('WxWcdata')->getMsg("keyword", $this->webchat, $vars);
					$resultStr = $this->_getTPL($wxData['type'], $wxData);
			}
		} else {
			$returnStr = "亲，您的账号还没有配置成功。［CakeWX］";
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
