<?php
$this->Html->css(array(
"Mobile/events"
), null, array('block' => "css_extra", 'inline' => false));
?>
<div class="coverimg"><img src="<?php echo Router::url($post['cover'], TRUE); ?>" /></div>
<div class="page-bizinfo">
    <div class="header">
        <h1 id="activity-name"><?php echo $post['title'] ?></h1>
        <p><span class="glyphicon glyphicon-time"></span><span>活动时间：</span><?php echo $post['start'] ?></p>
        <p><span>人数限制：</span><?php echo $post['maxpercount'] ?></p>
        <p><span>活动地点：</span><?php echo $post['address'] ?></p>
        <p><span>已报名人数：</span><?php echo $post['percount'] ?></p>
        <div class="col-6">
            <button id="reg_event_btn_enabled" class="btn btn-success" onclick="startRegisterEvent()">我要报名</button>
        </div>
        <div id="event_register_step2" style="font-size: 12px; -webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);">
            <div id="valid_login_code_msg" class="warning" style="display:none;margin-bottom:10px;"></div>
            <form id="contact_valid_form" action="/login2" method="POST" data-abide="" prevent-submit="true" novalidate="">
                <input type="hidden" name="ex_category" id="ex_category" value="0">
                <input type="hidden" name="ex_special" id="ex_special" value="2219965030000;7801504475088">
                <div class="infoitem">
                    <label class="titlelabel">邮箱或手机<font style="color:red;">&nbsp;*</font></label>
                    <input type="text" placeholder="您的手机号或者邮箱" id="valid_login_contact" class="form-control required" required="" value="" onblur="javascript:changeLoginContact(this);" data-validation-message="帐号格式错误" data-validation-type="warning">
                </div>
                <div class="infoitem">
                    <label class="titlelabel">姓名<font style="color:red;">&nbsp;*</font></label>
                    <input type="text" name="RegName" placeholder="请填写您的姓名" class="form-control required" required="" maxlength="10" data-validation-message="请填写您的姓名" data-validation-type="warning">
                </div>
                <div class="infoitem">
                    <label class="titlelabel">留言</label>
                    <textarea name="message" value="Your Message" id="message" class="form-control" placeholder="输入留言..." style="height: 55px; overflow: hidden;"></textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary" onclick="javascript:loginSubmit();return false;">发送</button>
                </div>
            </form>
        </div>
        <p class="activity-info">
            <span id="post-date" class="activity-meta no-extra"><?php echo  $post['dateline'] ?></span>
            <a href="javascript:viewProfile();" id="post-user" class="activity-meta">
                <span class="text-ellipsis"><?php echo $post['author'] ?></span><i class="icon_link_arrow"></i>
            </a>
        </p>
    </div>
</div>
<div id="page-content" class="page-content">
    <div id="img-content">
        <div class="text"><?php echo $post['content'] ?></div>
    </div>
</div>