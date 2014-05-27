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
	
	$twData = $data['WxDataTw']['FTwj'];
	// echo '<pre>';print_r($twData);exit;
?>
<h3 class="lighter block green">
	添加多图文：
</h3>
<?php
$this->Form->inputDefaults(array('label' => true, 'div' => true));
echo $this->Form->create('WxDataTw', array('name' => "form1", 'role' => "form", 'class' => "form-horizontal"));
echo $this->Main->formhr_input('FTitle', array(
		'div' => "form-group", 
		'label' => array('text' => "名称：", 'class' => "col-sm-3 control-label no-padding-right"), 
		'type' => "text", 
		'placeholder' => "", 
		'class' => "col-xs-10 col-sm-5",
		'between' => "<div class='col-xs-12 col-sm-9'><div class='clearfix'>",
		'after' => "<span class='help-inline col-xs-12 col-sm-7'><span class='middle maroon'></span></span></div></div>",
		'error' => array('attributes' => array('wrap' => 'div', 'class' => 'help-block col-xs-12 col-md-offset-3'))
	));
?>
<div class="row">
	<div class="col-sm-3 control-label no-padding-right">
		图文集：
	</div>
	<div class="col-xs-12 col-sm-9">
		<div class="media_preview_area" style="display:block;">
		    <div class="appmsg multi editing">
		        <div id="js_appmsg_preview" class="appmsg_content">
					<div id="appmsgItem1" data-fileid="" data-id="1" class="js_appmsg_item ">
		                <div class="appmsg_info">
		                    <em class="appmsg_date"></em>
		                </div>
		                <div class="cover_appmsg_item">
		                    <h4 class="appmsg_title"><a href="javascript:void(0);" onclick="return false;" target="_blank"><?php echo $twData[0]['FTitle'] ? $twData[0]['FTitle'] : '标题'; ?></a></h4>
		                    <div class="appmsg_thumb_wrp">
								<?php
									$stythumb = $twData[0]['FUrl'] ? 'style="display:inline"' : '';
								?>
		                        <img class="js_appmsg_thumb appmsg_thumb" <?php echo $stythumb; ?> src="<?php echo $twData[0]['FUrl']; ?>">
		                        <i class="appmsg_thumb default">封面图片</i>
		                    </div>
		                    <div class="appmsg_edit_mask">
		                        <a onclick="return false;" class="icon18_common edit_gray js_edit" data-id="1" href="javascript:;">编辑</a>
		                    </div>
							<input type="hidden" name="data[WxDataTw][FTwj][]" value="<?php echo $twData[0]['Id']; ?>">
		                </div>
		            </div>
					<div id="appmsgItem2" data-fileid="" data-id="2" class="appmsg_item js_appmsg_item">
						<?php
							$stythumb = $twData[1]['FUrl'] ? 'style="display:inline"' : '';
							$ithumb = $twData[1]['FUrl'] ? 'style="display:none"' : '';
						?>
		                <img class="js_appmsg_thumb appmsg_thumb" <?php echo $stythumb; ?> src="<?php echo $twData[1]['FUrl']; ?>">
		                <i class="appmsg_thumb default" <?php echo $ithumb; ?>>缩略图</i>
		                <h4 class="appmsg_title"><a onclick="return false;" href="javascript:void(0);" target="_blank"><?php echo $twData[1]['FTitle'] ? $twData[1]['FTitle'] : '标题'; ?></a></h4>
		                <div class="appmsg_edit_mask">
		                    <a class="icon18_common edit_gray js_edit" data-id="2" onclick="return false;" href="javascript:void(0);">编辑</a>
		                    <a class="icon18_common del_gray js_del" data-id="2" onclick="return false;" href="javascript:void(0);">删除</a>
		                </div>
						<input type="hidden" name="data[WxDataTw][FTwj][]" value="<?php echo $twData[1]['Id']; ?>">
		            </div>
					<?php foreach ($twData as $key => $vals): ?>
						<?php if ($key != 0 && $key != 1): ?>
							<?php 
								$appthumb = $vals['FUrl'] ? 'appmsg_thumb' : '';
								$stythumb = $vals['FUrl'] ? 'style="display:inline"' : '';
								$ithumb = $vals['FUrl'] ? 'style="display:none"' : '';
							?>
							<div class="appmsg_item js_appmsg_item">
				                <img class="js_appmsg_thumb appmsg_thumb" <?php echo $stythumb; ?> src="<?php echo $vals['FUrl']; ?>">
				                <i class="appmsg_thumb default" <?php echo $ithumb; ?>>缩略图</i>
				                <h4 class="appmsg_title"><a onclick="return false;" href="javascript:void(0);" target="_blank"><?php echo $vals['FTitle']; ?></a></h4>
				                <div class="appmsg_edit_mask">
				                    <a class="icon18_common edit_gray js_edit" data-id="2" onclick="return false;" href="javascript:void(0);">编辑</a>
				                    <a class="icon18_common del_gray js_del" data-id="2" onclick="return false;" href="javascript:void(0);">删除</a>
				                </div>
								<input type="hidden" name="data[WxDataTw][FTwj][]" value="<?php echo $vals['Id']; ?>">
				            </div>
						<?php endif ?>
					<?php endforeach ?>
		        </div>
		        <div class="appmsg_add">
		            <a onclick="return false;" id="js_add_appmsg" href="javascript:void(0);">
		                &nbsp;
		                <i class="icon24_common add_gray">增加一条</i>
		            </a>
		        </div>
		    </div>
		</div>
	</div>
</div>
<div class="clearfix form-actions">
	<div class="col-xs-12 col-sm-9 col-sm-offset-3">
		<button class="btn btn-info" type="submit">
			<i class="icon-ok bigger-110"></i>
			提交
		</button>
		&nbsp; &nbsp;
		<font color="red">(提示：修改完后记得点击提交按钮。)</font>
	</div>
</div>
<?php echo $this->Form->hidden('WxDataTw.FType', array('id' => "FType", 'value' => 1)); ?>
<?php echo $this->Form->end(); ?>