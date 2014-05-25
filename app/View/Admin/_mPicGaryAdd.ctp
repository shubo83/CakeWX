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
		"Action/mPicAdd"
	), array('block' => "script_extra", 'inline' => false));
?>
<h3 class="lighter block green">
	请完整填写以下信息：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxDataTw', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('FType', array(
		'div' => "form-group", 
		'options' => array('文章图文', '活动图文'),
		'label' => array('text' => "图文类型：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "select", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5 twSelect",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
));
echo $this->Main->formhr_input('FPreTwj', array(
		'div' => array('class' => "form-group fHidden", 'id' => "twj"), 
		'label' => array('text' => "图文集：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text",
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><div class='u-chooses'></div><button type='button' id='addTw'>添加图文</button><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
?>
<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
		<button class="btn btn-info" type="submit">
			<i class="icon-ok bigger-110"></i>
			提交
		</button>
		&nbsp; &nbsp; &nbsp;
		<button type="button" class="btn" id="previewbox">
			<i class="icon-undo bigger-110"></i>
			预览图文
		</button>
		&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<font color="red">(提示：针对多图文的操作，修改完后记得点击提交按钮。)</font>
	</div>
</div>
<?php echo $this->Form->end(); ?>