<?php
App::uses('AppModel', 'Model');
/**
 * TUser Model
 *
 */
class WxWebchat extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'webchat';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'Id';
	
	public $validate = array(
	    'FName' => array(
			'rule' => "alphaNumeric",
			'message' => "必须填写",
			'required' => true
	    ),
		'FWxopenId' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FWxId' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FIcon' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FWxType' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FWxAppId' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FWxAppSecret' => array(
			'rule' => "notEmpty",
			'message' => "必须填写",
			'required' => true
	    ),
		'FAddress' => array(
			'rule' => "alphaNumeric",
			'message' => "必须填写",
			'required' => true
	    )
	);
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function saveWebchat($data, $uid)
	{
		$data['WxWebchat']['Id'] = $this->id ? $this->id : String::uuid();
		if (!$this->id) $data['WxWebchat']['FPerson'] = $uid;
		if (!$this->id) $data['WxWebchat']['FCreatedate'] = date('Y-m-d H:i:s');
		if (!$this->id) $data['WxWebchat']['FOffdate'] = date('Y-m-d H:i:s');
		if (!$this->id) $data['WxWebchat']['FIsActive'] = 1;
		$query = $this->save($data, FALSE);
		if ($query) return $this->id;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function checkWebchat($id, $uid, $type = '')
	{
		$conditions = $type == 'md5' ? array('md5(`Id`)' => $id, 'FPerson' => $uid) : array('Id' => $id, 'FPerson' => $uid);
		$count = $this->find('count', array('conditions' => $conditions, 'recursive' => 0));
		if ($count) return TRUE;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getWebchatList($uid, $id = 'NULL', $type = '')
	{	
		if ($id != 'NULL')
		{
			$conditions = $type == 'md5' ? array('md5(`Id`)' => $id, 'FPerson' => $uid) : array('Id' => $id, 'FPerson' => $uid);
			$data = $this->find('first', array('conditions' => $conditions, 'recursive' => 0));
			// $data = isset($data['WxWebchat']) ? $data['WxWebchat'] : '';
		}
		else
		{
			$data['list'] = $this->find('all', array('conditions' => array('FPerson' => $uid), 'order' => "FCreatedate desc", 'recursive' => 0));
			$data['count'] = $this->find('count', array('conditions' => array('FPerson' => $uid), 'recursive' => 0));
			foreach ($data['list'] as $key => &$vals)
			{
				// $vals['WxWebchat']['FIcon'] = 'abc';
			}
			// echo '<pre>';print_r($data);
		}
		return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getTokenInfo($id)
	{
		$data = $this->find('first', array('conditions' => array('md5(`Id`)' => $id), 'recursive' => 0));
		$data = isset($data['WxWebchat']['Id']) ? $data['WxWebchat']: FALSE;
		return $data;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getWxId($openid)
	{
		$data = $this->find('list', array('fields' => array('FWxopenId', 'Id'), 'conditions' => array('FWxopenId' => $openid), 'recursive' => 0));
		return reset($data);
	}
	
	/**
	 * WX_API
	 *
	 * @return void
	 * @author apple
	 **/
	function getMsg($type = 'text', $keywords, $openid)
	{
		$data = $this->find('first', array('conditions' => array('FWxopenId' => $openid), 'recursive' => 0));
		$webchat = isset($data['WxWebchat']['Id']) ? md5($data['WxWebchat']['Id']) : FALSE;
		if ($webchat)
		{
			switch ($type)
			{
				case 'text':
					$content = ClassRegistry::init('WxWcdata')->getMsg('keyword', $webchat, $keywords);
					break;
				case 'subscribe':
					$content = ClassRegistry::init('WxWcdata')->getMsg('subscribe', $webchat);
					break;
				default:
			}
			$content = $content ? $content : 'WX, I Love You!';			// Default Msg
			return $content;
		}
	}
	
	/**
	 * menus
	 *
	 * @return void
	 * @author apple
	 **/
	function getmenus($type = 'vmenu', $id = '', $router = 0)
	{
		$baseURL = Router::url("/admin/wc/{$id}/");
		$menu = array(
			'hmenu' => array(
				"我的工作台" => array(
					'url' => "", 
					'icon' => "icon-desktop", 
					'child' => array(
						'网站信息' => array(
							'url' => Router::url(array('controller' => "admin", 'action' => "wBasic")), 
							'icon' => "icon-double-angle-right",
							'FIsAdmin' => 1
						),
						'基本信息' => array(
							'url' => Router::url(array('controller' => "admin", 'action' => "basic")), 
							'icon' => "icon-double-angle-right",
						),
						'公众账号管理' => array(
							'url' => Router::url(array('controller' => "admin", 'action' => "index")), 
							'icon' => "icon-double-angle-right",
							'action' => array(
								'添加公众账号' => array(
									'url' => Router::url(array('controller' => "admin", 'action' => "webchatAdd")), 
									'icon' => "icon-double-angle-right",
								),
								'编辑公众账号' => array(
									'url' => Router::url(array('controller' => "admin", 'action' => "webchatEdit")), 
									'icon' => "icon-double-angle-right",
								),
							)
						),
						'修改密码' => array(
							'url' => Router::url(array('controller' => "admin", 'action' => "repwd")), 
							'icon' => "icon-double-angle-right"
						)
					),
					'open' => 1,
					'active' => 1
				)
			),
			'vmenu' => array(
				"工作台" => array(
					'url' => "{$baseURL}center",
					'icon' => "icon-dashboard",
					'FIsActive' => 0
				),
				"系统设置" => array(
					'url' => "", 
					'icon' => "icon-desktop", 
					'child' => array(
						'账号设置' => array(
							'url' => "{$baseURL}sAroz", 
							'icon' => "icon-double-angle-right",
						),
						'默认设置' => array(
							'url' => "{$baseURL}bCtg", 
							'icon' => "icon-double-angle-right",
						),
					)
				),
				"自动回复" => array(
					'url' => "", 
					'icon' => "icon-edit", 
					'child' => array(
						'被关注回复' => array(
							'url' => "{$baseURL}bFllow", 
							'icon' => "icon-double-angle-right"
						),
						'无匹配回复' => array(
							'url' => "{$baseURL}bMch",
							'icon' => "icon-double-angle-right"
						),
						'关键字回复' => array(
							'url' => "{$baseURL}bKds",
							'icon' => "icon-double-angle-right"
						),
						'LBS回复' => array(
							'FIsActive' => 0,
							'url' => "{$baseURL}bLbs", 
							'icon' => "icon-double-angle-right"
						)
					)
				),
				"高级设置" => array(
					'url' => "", 
					'icon' => "icon-cogs",
					'child' => array(
						'自定义菜单' => array(
							'url' => "{$baseURL}sMenu", 
							'icon' => "icon-double-angle-right"
						),
						'二维码营销' => array(
							'url' => "{$baseURL}sCode", 
							'icon' => "icon-double-angle-right"
						),
						'语音识别' => array(
							'url' => "{$baseURL}sVoice", 
							'icon' => "icon-double-angle-right"
						),
						'粉丝管理' => array(
							'url' => "{$baseURL}sFans", 
							'icon' => "icon-double-angle-right"
						),
						'微客服' => array(
							'url' => "{$baseURL}sCuts", 
							'icon' => "icon-double-angle-right"
						)
					),
					'FIsActive' => 0
				),
				"素材库" => array(
					'url' => "", 
					'icon' => "icon-picture",
					'child' => array(
						'文本' => array(
							'url' => "{$baseURL}mTxt", 
							'icon' => "icon-double-angle-right",
							'FIsActive' => 0
						),
						'图文' => array(
							'url' => "{$baseURL}mPic", 
							'icon' => "icon-double-angle-right"
						),
						'图片' => array(
							'url' => "{$baseURL}mPic", 
							'icon' => "icon-double-angle-right",
							'FIsActive' => 0
						),
						'语音' => array(
							'url' => "{$baseURL}mPic", 
							'icon' => "icon-double-angle-right",
							'FIsActive' => 0
						),
						'图文集' => array(
							'url' => "{$baseURL}mPicGary", 
							'icon' => "icon-double-angle-right",
							'FIsActive' => 0
						),
						'幻灯片' => array(
							'url' => "{$baseURL}mSlide", 
							'icon' => "icon-double-angle-right",
							'FIsActive' => 0
						),
						'多媒体文件' => array(
							'url' => "{$baseURL}mFile", 
							'icon' => "icon-double-angle-right",
							'FIsActive' => 0
						)
					)
				),
				"自定义菜单" => array(
					'url' => "", 
					'icon' => "icon-list",
					'child' => array(
						'菜单设置' => array(
							'url' => "{$baseURL}mFields", 
							'icon' => "icon-double-angle-right"
						)
					)
				),
				"互动应用" => array(
					'url' => "", 
					'icon' => "icon-hdd",
					'FIsActive' => 0,
					'child' => array(
						'智能机器人' => array(
							'url' => "{$baseURL}hRobot",
							'icon' => "icon-double-angle-right"
						),
						'应用中心' => array(
							'url' => "{$baseURL}hApp",
							'icon' => "icon-double-angle-right"
						)
					)
				),
				"统计" => array(
					'url' => "", 
					'icon' => "icon-list-alt",
					'child' => array(
						'用户分析' => array(
							'url' => "{$baseURL}sUser", 
							'icon' => "icon-double-angle-right"
						),
						'消息分析' => array(
							'url' => "{$baseURL}sMsg", 
							'icon' => "icon-double-angle-right"
						),
						'图文分析' => array(
							'url' => "{$baseURL}sImtxt", 
							'icon' => "icon-double-angle-right"
						)
					),
					'FIsActive' => 0
				),
				"我的APP" => array(
					'url' => "", 
					'icon' => "icon-laptop",
					'child' => array(
						'APP设置' => array(
							'url' => "{$baseURL}aSet", 
							'icon' => "icon-double-angle-right"
						),
						'应用模板' => array(
							'url' => "{$baseURL}aLayout", 
							'icon' => "icon-double-angle-right"
						),
						'自定义模块' => array(
							'url' => "{$baseURL}aMods", 
							'icon' => "icon-double-angle-right"
						),
						'DIY界面' => array(
							'url' => "{$baseURL}aDiyAps", 
							'icon' => "icon-double-angle-right"
						),
						'绑定域名' => array(
							'url' => "{$baseURL}aDomain", 
							'icon' => "icon-double-angle-right"
						),
						'第三方组件' => array(
							'url' => "{$baseURL}aCmet", 
							'icon' => "icon-double-angle-right"
						),
					),
					'FIsActive' => 0
				)
			)
		);
		
		
		$view = new View();
		$main = $view->loadHelper('Main');
		$vmenu = $main->menuSearch($menu[$type], $type, $router);
		return $vmenu;
	}
}
