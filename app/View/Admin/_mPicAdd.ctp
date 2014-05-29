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
<h3 class="lighter block green" style="margin-bottom: 25px">
	请选择要添加的图文类型：
</h3>
<?php 
$this->Form->inputDefaults(array('label' => true, 'div' => true));
?>
<div class="row">
	<div class="col-sm-12">
		<div class="well">
			<h4 class="blue smaller lighter"><?php echo $this->Html->link('单图文', "{$WC_URL}?_m=tw&_a=add"); ?></h4>
			发布文章类型的单图文展示页面，普通文章，适用公司简介，联系方式等信息的展示。
		</div>
		<div class="well">
			<h4 class="blue smaller lighter"><?php echo $this->Html->link('多图文', "{$WC_URL}?_m=twj&_a=add"); ?></h4>
			发布文章类型的图文集，普通文章，适用等产品信息介绍，广告等内容的展示。
		</div>
		<div class="well">
			<h4 class="blue smaller lighter"><?php echo $this->Html->link('活动图文', "{$WC_URL}?_m=event&_a=add"); ?></h4>
			发布活动类型的单图文，活动详细页展示您定义的活动，有刮刮卡，大转盘，优惠券，及活动报名，成员审核，活动管理等。
		</div>
		<div class="well">
			<h4 class="grey smaller lighter">投票图文（即将上线）</h4>
			发布投票，用户可以投票该自定义内容，可以查看投票结果。
		</div>
		<div class="well">
			<h4 class="grey smaller lighter">问卷调查图文（即将上线）</h4>
			发布问卷调查，用户可以填写问卷调查，您可以得到调查反馈。
		</div>
		<div class="well">
			<h4 class="grey smaller lighter">在线预定图文（即将上线）</h4>
			发布预定，用户可以预定您的项目，并且您可以查看用户填写的内容，并第一时间取得联系。
		</div>
		<div class="well">
			<h4 class="grey smaller lighter">留言图文（即将上线）</h4>
			发布留言板功能，用户可以给你的产品或者店面进行留言反馈。
		</div>
	</div>
</div>
<?php echo $this->Form->end(); ?>