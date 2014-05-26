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
		"Action/mPicAdd",
		"DatePicker/WdatePicker"
	), array('block' => "script_extra", 'inline' => false));
?>
<h3 class="lighter block green">
	请完整填写以下信息：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create(false, array('name' => "form1", 'role' => "form", 'class' => "form-horizontal")); 
echo $this->Main->formhr_input('WxDataTw.FTitle', array(
		'div' => "form-group", 
		'label' => array('text' => "活动名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('WxDataTwEvent.FStartdate', array(
		'div' => "form-group", 
		'label' => array('text' => "时间：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'onfocus' => "WdatePicker({maxDate:'2020-10-01', dateFmt:'yyyy-MM-dd HH:mm:ss'})",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*&nbsp;&nbsp;<img onclick=\"WdatePicker({el:'WxDataTwEventFStartdate', maxDate:'2020-10-01', dateFmt:'yyyy-MM-dd HH:mm:ss'})\" src='".Router::url('/js/DatePicker/skin/datePicker.gif')."' width='16' height='22' align='absmiddle'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('WxDataTwEvent.FAddress', array(
		'div' => "form-group", 
		'label' => array('text' => "地点：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('WxDataTwEvent.FMaxPersonCount', array(
		'div' => "form-group", 
		'label' => array('text' => "人数：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('WxDataTwEvent.FPersonCount', array(
		'div' => "form-group", 
		'label' => array('text' => "费用：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('WxDataTw.FUrl', array(
		'div' => "form-group", 
		'label' => array('text' => "活动图片：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<button type='button' id='WX_icon' class='btn btn-xs btn-primary mar_5'><i class='icon-camera bigger-160'></i>上传</button>&nbsp;&nbsp;&nbsp;<span style='color:red'>（大图片建议尺寸：720像素 * 400像素）</span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('WxDataTw.FMemo', array(
		'div' => "form-group", 
		'label' => array('text' => "摘要：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "textarea", 
		'placeholder' => "",
        'style' => "width:700px",
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
echo $this->Main->formhr_input('WxDataTw.FContent', array(
		'div' => "form-group", 
		'label' => array('text' => "详细内容：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "textarea", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
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
		<button type="button" class="btn" id="previewbox">
			<i class="icon-search bigger-110"></i>
			预览图文
		</button>
		&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;
		<font color="red">(提示：这里只是预览图文，如需预览活动，请保存后点击操作一览的预览图标。)</font>
	</div>
</div>
<?php echo $this->Form->hidden('WxDataTw.FTwType', array('id' => "FTwType", 'value' => "events")); ?>
<?php echo $this->Form->end(); ?>