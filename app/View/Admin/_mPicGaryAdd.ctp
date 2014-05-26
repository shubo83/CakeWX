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
<?php
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxDataTw', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal"));
?>
<div class="media_preview_area" style="width:320px;display:block;margin:0 auto;">
    <div class="appmsg multi editing">
        <div id="js_appmsg_preview" class="appmsg_content">
            <div id="appmsgItem1" data-fileid="" data-id="1" class="js_appmsg_item ">
                <div class="appmsg_info">
                    <em class="appmsg_date"></em>
                </div>
                <div class="cover_appmsg_item">
                    <h4 class="appmsg_title"><a href="javascript:void(0);" onclick="return false;" target="_blank">标题</a></h4>
                    <div class="appmsg_thumb_wrp">
                        <img class="js_appmsg_thumb appmsg_thumb" src="">
                        <i class="appmsg_thumb default">封面图片</i>
                    </div>
                    <div class="appmsg_edit_mask">
                        <a onclick="return false;" class="icon18_common edit_gray js_edit" data-id="1" href="javascript:;">编辑</a>
                    </div>
                </div>
            </div>
            <div id="appmsgItem2" data-fileid="" data-id="2" class="appmsg_item js_appmsg_item">
                <img class="js_appmsg_thumb appmsg_thumb" src="">
                <i class="appmsg_thumb default">缩略图</i>
                <h4 class="appmsg_title"><a onclick="return false;" href="javascript:void(0);" target="_blank">标题</a></h4>
                <div class="appmsg_edit_mask">
                    <a class="icon18_common edit_gray js_edit" data-id="2" onclick="return false;" href="javascript:void(0);">编辑</a>
                    <a class="icon18_common del_gray js_del" data-id="2" onclick="return false;" href="javascript:void(0);">删除</a>
                </div>
            </div>
        </div>
        <div class="appmsg_add">
            <a onclick="return false;" id="js_add_appmsg" href="javascript:void(0);">
                &nbsp;
                <i class="icon24_common add_gray">增加一条</i>
            </a>
        </div>
    </div>
</div>
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
<?php echo $this->Form->hidden('WxDataTw.FType', array('id' => "FType", 'value' => 1)); ?>
<?php echo $this->Form->end(); ?>