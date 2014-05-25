<?php
	$navTitle = isset($WC_data['WxWebchat']['FName']) ? "{$cakeSign}&nbsp;»<span style='margin-left:5px;font-size:16px'>".$WC_data['WxWebchat']['FName']."</span>" : $cakeSign;
?>
<div class="navbar navbar-default" id="navbar">
	<script type="text/javascript">
		try{ace.settings.check('navbar' , 'fixed')}catch(e){}
	</script>

	<div class="navbar-container" id="navbar-container">
		<div class="navbar-header pull-left">
			<a href="<?= $uid ? Router::url(array('controller' => "admin", 'action' => "index")) : Router::url("/") ?>" class="navbar-brand">
				<small>
					<i class="icon-comments"></i>
					<?= $navTitle ?>
				</small>
			</a><!-- /.brand -->
		</div><!-- /.navbar-header -->

		<div class="navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
				<? if ($uid): ?>
				<li class="light-blue">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<? //$this->Html->image('/assets/avatars/user.jpg', array('class' => "nav-user-photo", 'alt' => "Jason's Photo")); ?>
						<span class="user-info">
							<small>欢迎您,</small>
							<?= $name ?>
						</span>

						<i class="icon-caret-down"></i>
					</a>

					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<!-- <li>
												<a href="#">
													<i class="icon-cog"></i>
													Settings
												</a>
											</li> -->

						<li>
							<?php echo $this->Html->link($this->Html->tag('i', "", array('class' => "icon-user")).'个人资料', array('controller' => "admin", 'action' => "basic"),  array('escape' => false)); ?>
						</li>

						<li class="divider"></li>

						<li>
							<?php echo $this->Html->link($this->Html->tag('i', "", array('class' => "icon-off")).'退出', array('controller' => "user", 'action' => "loggout"),  array('escape' => false)); ?>
						</li>
					</ul>
				</li>
				<? endif ?>
			</ul><!-- /.ace-nav -->
		</div><!-- /.navbar-header -->
	</div><!-- /.container -->
</div>