<div class="install">
	<h2><?php echo $title_for_layout; ?></h2>

	<p class="success">
	<?php echo __d('croogo', '
		The user %s has been created with administrative rights.',
		sprintf('<strong>%s</strong>', $user['TPerson']['FMemberId']));
	?>
	</p>

	<p>
		<?php echo __d('croogo', '系统后台: %s', $this->Html->link(Router::url('/admin', true), Router::url('/', true))); ?>
	</p>

	<blockquote>
		<h3><?php echo __d('croogo', 'Resources'); ?></h3>
		<ul class="bullet">
			<li><?php echo $this->Html->link('http://cakewx.com'); ?></li>
			<li><?php echo $this->Html->link('http://github.com/cakewx'); ?></li>
		</ul>
	</blockquote>
	&nbsp;
</div>