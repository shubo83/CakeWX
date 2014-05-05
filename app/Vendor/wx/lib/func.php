<?php
// ====================function
if (! function_exists('curlData'))
{
	/**
	 * Curl data
	 *
	 * @return void
	 * @author apple
	 **/
	function curlData($url, $params = array(), $type = 'GET', $debug = 0, $options = array())
	{
		$cl = new Curl();
		if ($type == 'GET')
		{
			$params = $params ? '?'.MY_paraseGetArray($params) : "";
			$curl['url'] = site_url($url.$params);
			$json = $cl->simple_get($curl['url'], $options);
		}
		else
		{
			$curl['url'] = site_url($url);
			$json = $cl->simple_post($curl['url'], $params, $options);
		}
		if ($debug) $cl->debug();		// debug
		$json = json_decode($json, TRUE);
		return $json;
	}
}

if (! function_exists('MY_paraseGetArray'))
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function MY_paraseGetArray($arr)
	{
		$tmp = array_keys($arr);
		$newarr = array_map("__oget", $tmp, $arr);
		$str = implode('&', $newarr);
		return $str;
		
	}
	function __oget($v1, $v2) 
	{
		return "{$v1}={$v2}";
	}
}

if (! function_exists('site_url'))
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function site_url($url)
	{
		return $url;
	}
}

?>