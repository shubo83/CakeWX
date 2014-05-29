<?php
	$this->extend('/Common/Admin/index');
	
	// load script
	$this->Html->script(array(
		"Action/sAroz"
	), array('block' => "script_extra", 'inline' => false));
?>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxWebchat', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('FWxType', array(
		'div' => "form-group", 
		'options' => array('M' => "订阅号", 'M2' => "认证订阅号", 'F' => "服务号", 'F2' => "认证服务号"),
		// 'value' => "M1",
		'label' => array('text' => "公众号类型：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "select", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "</div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FWxAppId', array(
		'div' => array('class' => "form-group fHidden", 'id' => "dAppId"), 
		'label' => array('text' => "AppId：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "请填写应用id", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "</div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FWxAppSecret', array(
		'div' => array('class' => "form-group fHidden", 'id' => "dAppSecret"), 
		'label' => array('text' => "AppSecret：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "请填写应用密匙", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "</div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
?>
<div class="clearfix form-actions">
	<div class="col-xs-12 col-sm-9 col-sm-offset-3">
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