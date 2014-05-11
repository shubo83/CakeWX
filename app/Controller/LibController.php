<?php
App::uses('AppController', 'Controller');

/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class LibController extends AppController {
	
	public $components = array('RequestHandler');
	public $helpers = array('Array', 'Main', 'Html');
	public $json = "";
	
	public function beforeFilter() {
	    parent::beforeFilter();
		$this->RequestHandler->renderAs($this, 'json');
		$this->Auth->allow('phone');
		$this->json = $this->request->input('json_decode');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	public function phone()
	{
		$phone = $this->json->phone;
		$code = $this->json->code;
		$reg = $this->json->reg;
		$repwd = $this->json->repwd;
		$msg['check'] = "此号码已经注册，请更换新手机号。";
		$msg['repwd'] = "此手机号尚未注册。";
		if (isset($this->request->query['verify']))
		{
			$post['phone'] = $phone;
			$post['code'] = $code;
			$smsdata = unserialize($this->Session->read('smsdata'));
			if (1 || $post && $smsdata && $post['phone'] == $smsdata['phone'] && $post['code'] == $smsdata['code'])
			{
				if ($reg)
				{
					if (!ClassRegistry::init('SocialActive')->checkIsActive('phone', $phone))
					{
						$uid = ClassRegistry::init('TPerson')->addActivePerson($post['phone']);
						$state = $uid ? 1 : 0;
						$data['state'] = $state;
						$data['uid'] = $uid;
					}
					else
					{
						$data['msg'] = $msg['check'];
						$data['state'] = 0;
					}
				}
				else
				{
					$data['state'] = 1;
				}
			}
			else
			{
				$data['state'] = 0;
				$data['msg'] = "对不起，您填写的验证码与系统发送的不符。";
			}
		}
		else
		{
			if ($reg && ClassRegistry::init('SocialActive')->checkIsActive('phone', $phone))
			{
				$data['msg'] = $msg['check'];
				$data['state'] = 0;
			}
			else if ($repwd && !ClassRegistry::init('SocialActive')->checkIsActive('phone', $phone))
			{
				$data['msg'] = $msg['repwd'];
				$data['state'] = 0;
			}
			else
			{
				$randStr = str_shuffle('1234567890');
				$sms['code'] = substr($randStr,0,6);
				$sms['phone'] = $phone;
				$sms['msg'] = "您的验证码是：{$sms['code']}。请在页面填写验证码完成验证。（如非本人操作，可不予理会）";
				$case = $sms['phone'] ? $this->sendPhoneMsg($sms['phone'], $sms['msg']) : FALSE;
				if ($case)
				{
					$data['msg'] = "验证码已发送成功，请注意查收。";
					$data['state'] = 1;
					$this->Session->write('smsdata', serialize($sms));		// Write Session
				}
				else
				{
					$data['msg'] = "短信发送失败，请联系管理员。";
					$data['state'] = 0;
				}
			}
		}
		
		$this->set('jsondata', $data);
		$this->render('/Admin/Api/json');
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function picUpload()
	{
		$php_path = dirname(__FILE__) . '/';
		$php_url = dirname($_SERVER['PHP_SELF']) . '/';

		//文件保存目录路径
		$save_path = WWW_ROOT.'./attached/';
		//文件保存目录URL
		$save_url = '/attached/';
		//定义允许上传的文件扩展名
		$ext_arr = array(
			'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
			'flash' => array('swf', 'flv'),
			'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
			'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
		);
		//最大文件大小
		$max_size = 1000000;
		@mkdir($save_path);
		$save_path = realpath($save_path) . '/';
		
		//PHP上传失败
		if (!empty($_FILES['imgFile']['error'])) {
			switch($_FILES['imgFile']['error']){
				case '1':
					$error = '超过php.ini允许的大小。';
					break;
				case '2':
					$error = '超过表单允许的大小。';
					break;
				case '3':
					$error = '图片只有部分被上传。';
					break;
				case '4':
					$error = '请选择图片。';
					break;
				case '6':
					$error = '找不到临时目录。';
					break;
				case '7':
					$error = '写文件到硬盘出错。';
					break;
				case '8':
					$error = 'File upload stopped by extension。';
					break;
				case '999':
				default:
					$error = '未知错误。';
			}
			$this->_alert($error);
		}

		//有上传文件时
		if (empty($_FILES) === false) {
			//原文件名
			$file_name = $_FILES['imgFile']['name'];
			//服务器上临时文件名
			$tmp_name = $_FILES['imgFile']['tmp_name'];
			//文件大小
			$file_size = $_FILES['imgFile']['size'];
			//检查文件名
			if (!$file_name) {
				$this->_alert("请选择文件。");
			}
			//检查目录
			if (@is_dir($save_path) === false) {
				$this->_alert("上传目录不存在。");
			}
			//检查目录写权限
			if (@is_writable($save_path) === false) {
				$this->_alert("上传目录没有写权限。");
			}
			//检查是否已上传
			if (@is_uploaded_file($tmp_name) === false) {
				$this->_alert("上传失败。");
			}
			//检查文件大小
			if ($file_size > $max_size) {
				$this->_alert("上传文件大小超过限制。");
			}
			//检查目录名
			$dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
			if (empty($ext_arr[$dir_name])) {
				$this->_alert("目录名不正确。");
			}
			//获得文件扩展名
			$temp_arr = explode(".", $file_name);
			$file_ext = array_pop($temp_arr);
			$file_ext = trim($file_ext);
			$file_ext = strtolower($file_ext);
			//检查扩展名
			if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
				$this->_alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
			}
			//创建文件夹
			if ($dir_name !== '') {
				$save_path .= $dir_name . "/";
				$save_url .= $dir_name . "/";
				if (!file_exists($save_path)) {
					mkdir($save_path);
				}
			}
			$ymd = date("Ymd");
			$save_path .= $ymd . "/";
			$save_url .= $ymd . "/";
			if (!file_exists($save_path)) {
				mkdir($save_path);
			}
			//新文件名
			$new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
			//移动文件
			$file_path = $save_path . $new_file_name;
			if (move_uploaded_file($tmp_name, $file_path) === false) {
				$this->_alert("上传文件失败。");
			}
			@chmod($file_path, 0644);
			$file_url = $save_url . $new_file_name;
			if (isset($this->request->query['prefix'])) {
				$file_url = Router::url($file_url);
			}
			header('Content-type: text/html; charset=UTF-8');
			echo json_encode(array('error' => 0, 'url' => $file_url));
			exit;
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function _alert($msg)
	{
		header('Content-type: text/html; charset=UTF-8');
		echo json_encode(array('error' => 1, 'message' => $msg));
		exit;
	}
}