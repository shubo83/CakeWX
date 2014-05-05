<?php
App::import('Vendor', 'UpYun');
class Upcdn {
	
	var $baseurl = "";
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function test()
	{
		$upyun = new UpYun('liunian-photo', '', '');
		try 
		{
		    $list = $upyun->getList('/demo/');
			return $list;
		}
		catch(Exception $e) 
		{
		    return $e->getCode().$e->getMessage();
		}
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function getImgUrl($uid)
	{
		return $this->baseurl.'avatar/'.$uid.'.jpg';
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function wtImage($filename, $data, $type = null)
	{
		$upyun = new UpYun('liunian-photo', '', '');
		$type = is_null($type) ? 'image' : 'avatar';
		$dir = is_null($type) ? '/img/' : '/avatar/';
		switch ($type)
		{
			case 'image':
				$year = date('Y');
				$month = date('m');
				$path = "{$dir}{$year}/{$month}/{$filename}";
				break;
			case 'avatar':
				$path = $dir.$filename;
				break;
			default:
		}
		// echo $data;exit;
		try 
		{
		    $rsp = $upyun->writeFile($path, $data, True);
			return TRUE;
		}
		catch(Exception $e) 
		{
			return FALSE;
		    // return $e->getCode().$e->getMessage();
		}
	}

}