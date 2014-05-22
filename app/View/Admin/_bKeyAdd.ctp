<?php
	$this->extend('/Common/Admin/index');
	
	// load css
	$this->Html->css(array(
        // "Action/mPicAdd"
		// "login"
	), null, array('block' => "css_extra", 'inline' => false));
	
	// load script
	$this->Html->script(array(
        "/assets/js/bootbox.min",
		"Editor/kindeditor",
		"Action/webchat",
		"Action/twSelect"
	), array('block' => "script_extra", 'inline' => false));
?>
<h3 class="lighter block green">
	请完整填写以下信息：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxDataKds', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('FKey', array(
		'div' => "form-group", 
		'label' => array('text' => "关键字：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>* (多个关键词［只能在完全匹配下使用］请用中线格开，例如: 美丽|漂亮|好看)</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FKeyMacth', array(
		'div' => "form-group", 
		'options' => array('0' => "完全匹配", '1' => "模糊匹配"),
		'label' => array('text' => "匹配类型：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "select", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FType', array(
		'div' => "form-group", 
		'options' => array('0' => "文本", '1' => "图文"),
		'label' => array('text' => "回复类型：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "select", 
		'placeholder' => "", 
		'class' => "twSelect col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('FWbContent', array(
		'div' => "form-group", 
		'label' => array('text' => "回复内容：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "textarea",
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
        'between' => "<div class='col-xs-12 col-sm-9'>",
        'after' => "<div class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></div></div><div class='col-xs-12 col-sm-9'><div class='u-chooses'></div><button type='button' id='addTw' style='display:none;'>重置图文</button></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_hidden('FPreTwj', array('id' => "FPreTwj"));				// 隐藏域
?>
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
<?php echo $this->Form->hidden('t_form', array('id' => "t_form", 'value' => "WxDataKds")); ?>
<?php echo $this->Form->end(); ?>