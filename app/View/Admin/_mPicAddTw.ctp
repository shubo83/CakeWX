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
<style>.formput .item-title{width: 120px;float:left;}.form-horizontal .form-group{margin-left:0;}</style>
<h3 class="lighter block green">
	添加单图文：
</h3>
<?php
$this->Form->inputDefaults(array('label' => true, 'div' => true));
    echo $this->Form->create('WxDataTw', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal"));
?>
<div class="singleitem cl">
    <div class="prebox fl" style="width:330px;">
        <div class="media_preview_area" style="width:320px;display:block;margin:0 auto;">
            <div class="appmsg">
                <div id="js_appmsg_preview" class="appmsg_content">
                    <div id="appmsgItem1" data-fileid="" data-id="1" class="js_appmsg_item ">
                        <h4 class="appmsg_title"><a href="javascript:void(0);" onclick="return false;" target="_blank"><?php echo $data['WxDataTw']['FTitle'] ? $data['WxDataTw']['FTitle'] : '标题'; ?></a></h4>
                        <div class="appmsg_info"><em class="appmsg_date"><?php echo $data['WxDataTw']['FCreatedate']; ?></em></em></div>
						<div class="appmsg_thumb_wrp">
                            <img class="js_appmsg_thumb appmsg_thumb"  <?php if(!$data['WxDataTw']['FUrl']) { ?> style="display:none;"<?php }?>src="<?php echo Router::url($data['WxDataTw']['FUrl'], TRUE); ?>">
                            <i class="appmsg_thumb default" <?php if($data['WxDataTw']['FUrl']) { ?> style="display:none;"<?php }?>>封面图片</i>
                        </div>
                        <p class="appmsg_desc"><?php echo $data['WxDataTw']['FMemo']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="formput fl" style="width:650px;">
    <?php
        echo $this->Main->formhr_input('FTitle', array(
        'div' => "form-group",
        'label' => array('text' => "图文名称：", 'class' => "col-sm-2 control-label no-padding-right"),
        'type' => "text",
        'placeholder' => "",
        'class' => "col-xs-10 col-sm-8",
        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
        'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'>*</span></span></div></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
        ));
        echo $this->Main->formhr_input('FAuthor', array(
        'div' => "form-group",
        'label' => array('text' => "作者：", 'class' => "col-sm-2 control-label no-padding-right"),
        'type' => "text",
        'placeholder' => "",
        'class' => "col-xs-10 col-sm-8",
        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
        'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
        ));
        echo $this->Main->formhr_input('FUrl', array(
        'div' => "form-group",
        'label' => array('text' => "封面图片：", 'class' => "col-sm-2 control-label no-padding-right"),
        'type' => "text",
        'placeholder' => "",
        'class' => "col-xs-10 col-sm-8",
        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
        'after' => "<button type='button' id='WX_icon' class='btn btn-xs btn-primary mar_5'><i class='icon-camera bigger-160'></i>上传</button>&nbsp;&nbsp;&nbsp;</div><div style='color:red;margin-top:5px;'>（大图片建议尺寸：720像素 * 400像素）</div></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
        ));
        echo $this->Main->formhr_input('FMemo', array(
        'div' => "form-group",
        'label' => array('text' => "摘要：", 'class' => "col-sm-2 control-label no-padding-right"),
        'type' => "textarea",
        'placeholder' => "",
        'style' => "width:600px",
        'class' => "col-xs-10 col-sm-8",
        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
        'after' => "<span class='help-inline col-xs-12 col-sm-2'><span class='middle maroon'></span></span></div></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
        ));
        echo $this->Main->formhr_input('FContent', array(
        'div' => "form-group",
        'label' => array('text' => "图文内容：", 'class' => "col-sm-2 control-label no-padding-right"),
        'type' => "textarea",
        'placeholder' => "",
        'class' => "col-xs-10 col-sm-5",
        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
        'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
        ));
        echo $this->Main->formhr_input('FLink', array(
        'div' => "form-group",
        'label' => array('text' => "图文链接：", 'class' => "col-sm-2 control-label no-padding-right"),
        'type' => "text",
        'placeholder' => "",
        'class' => "col-xs-10 col-sm-12",
        'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
        'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
        'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-2'))
        ));
    ?>
    </div>
</div>
<div class="clearfix form-actions">
	<div class="col-xs-12 col-sm-9 col-sm-offset-3 no-padding-left" style="margin-left:451px">
		<button class="btn btn-info" type="submit">
			<i class="icon-ok bigger-110"></i>
			提交
		</button>
		&nbsp; &nbsp; &nbsp;
        <button type="reset" class="btn">
            <i class="icon-undo bigger-110"></i>
            重置
        </button>
	</div>
</div>
<?php echo $this->Form->end(); ?>

