<?php
	$this->extend('/Common/Admin/index');
	
	// load css
	$this->Html->css(array(
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
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxWcdata', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('FDefaultType', array(
		'div' => "form-group", 
		'options' => array('0' => "文本", '1' => "图文"),
		'label' => array('text' => "回复类型：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "select", 
		'placeholder' => "", 
		'class' => "twSelect col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));

echo $this->Main->formhr_input('FDefaultContent', array(
		'div' => "form-group", 
		'label' => array('text' => "被关注回复内容：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "textarea",
		'placeholder' => "",
		'class' => "col-xs-10 col-sm-5",
        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
        'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div><div class='col-xs-12 col-sm-9 no-padding-left'><div class='u-chooses'></div><button type='button' id='addTw' style='display:none;'>更换图文</button></div></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
	echo $this->Main->formhr_hidden('FPreTwj', array('id' => "FPreTwj"));
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
<?php echo $this->Form->hidden('t_form', array('id' => "t_form", 'value' => "WxWcdata")); ?>
<?php echo $this->Form->end(); ?>