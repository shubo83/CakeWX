<?php
	$this->extend('/Common/Admin/index');
	
	// load css
	$this->Html->css(array(
		"/assets/css/dropzone"
	), null, array('block' => "css_extra", 'inline' => false));
	
	// load script
	$this->Html->script(array(
		"/assets/js/dropzone.min",
		"Action/mFile"
	), array('block' => "script_extra", 'inline' => false));
?>
<div id="dropzone">
	<?php 
	$this->Form->inputDefaults(array('label' => true, 'div' => true));
	echo $this->Form->create('lib', array('url' => array('controller' => "lib", 'action' => "picUpload"), 'name' => "form1", 'role' => "form", 'class' => "dropzone")); 
	?>
		<div class="fallback">
			<input name="file" type="file" multiple="" />
		</div>
	<?php echo $this->Form->end(); ?>
</div>
