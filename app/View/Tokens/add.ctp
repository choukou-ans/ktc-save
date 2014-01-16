<div class="tokens form">
<?php echo $this->Form->create('Token'); ?>
	<fieldset>
		<legend><?php echo __('Add Token'); ?></legend>
	<?php
		echo $this->Form->input('token');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Tokens'), array('action' => 'index')); ?></li>
	</ul>
</div>
