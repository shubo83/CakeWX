<?php
	$this->extend('/Common/Admin/index');
	
	// load css
	$this->Html->css(array(
		// "login"
	), null, array('block' => "css_extra", 'inline' => false));
	
	// load script
	$this->Html->script(array(
		"Editor/kindeditor",
		"Action/webchat"
	), array('block' => "script_extra", 'inline' => false));
?>
<style type="text/css">
	.mar_5 {
		margin: 0 0 0 10px;
	}
	.maroon {
		color: red;
		margin-right: 5px;
	}
	.form-group.error input, .form-group.error select, .form-group.error textarea {
		border-color: #f09784;
		color: #d68273;
		-webkit-box-shadow: none;
		box-shadow: none;
	}
	.form-group.error .control-label, .form-group.error .help-block, .form-group.error .help-inline {
	color: #d16e6c;
	}
</style>
<h3 class="lighter block green">
	请完整填写以下信息：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxWebchat', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('FName', array(
		'div' => "form-group", 
		'label' => array('text' => "公众号名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FWxopenId', array(
		'div' => "form-group", 
		'label' => array('text' => "公众号原始id：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle'><span class='maroon'>*</span>请认真填写，错了不能修改。比如：gh_270ef4b39b5b</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3')),
	));
echo $this->Main->formhr_input('FWxId', array(
		'div' => "form-group", 
		'label' => array('text' => "微信号：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FIcon', array(
		'div' => "form-group", 
		'label' => array('text' => "头像地址（url）：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<button type='button' id='WX_icon' class='btn btn-xs btn-primary mar_5'><i class='icon-camera bigger-160'></i>上传</button></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FWxApi', array(
		'div' => "form-group", 
		'label' => array('text' => "接口地址：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'readonly' => TRUE,
		'placeholder' => $wxAPI, 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "</div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FWxToken', array(
		'div' => "form-group", 
		'readonly' => TRUE,
		'label' => array('text' => "TOKEN：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => $wxToken, 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "</div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
?>
<div class="alert alert-info" style="margin-top:20px">
	<button type="button" class="close" data-dismiss="alert">
		<i class="icon-remove"></i>
	</button>
	<strong>
		提示：
	</strong>
	接口地址和TOKEN无须填写，请把这两个配置到微信公众平台，方才能正常工作。&nbsp;&nbsp;<font color="red">PS：<a target="_blank" style="color:red" href="http://www.cakewx.com/settings.html">微信公众平台具体怎么配置，传送门>></a></font>
	<br>
</div>
<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
		<button class="btn btn-info" type="submit">
			<i class="icon-ok bigger-110"></i>
			提交
		</button>
		&nbsp; &nbsp; &nbsp;
		<button class="btn" type="reset">
			<i class="icon-undo bigger-110"></i>
			重置
		</button>
	</div>
</div>
<?php echo $this->Form->end(); ?>