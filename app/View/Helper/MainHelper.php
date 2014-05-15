<?php

 /**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */

class MainHelper extends AppHelper {
	
	public function __construct(View $view, $settings = array())
	{
		parent::__construct($view, $settings);
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function sns_url($rurl = '')
	{
		$url = ClassRegistry::init('XyhSetting')->getSettingsUrl();
		$url = $this->Array->element('sns_url', $url['sns_url']);
		return $url.$rurl;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function menuSearch($arr, $type = 'hmenu', $router = 0)
	{
		if ($type == 'hmenu')
		{
			$action = $this->request->params['action'] == 'index' ? '' : '/'.$this->request->params['action'];
			$url = Router::url('/'.$this->request->params['controller'].$action);
		}
		else
		{
			$id = $this->request->params['pass'][0];
			$ac = $this->request->params['pass'][1];
			$url = Router::url("/admin/wc/{$id}/{$ac}");
		}
		$value = $this->Array->MY_arrSearch($arr, $url, 'url', TRUE, 'child', 'action', $router);
		return $value;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function MY_currmenu($arr, $one = FALSE, $child = "child")
	{
		$str = "";
		if (!is_array($arr)) return FALSE;
		$arr_v = array_keys($arr);
		$value1 = reset($arr_v);
		if ($one) 
		{
			$str = $value1;
		}
		else
		{
			$str = $value1;
			if (isset($arr[$value1][$child]))
			{
				$arr_vs = array_keys($arr[$value1][$child]);
				$value2 = reset($arr_vs);
				$str = $str."<small>
					<i class=\"icon-double-angle-right\"></i>
					{$value2}
				</small>";
			}
		}
		return $str;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function formhr_input($name, $arr = array())
	{
		$html = $this->Form->input($name, $arr);
		$html .= "<div class=\"space-4\"></div>";
		return $html;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function formhr_hidden($name, $arr = array())
	{
		$html = $this->Form->hidden($name, $arr);
		$html .= "<div class=\"space-4\"></div>";
		return $html;
	}
	
	/**
	 * json 编码
	 * 
	 * 解决中文经过 json_encode() 处理后显示不直观的情况
	 * 如默认会将“中文”变成"\u4e2d\u6587"，不直观
	 * 如无特殊需求，并不建议使用该函数，直接使用 json_encode 更好，省资源
	 * json_encode() 的参数编码格式为 UTF-8 时方可正常工作
	 * 
	 * @param array|object $data
	 * @return array|object
	 */
	function ch_json_encode($data) {	
		$ret = $this->Main->wphp_urlencode($data);
		$ret = json_encode($ret);
		return urldecode($ret);
	}
	
	
	/**
	 * 对数组和标量进行 urlencode 处理
	 * 通常调用 wphp_json_encode() 
	 * 处理 json_encode 中文显示问题
	 * @param array $data
	 * @return string
	 */
	function wphp_urlencode($data) {
		if (is_array($data) || is_object($data)) {
			foreach ($data as $k => $v) {
				if (is_scalar($v)) {
					if (is_array($data)) {
						$data[$k] = urlencode($v);
					} else if (is_object($data)) {
						$data->$k = urlencode($v);
					}
				} else if (is_array($data)) {
					$data[$k] = $this->Main->wphp_urlencode($v); //递归调用该函数
				} else if (is_object($data)) {
					$data->$k = $this->Main->wphp_urlencode($v);
				}
			}
		}
		return $data;
	}
}