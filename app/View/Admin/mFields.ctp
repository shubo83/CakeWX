<?php
	$this->extend('/Common/Admin/index');

	// load script
	$this->Html->script(array(
        "/assets/js/bootbox.min",
		"/assets/js/jquery.nestable.min",
        "/assets/js/jquery.json-2.4.min",
		"Action/mFields",
	), array('block' => "script_extra", 'inline' => false));
?>

<div class="col-sm-7" style="position: relative;">
    <div class="tabbable">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a data-toggle="tab" href="#home">
                    <i class="green icon-home bigger-110"></i>
                    DIY菜单
                </a>
            </li>
        </ul>
        <span class="btn btn-primary" type="button" id="savejson" style="position: absolute;top:0;right: 12px;padding:1px 10px;"><i class="icon-ok"></i>保存</span>
        <div class="tab-content">
            <div id="home" class="tab-pane in active">
                <div class="dd dd-list" id="nestable"><ol></ol></div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-5" style="margin-top:30px; border:1px solid #e3e3e3; background-color:#f5f5f5;">
	<?php
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo "<h2>添加菜单：</h2>";
	echo $this->Form->create('WxDataMus', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal"));
	echo $this->Main->formhr_input('FName', array(
			'div' => "form-group",
			'label' => array('text' => "菜单名称：", 'class' => "col-sm-3 control-label no-padding-right"),
			'type' => "text",
			'placeholder' => "",
			'class' => "col-xs-10 col-sm-5",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'>*</span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	echo $this->Main->formhr_input('newMenu', array(
		'div' => "form-group",
		'options' => array('1' => '是', '0' => '否'),
		'label' => array('text' => "主菜单：", 'class' => "col-sm-3 control-label no-padding-right"),
		'type' => "select",
		'placeholder' => "",
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
    echo $this->Main->formhr_input('newsubMenu', array(
    'div' => "form-group",
    'options' => array('0' => '请选择'),
    'label' => array('text' => "上级菜单：", 'class' => "col-sm-3 control-label no-padding-right"),
    'type' => "select",
    'disabled' => 'disabled',
    'placeholder' => "",
    'class' => "col-xs-10 col-sm-5",
    'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
    'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
    'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
    ));
	echo $this->Main->formhr_input('FKeysOrLink', array(
			'div' => "form-group",
			'label' => array('text' => "链接地址：", 'class' => "col-sm-3 control-label no-padding-right"),
			'type' => "text",
			'placeholder' => "",
			'class' => "col-xs-10 col-sm-10",
			'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
			'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
			'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
		));
	?>
	<div class="clearfix form-actions">
		<div class="col-md-offset-3 col-md-9">
            <button class="btn btn-primary" id="addnewitem" style="margin-left:20px;" type="button">
                新增
            </button>
        </div>
	</div>
	<?php echo $this->Form->end(); ?>
</div>
