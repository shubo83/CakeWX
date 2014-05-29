<?php
App::uses('AppController', 'Controller');
/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class AdminController extends AppController {
	
	public $components = array('Paginator');
	public $helpers = array('Array', 'Main', 'Html');
	public $layout = "admin";
	public $paginate = array(
		'maxLimit' => 500,
		'limit' => 10,
		// 'paramType' => 'querystring',
		'order' => array(
			'FCreatedate' => 'desc'
		)
    );
	var $validate = array();
	var $toAccount = 5;
	var $wxId = '';
	var $rdBaseURL = '';
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->loadModel('TPerson');
		$this->loadModel('WxWebchat');
		$this->Auth->deny('index');
		$this->vmenu = $this->WxWebchat->getmenus('hmenu');
	}
	
	public function beforeRender() {
		// Check center
		if ($this->wxId && !$this->WxWebchat->checkWebchat($this->wxId, $this->uid, 'md5')) {
			return $this->redirect(array('action' => "index"));
		}
		$this->set('menutype', $this->wxId ? 'vmenu' : 'hmenu');
		$this->set('wxId', $this->wxId);
		$this->set('vurl', $this->vurl);
		$this->set('vmenu', $this->vmenu);
		$this->set('wxURL', $this->wxAPI);
		$this->set('wxToken', $this->wxToken);
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/

	function wc($id) {
		$this->wxId = $id;
		$this->vmenu = $this->WxWebchat->getmenus('vmenu', $this->wxId);
		$wcdata = $this->WxWebchat->getWebchatList($this->uid, $id, 'md5');
		$wxId = $wcdata['WxWebchat']['Id'];
		$action = $this->request->params['pass'][1];
		$this->rdBaseURL = Router::url("/admin/wc/{$id}/", TRUE);
		$this->rdWcURL = Router::url("/admin/wc/{$id}/{$action}", TRUE);
		$this->wcdata = $wcdata;
		$query['mod'] = isset($this->request->query['_m']) ? $this->request->query['_m'] : '';
		$query['action'] = isset($this->request->query['_a']) ? $this->request->query['_a'] : '';
		$query['id'] = isset($this->request->query['_id']) ? $this->request->query['_id'] : '';
		$query['value'] = isset($this->request->query['_val']) ? $this->request->query['_val'] : '';
		$this->set('WC_BASE', $this->rdBaseURL);
		$this->set('WC_URL', $this->rdWcURL);
		$this->set('WC_query', $query);
		$this->set('WC_data', $wcdata);
		$this->set('WC_wxId', $wxId);
		
		// Check WebchatId
		if (!$wxId) return $this->redirect("/admin");
		
		// Load func
		if (!method_exists($this, "_{$action}")) {
			return $this->redirect("/admin/wc/{$id}/center");
		} else {
			return call_user_func(array($this, "_{$action}"), $id, $query, $wxId);
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function index() {
		$this->loadModel('WxWebchat');
		$this->paginate['limit'] = 5;
		$this->Paginator->settings = $this->paginate;
		$data['datalist'] = $this->Paginator->paginate('WxWebchat', array('FPerson' => $this->uid));
		$data['leavecount'] = $this->toAccount - intval(count($data['datalist']));
		$this->vmenu = $this->WxWebchat->getmenus('hmenu');
		$this->vurl = Router::url(array('controller' => "admin", 'action' => "basic"));
		$this->set('data', $data);
		$this->render('/Admin/webchat');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _center($id) {
		return $this->redirect($this->rdBaseURL.'sAroz');
		$this->render('/Admin/index');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function _sAroz($id, $query, $wxId) {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->WxWebchat->set($this->request->data);
			if ($this->WxWebchat->validates(array('fieldList' => array('FWxType', 'FWxAppId', 'FWxAppSecret')))) {
				$this->WxWebchat->id = $wxId;
				$query = $this->WxWebchat->saveWebchat($this->request->data, $this->uid);
				if ($query) {
					$this->Session->setFlash('操作成功。');
					return $this->redirect($this->rdWcURL);
				}
			} else {
				$rData['WxWebchat']['FWxType']  = $this->request->data['WxWebchat']['FWxType'];
				$this->request->data = $rData;
			}
		} else {
			if (!$this->request->data) {
				$this->request->data = $this->wcdata;
			}
		}
		$this->render('/Admin/sAroz');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function _sLayout() {
		$this->render('/Admin/sLayout');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bCtg($id, $query) {
		$this->loadModel('WxWcdata');
		switch ($query['mod']) {
			case 'follow':
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('FFollowType', 'FFollowContent')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('被关注回复修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
					}
				}
				break;
			case 'mch':
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('FDefaultType', 'FDefaultContent')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('无匹配回复修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data || $this->request->is('put')) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
					}
				}
				break;
			default:
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data || $this->request->is('put')) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
					}
				}
		}
		$this->render('/Admin/bCtg');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bFllow($id, $query) {
		$this->loadModel('WxWcdata');
		switch ($query['action']) {
			default:
				if ($this->request->is('post') || $this->request->is('put')) {
					//print_r($this->request->data);exit;
                    if (isset($this->request->data['WxWcdata']['FTwj'][0])) {
                        $this->request->data['WxWcdata']['FFollowId'] = $this->request->data['WxWcdata']['FTwj'][0];
                    }
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('FFollowType')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('被关注回复修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
						$this->request->data['WxWcdata']['FPreTwj'] = $datalist['WxWcdata']['FFollowId'];
						// echo '<pre>';print_r($this->request->data);exit;
					}
				}
				$this->render('/Admin/bFllow');
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bMch($id, $query) {
		$this->loadModel('WxWcdata');
		switch ($query['action']) {
			default:
				if ($this->request->is('post') || $this->request->is('put')) {
                    if (isset($this->request->data['WxWcdata']['FTwj'][0])) {
                        $this->request->data['WxWcdata']['FDefaultId'] = $this->request->data['WxWcdata']['FTwj'][0];
                    }
					$this->WxWcdata->set($this->request->data);
					if ($this->WxWcdata->validates(array('fieldList' => array('FDefaultType')))) {
						$query = $this->WxWcdata->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('无匹配回复修改成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data || $this->request->is('put')) {
						$datalist = $this->WxWcdata->getDataList($id);
						$this->request->data = $datalist;
						$this->request->data['WxWcdata']['FPreTwj'] = $datalist['WxWcdata']['FDefaultId'];
					}
				}
				$this->set('data', $data);
				$this->render('/Admin/bMch');
		}
		$this->render('/Admin/bMch');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bKds($id, $query) {
		$this->loadModel('WxDataKds');
		switch ($query['action']) {
			case 'add':
				if ($this->request->is('post')) {
					$this->WxDataKds->set($this->request->data);
					if ($this->WxDataKds->validates(array('fieldList' => array('FKey', 'FKeyMacth', 'FType')))) {
						$query = $this->WxDataKds->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('关键字添加成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$this->request->data = array('WxWebchat' => array('FWxApi' => $this->wxAPI, 'FWxToken' => $this->wxToken));
					}
				}
				$this->set('data', $data);
				$this->render('/Admin/_bKeyAdd');
				break;
			case 'edit':
				if (!$this->WxDataKds->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataKds->set($this->request->data);
					if ($this->WxDataKds->validates(array('fieldList' => array('FKey', 'FKeyMacth', 'FType')))) {
						$this->WxDataKds->id = $query['id'];
						$query = $this->WxDataKds->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('关键字编辑成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataKds->getDataList($id, $query['id']);
						$this->request->data = $data;
				    }

				}
				$this->set('data', $data);
				$this->render('/Admin/_bKeyAdd');
				break;
			case 'del':
				if (!$this->WxDataKds->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				} 
				if ($this->WxDataKds->delete($query['id'])) {
					$this->Session->setFlash('微信公众账号删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$data['datalist'] = $this->Paginator->paginate('WxDataKds', array('FWebchat' => $id));
				$this->set('data', $data);
				$this->render('/Admin/bKey');
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bLbs() {
		$this->render('/Admin/bLbs');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _bSvc() {
		$this->render('/Admin/bSvc');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mTxt($id, $query) {
		switch ($query['action']) {
			case 'add':
				$this->loadModel('WxDataWb');
				if ($this->request->is('post')) {
					$this->WxDataWb->set($this->request->data);
					if ($this->WxDataWb->validates()) {
						$query = $this->WxDataWb->saveWcdata($this->request->data, $this->uid);
						if ($query) {
							$this->Session->setFlash('微信公众账号添加成功。');
							return $this->redirect(array('action' => 'index'));
						}
					}
				} else {
					if (!$this->request->data) {
						$this->request->data = array('WxWebchat' => array('FWxApi' => $this->wxAPI, 'FWxToken' => $this->wxToken));
					}
				}
				$this->set('data', $data);
				$this->render('/Admin/_mTxtAdd');
				break;
			case 'edit':
				$this->loadModel('WxDataWb');
				if (!$this->WxDataWb->checkWebchat($id, $this->uid)) return $this->redirect(array('action' => "webchatAdd"));
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataWb->set($this->request->data);
					if ($this->WxDataWb->validates()) {
						$this->WxDataWb->id = $id;
						$query = $this->WxDataWb->saveWebchat($this->request->data, $this->uid);
						if ($query) {
							$this->Session->setFlash('微信公众账号编辑成功。');
							return $this->redirect(array('action' => 'index'));
						}
					}
				} else {
					if (!$this->request->data) {
						$data['list'] = $this->WxDataWb->getWebchatList($this->uid, $id);
				        $this->request->data = $data['list'];
				    }

				}
				$this->render('/Admin/_mTxtAdd');
				break;
			default:
				$this->render('/Admin/mTxt');
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mPic($id, $query) {
		$this->loadModel('WxDataTw');
		$this->loadModel('WxDataTwEvent');
		$twTpl = array(
			'tw' => '<div class="media_preview_area" id="%s">
                        <div class="appmsg editing">
                            <div id="js_appmsg_preview" class="appmsg_content">
                                <div id="appmsgItem1" data-fileid="" data-id="1" class="js_appmsg_item ">
                                    <h4 class="appmsg_title"><a href="%s" target="_blank">%s</a></h4>
                                    <div class="appmsg_info">
                                        <em class="appmsg_date">%s</em>
                                    </div>
                                    <div class="appmsg_thumb_wrp">
                                        <img class="js_appmsg_thumb appmsg_thumb" src="%s">
                                    </div>
                                    <p class="appmsg_desc">%s</p>
                                </div>
                            </div>
                            <div class="com_mask"></div>
                            <i class="icon_item_selected">修改</i>
                       </div>
                    </div>&nbsp;',
			'twj_header' => '<div class="media_preview_area" id="%s">
						<div class="appmsg multi editing">
				       		<div id="js_appmsg_preview" class="appmsg_content">
								<div id="appmsgItem1" data-fileid="" data-id="1" class="js_appmsg_item ">
									<div class="appmsg_info">
			                    		<em class="appmsg_date"></em>
			                		</div>
			                		<div class="cover_appmsg_item">
			                    		<h4 class="appmsg_title"><a href="%s" target="_blank">%s</a></h4>
			                    		<div class="appmsg_thumb_wrp">
			                        		<img class="js_appmsg_thumb appmsg_thumb" %s src="%s">
			                    		</div>
			                		</div>
							    </div>',
			'twj_wrap' => '<div id="appmsgItem2" data-fileid="" data-id="2" class="appmsg_item js_appmsg_item">
								<img class="js_appmsg_thumb appmsg_thumb" %s src="%s">
			               		<i class="appmsg_thumb default" %s>缩略图</i>
			                	<h4 class="appmsg_title"><a href="%s" target="_blank">%s</a></h4>
			            	</div>',
			'twj_footer' => '</div><div class="com_mask"></div><i class="icon_item_selected">修改</i></div></div>&nbsp;'
		);
		switch ($query['action']) {
			case 'add':
				if ($query['mod'] == 'tw') {
					if ($this->request->is('post')) {
						$this->request->data['WxDataTw']['FType'] = 0;
						$this->WxDataTw->set($this->request->data);
						if ($this->WxDataTw->validates()) {
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('图文添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
					$this->render('/Admin/_mPicAddTw');
				} else if ($query['mod'] == 'twj') {
					if ($this->request->is('post')) {
						$this->WxDataTw->set($this->request->data);
						if ($this->WxDataTw->validates(array('fieldList' => array('FTitle')))) {
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('图文添加成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
					$this->render('/Admin/_mPicAddTwj');
				} else if ($query['mod'] == 'event') {
					if ($this->request->is('post')) {
						$this->request->data['WxDataTw']['FType'] = 0;
						$this->WxDataTw->set($this->request->data);
						if ($this->WxDataTw->validates()) {
							$this->WxDataTwEvent->set($this->request->data);
							if ($this->WxDataTwEvent->validates()) {
								$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
								if ($query) {
									$this->Session->setFlash('图文添加成功。');
									return $this->redirect($this->rdWcURL);
								}
							}
						}
					}
					$this->render('/Admin/_mPicAddEvent');
				} else {
					$this->set('data', $data);
					$this->render('/Admin/_mPicAdd');
				}
				break;
			case 'edit':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				$data = $this->WxDataTw->getDataList($id, $query['id']);		//获取图文数据
				$data = $data['WxDataTw']['FType'] == 1 ? $this->WxDataTw->getGaryDataList($id, $query['id']) : $data;
				if ($this->request->is('post') || $this->request->is('put')) {
					if ($this->request->data['WxDataTw']['FType'] == 0) {
						switch ($this->request->data['WxDataTw']['FTwType']) {
							case 'events':			// 图文提交
								$this->request->data['WxDataTw']['FType'] = 0;
								$this->WxDataTw->set($this->request->data);
								if ($this->WxDataTw->validates()) {
									$this->WxDataTwEvent->set($this->request->data);
									if ($this->WxDataTwEvent->validates()) {
										$this->WxDataTw->id = $query['id'];
										$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
										if ($query) {
											$this->Session->setFlash('图文编辑成功。');
											return $this->redirect($this->rdWcURL);
										}
									}
								}
								break;
							default:
								$this->request->data['WxDataTw']['FType'] = 0;
								$this->WxDataTw->set($this->request->data);
								if ($this->WxDataTw->validates()) {
									$this->WxDataTw->id = $query['id'];
									$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
									if ($query) {
										$this->Session->setFlash('图文编辑成功。');
										return $this->redirect($this->rdWcURL);
									}
								}
						}
					} else {
						$this->WxDataTw->set($this->request->data);
						if ($this->WxDataTw->validates(array('fieldList' => array('FTitle')))) {
							$this->WxDataTw->id = $query['id'];
							$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
							if ($query) {
								$this->Session->setFlash('图文编辑成功。');
								return $this->redirect($this->rdWcURL);
							}
						}
					}
				} else {
					if (!$this->request->data) {
						$this->request->data = $data;
				    }
				}
				if ($data['WxDataTw']['FType'] == 0) {
					switch ($data['WxDataTw']['FTwType']) {
						case 'events':
							$tpl = "_mPicAddEvent";
							break;
						default:
							$tpl = "_mPicAddTw";
					}
				} else {
					$tpl = "_mPicAddTwj";
				}
				
				$this->set('data', $data);
				$this->render("/Admin/{$tpl}");
				break;
			case 'del':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				} 
				if ($this->WxDataTw->delete($query['id'])) {
					$this->Session->setFlash('图文删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			case 'preview':
				$query['id'] = $this->request->query['id'];
				$data = $this->WxDataTw->getDataList($id, $query['id']);
				$data['WxDataTw']['FUrl'] = $data['WxDataTw']['FUrl'] ? Router::url($data['WxDataTw']['FUrl']) : '';
                $data['WxDataTw']['FCreatedate'] = date('n月d日', strtotime($data['WxDataTw']['FCreatedate']));
				if ($data['WxDataTw']['FType'] == 0) {
					$html .= sprintf($twTpl['tw'], $vals['WxDataTw']['Id'], $data['WxDataTw']['FPreview'], $data['WxDataTw']['FTitle'], $data['WxDataTw']['FCreatedate'], $data['WxDataTw']['FUrl'], $data['WxDataTw']['FMemo']);
				} else {
					$grayList = $this->WxDataTw->getGaryDataList($id, $data['WxDataTw']['Id']);
					foreach ($grayList['WxDataTw']['FTwj'] as $k => $v) {
						if ($k == 0) {
							$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
							$html .= sprintf($twTpl['twj_header'], $vals['WxDataTw']['Id'], $v['FPreview'], $v['FTitle'], $stythumb, $v['FUrl']);
						} else {
							$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
							$ithumb = $v['FUrl'] ? 'style="display:none"' : '';
							$html .= sprintf($twTpl['twj_wrap'], $stythumb, $v['FUrl'], $ithumb, $v['FPreview'], $v['FTitle']);
						}
						$html .= $k == end(array_keys($grayList['WxDataTw']['FTwj'])) ? sprintf($twTpl['twj_footer']) : '';
					}
				}
				exit(json_encode($html));
				break;
			case 'twj':
				if ($query['value'] == 'tw') {
					$data = $this->WxDataTw->getDataList($id, null, null, array('FType' => 0));
				} else {
					$data = $this->WxDataTw->getDataList($id);
				}
                if(count($data)){
                    foreach ($data['datalist'] as $vals) {
                        $vals['WxDataTw']['FUrl'] = $vals['WxDataTw']['FUrl'] ? Router::url($vals['WxDataTw']['FUrl']) : '';
                        $vals['WxDataTw']['FCreatedate'] = date('n月d日', strtotime($vals['WxDataTw']['FCreatedate']));
                        if ($vals['WxDataTw']['FType'] == 0) {
							$html .= sprintf($twTpl['tw'], $vals['WxDataTw']['Id'], $vals['WxDataTw']['FPreview'], $vals['WxDataTw']['FTitle'], $vals['WxDataTw']['FCreatedate'], $vals['WxDataTw']['FUrl'], $vals['WxDataTw']['FMemo']);
						} else {
							$grayList = $this->WxDataTw->getGaryDataList($id, $vals['WxDataTw']['Id']);
							foreach ($grayList['WxDataTw']['FTwj'] as $k => $v) {
								if ($k == 0) {
									$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
									$html .= sprintf($twTpl['twj_header'], $vals['WxDataTw']['Id'], $v['FPreview'], $v['FTitle'], $stythumb, $v['FUrl']);
								} else {
									$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
									$ithumb = $v['FUrl'] ? 'style="display:none"' : '';
									$html .= sprintf($twTpl['twj_wrap'], $stythumb, $v['FUrl'], $ithumb, $v['FPreview'], $v['FTitle']);
								}
								$html .= $k == end(array_keys($grayList['WxDataTw']['FTwj'])) ? sprintf($twTpl['twj_footer']) : '';
							}
						}
                    }
                    // 单图文
                    $html .= '<script>
                        $.fn.clicktoggle = function(a, b) {
                            return this.each(function() {
                                var clicked = false;
                                $(this).bind("click", function() {
                                    if (clicked) {
                                        clicked = false;
                                        return b.apply(this, arguments);
                                    }
                                    clicked = true;
                                    return a.apply(this, arguments);
                                });
                            });
                        };
                        var Atempids = [];
                        function odd() {
                            $(this).removeClass("selected");
                        }
                        function even() {
                            $(this).addClass("selected");
                        }
                        $("#aj_box .media_preview_area").clicktoggle(even, odd);
                        $("#aj_box .media_preview_area").click(function(){
                            $("#aj_box .media_preview_area").removeClass("selected");
                            $(this).addClass("selected");
                            Atempids = [$(this).attr("id")];
                        });
                    </script>';
                } else {
                    $html = '<p style="text-align: center;margin-top: 80px;">亲,您的图文太少了，<a href="'.Router::url($data['WxDataTw']['FUrl']).'">马上去添加</a> 吧！</p>';
                }
				exit(json_encode($html));
				break;
			case 'getTwj':
				if ($this->request->is('post')) {
					$ids = json_decode($this->request->data['ids']);
					$data = $this->WxDataTw->getDataList($id, NULL, $ids);
                    if(count($data)) {
                        foreach ($data['datalist'] as $vals) {
	                        $vals['WxDataTw']['FUrl'] = $vals['WxDataTw']['FUrl'] ? Router::url($vals['WxDataTw']['FUrl']) : '';
	                        $vals['WxDataTw']['FCreatedate'] = date('n月d日', strtotime($vals['WxDataTw']['FCreatedate']));
	                        if ($vals['WxDataTw']['FType'] == 0) {
								$html .= sprintf($twTpl['tw'], $vals['WxDataTw']['Id'], $vals['WxDataTw']['FPreview'], $vals['WxDataTw']['FTitle'], $vals['WxDataTw']['FCreatedate'], $vals['WxDataTw']['FUrl'], $vals['WxDataTw']['FMemo']);
							} else {
								$grayList = $this->WxDataTw->getGaryDataList($id, $vals['WxDataTw']['Id']);
								foreach ($grayList['WxDataTw']['FTwj'] as $k => $v) {
									if ($k == 0) {
										$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
										$html .= sprintf($twTpl['twj_header'], $vals['WxDataTw']['Id'], $v['FPreview'], $v['FTitle'], $stythumb, $v['FUrl']);
									} else {
										$stythumb = $v['FUrl'] ? 'style="display:inline"' : '';
										$ithumb = $v['FUrl'] ? 'style="display:none"' : '';
										$html .= sprintf($twTpl['twj_wrap'], $stythumb, $v['FUrl'], $ithumb, $v['FPreview'], $v['FTitle']);
									}
									$html .= $k == end(array_keys($grayList['WxDataTw']['FTwj'])) ? sprintf($twTpl['twj_footer']) : '';
								}
							}
                        }
                    } else {
                        $html = '<p style="text-align: center;margin-top: 80px;">亲,您的图文太少了，<a href="'.Router::url($data['WxDataTw']['FUrl']).'">马上去添加</a> 吧！</p>';
                    }
					exit(json_encode($html));
				}
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$conditions = array('FWebchat' => $id);
				if ($query['value']) {
					switch ($query['value']) {
						case 'tw':	
							$conditions['FType'] = 0;
							$conditions['FTwType'] = null;
							break;
						case 'twj':
							$conditions['FType'] = 1;
							break;
						default:
							$conditions['FTwType'] = $query['value'];
					}
				}
				$data['datalist'] = $this->Paginator->paginate('WxDataTw', $conditions);
				// print_r($this->WxDataTw->getLastQuery());exit;
				$data['category'] = $this->WxDataTw->getCategories($id, $this->rdWcURL);
				// print_r($data['category']);exit;
				$this->set('data', $data);
				$this->render('/Admin/mPic');
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mPicGary($id, $query) {
		$this->loadModel('WxDataTw');
		switch ($query['action']) {
			case 'add':
				if ($this->request->is('post')) {
					$this->WxDataTw->set($this->request->data);
					if ($this->WxDataTw->validates(array('fieldList' => array('FTitle')))) {
						$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('图文添加成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} 
				$this->set('data', $data);
				$this->render('/Admin/_mPicGaryAdd');
				break;
			case 'edit':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				}
				if ($this->request->is('post') || $this->request->is('put')) {
					$this->WxDataTw->set($this->request->data);
					if ($this->WxDataTw->validates(array('fieldList' => array('FTitle')))) {
						$this->WxDataTw->id = $query['id'];
						$query = $this->WxDataTw->saveData($this->request->data, $this->uid, $id);
						if ($query) {
							$this->Session->setFlash('图文编辑成功。');
							return $this->redirect($this->rdWcURL);
						}
					}
				} else {
					if (!$this->request->data) {
						$data = $this->WxDataTw->getGaryDataList($id, $query['id']);
						$this->request->data = $data;
				    }

				}
				$this->set('data', $data);
				$this->render('/Admin/_mPicGaryAdd');
				break;
			case 'del':
				if (!$this->WxDataTw->checkId($id, $query['id'])) {
					return $this->redirect($this->rdWcURL);
				} 
				if ($this->WxDataTw->delete($query['id'])) {
					$this->Session->setFlash('图文删除成功。');
				}
				return $this->redirect($this->rdWcURL);
				break;
			default:
				$this->paginate['limit'] = 9;
				$this->Paginator->settings = $this->paginate;
				$data['datalist'] = $this->Paginator->paginate('WxDataTw', array('FWebchat' => $id, 'FType' => 1));
				$this->set('data', $data);
				$this->render('/Admin/mPicGary');
			
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mSlide() {
		$this->render('/Admin/mSlide');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 */
	function _mFile() {
		$this->render('/Admin/mFile');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _hRobot($id, $query) {
		$this->render('/Admin/hRobot');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _hApp($id, $query) {
		$this->render('/Admin/hApp');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _menuset($id) {
		$this->loadModel('WxWcdata');
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->WxWcdata->set($this->request->data);
			if ($this->WxWcdata->validates()) {
				$query = $this->WxWcdata->saveWcdata($this->request->data, $this->uid, $id);
				if ($query) {
					$this->Session->setFlash('默认回复保存成功。');
					return $this->redirect($this->rdBaseURL.'menuset');
				}
			}
		} else {
			if (!$this->request->data) {
				$data = $this->WxWcdata->getWcdataList($this->uid, $id);
				$this->request->data = $data;
			}
		}
		$this->render('/Admin/menuset');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _areply() {
		$this->render('/Admin/areply');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _txtreply() {
		$this->render('/Admin/txtreply');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _info() {
		$this->render('/Admin/info');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function _picreply() {
		$this->render('/Admin/picreply');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function _mFields($id, $query, $wxId) {
		$this->loadModel("WxDataMus");
		switch ($query['mod']) {
			case 'api':
				switch ($query['action']) {
					case 'save':
						if ($this->request->is('post')) {
							$post = $this->request->data['post'];
							$postJson['WxDataMus'] = json_decode($post, TRUE);
							// print_r($postJson);exit;
							$query = $this->WxDataMus->saveData($postJson, $wxId);
							if ($query) {
								$msg['state'] = 1;
								$msg['msg'] = "操作成功";
								$msg['data'] = $query;
							} else {
								$msg['state'] = 0;
								$msg['msg'] = "操作失败";
							}
							echo json_encode($msg);exit;
						}
						break;
					case 'del':
						if ($this->request->is('post')) {
							$post['id'] = $this->request->data['post'];
							$query = $this->WxDataMus->delete($post['id']);
							if ($query) {
								$msg['state'] = 1;
								$msg['msg'] = "操作成功";
							} else {
								$msg['state'] = 0;
								$msg['msg'] = "操作失败";
							}
							echo json_encode($msg);exit;
						}
						break;
					case 'svMenus':
						if ($this->request->is('post')) {
							$post = $this->request->data['post'];
							$post = json_decode($post, TRUE);
							$query = $this->WxDataMus->svMenus($post);
							if ($query) {
								$msg['state'] = 1;
								$msg['msg'] = "操作成功";
							} else {
								$msg['state'] = 0;
								$msg['msg'] = "操作失败";
							}
							echo json_encode($msg);exit;
						}
						break;
					default:
						$msg = $this->WxDataMus->getDataList($wxId);
						echo json_encode($msg);exit;
				}
				break;
			default:
				if ($this->request->isPost()) {
					
					$this->loadModel('WxReply');
					$appid = $this->wcdata['WxWebchat']['FWxAppId'];
					$appsecret = $this->wcdata['WxWebchat']['FWxAppSecret'];
					if ($appsecret && $appid) {
						$case = $this->WxReply->saveMenus($wxId, $appid, $appsecret);
						if ($case && $case['state'] == 1) {
							$this->flashSuccess("菜单已经更新成功，由于微信客户端缓存，需要24小时微信客户端才会展现出来。");
						} else if ($case && $case['state'] == 0) {
							$this->flashError($case['msg']);
						} else {
							$this->flashError("菜单更新失败。");
						}
					} else {
						$this->flashError("请先在系统设置中配置好appid和appsecret。");
					}
					$this->redirect($this->rdWcURL);
				}
				$this->render('/Admin/mFields');
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function basic() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->TPerson->set($this->request->data);
			if ($this->TPerson->validates(array('fieldList' => array('FMemberId', 'FullName', 'FPhone', 'FMobileNumber', 'FEMail', 'FCity')))) {
				$this->TPerson->id = $this->uid;
				$query = $this->TPerson->save($this->request->data, TRUE, array('FullName', 'FPhone', 'FMobileNumber', 'FEMail', 'FCity'));
				if ($query) {
					$this->flashSuccess("保存成功");
					return $this->redirect($this->rdBaseURL.'basic');
				}
			}
		} else {
			$user['TPerson'] = $this->TPerson->getUserInfo($this->uid);
			
			$this->request->data = $user;
		}
		
		$this->set('data', $data);
		$this->render('/Admin/basic');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function wBasic() {
		$this->_checkPrivileges();
		if ($this->request->is('post') || $this->request->is('put')) {
			$Setting = ClassRegistry::init('Settings.Setting');
			$Setting->Behaviors->disable('Cached');
			foreach ($this->request->data as $key => $value) {
				foreach ($value as $k => $v) {
					$Setting->write("{$key}.{$k}", $v);
				}
			}
			$this->flashSuccess("保存成功");
		} else {
			$sets = array('Site' => array("title", "name", "keywords", "description"));
			foreach ($sets as $key => $value) {
				foreach ($value as $v) {
					$user[$key][$v] = Configure::read("{$key}.{$v}");
				}
			}
			$this->request->data = $user;
		}
		
		$this->set('data', $data);
		$this->render('/Admin/wBasic');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function repwd() {
		App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
		if ($this->request->is('post') || $this->request->is('put')) {
			
			// Encode Password
			$userPwd = $this->request->data['TPerson']['FPassWord'];
			$oldPwd = $this->request->data['TPerson']['FOldPassWord'];
			$sp = new SimplePasswordHasher();
			$this->request->data['TPerson']['FOldPassWord'] = $oldPwd = $sp->hash($oldPwd);
			$this->request->data['TPerson']['FPassWord'] = $sp->hash($userPwd);
			
			// Validate
			$user = $this->TPerson->getUserInfo($this->uid);
			$this->TPerson->validator()
			->add('FOldPassWord', 'required', array(
			    'rule' => "notEmpty",
				'required' => true,
				'message' => "必须填写"
			))
			->add('FOldPassWord', 'equalTo', array(
		        'rule' => array('equalTo', $user['FPassWord']),
				'message' => "原密码不正确",
			))
			->add('FRePassWord', 'required', array(
		        'rule' => "notEmpty",
				'required' => true,
				'message' => "必须填写",
			))	
			->add('FRePassWord', 'minLength', array(
		        'rule' => array('minLength', '6'),
				'message' => "不能少于6位",
			))
			->add('FRePassWord', 'equalTo', array(
		        'rule' => array('equalTo', $userPwd),
				'message' => "两次输入的密码不一致",
			));
		
			$this->TPerson->set($this->request->data);
			if ($this->TPerson->validates(array('fieldList' => array('FMemberId', 'FOldPassWord', 'FPassWord', 'FRePassWord')))) {
				$this->TPerson->id = $this->uid;
				$query = $this->TPerson->save($this->request->data, TRUE, array('FPassWord'));
				if ($query) {
					$this->Session->setFlash('密码修改成功，请重新登录');
					return $this->redirect($this->Auth->logout());
				}
			}
		} else {
			$user['TPerson']['FMemberId'] = $this->username;
			$this->request->data = $user;
		}
		
		$this->set('data', $data);
		$this->render('/Admin/repwd');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function webchatAdd() {
		$result = $this->WxWebchat->getWebchatList($this->uid);
		$data['leavecount'] = $this->toAccount - intval($result['count']);
		if ($data['leavecount'] <= 0) {
			$this->Session->setFlash('您的公众号配额已经超了。');
			return $this->redirect(array('action' => "index"));
		}
		if ($this->request->is('post')) {
			$this->WxWebchat->set($this->request->data);
			if ($this->WxWebchat->validates(array('fieldList' => array('FName', 'FWxopenId', 'FWxId', 'FIcon')))) {
				$query = $this->WxWebchat->saveWebchat($this->request->data, $this->uid);
				if ($query) {
					$this->Session->setFlash('微信公众账号添加成功。');
					return $this->redirect(array('action' => 'index'));
				}
			}
		} else {
			if (!$this->request->data) {
				$this->request->data = array('WxWebchat' => array('FWxApi' => $this->wxAPI, 'FWxToken' => $this->wxToken));
			}
		}
		
		$this->set('data', $data);
		$this->render('/Admin/webchatAdd');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function webchatEdit($id)
	{
		$this->loadModel('WxWebchat');
		if (!$this->WxWebchat->checkWebchat($id, $this->uid)) return $this->redirect(array('action' => "webchatAdd"));
		// echo '<pre>';print_r($this->request);exit;
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->WxWebchat->set($this->request->data);
			if ($this->WxWebchat->validates(array('fieldList' => array('FName', 'FWxopenId', 'FWxId', 'FIcon')))) {
				$this->WxWebchat->id = $id;
				$query = $this->WxWebchat->saveWebchat($this->request->data, $this->uid);
				if ($query) {
					$this->Session->setFlash('微信公众账号编辑成功。');
					return $this->redirect(array('action' => 'index'));
				}
			}
		} else {
			if (!$this->request->data) {
				$data['list'] = $this->WxWebchat->getWebchatList($this->uid, $id);
		        $this->request->data = $data['list'];
		    }
		}
		
		$this->set('data', $data);
		$this->render('/Admin/webchatAdd');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function webchatDel($id)
	{
		$this->loadModel('WxWebchat');
		if (!$this->WxWebchat->checkWebchat($id, $this->uid)) return $this->redirect(array('action' => "index"));
		if ($this->WxWebchat->delete($id)) {
			$this->Session->setFlash('微信公众账号删除成功。');
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function webchat_index()
	{
	}
	
//======================Private
	
	/**
	 * 权限检查
	 *
	 * @return void
	 * @author niancode
	 **/
	function _checkPrivileges()
	{
		$routers = $this->WxWebchat->getmenus('hmenu', '', 'router');
		if (!in_array(Router::url(), $routers)) {
			$this->flashError("用户未被授权，禁止访问。");
			return $this->redirect(array('action' => "index"));
		}
	}
}
