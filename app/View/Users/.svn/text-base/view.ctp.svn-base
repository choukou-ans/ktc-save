<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Login'); ?></dt>
		<dd>
			<?php echo h($user['User']['login']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Employee Num'); ?></dt>
		<dd>
			<?php echo h($user['User']['employee_num']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('M Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['MRole']['name'], array('controller' => 'm_roles', 'action' => 'view', $user['MRole']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Company Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['company_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($user['User']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Del Flag'); ?></dt>
		<dd>
			<?php echo h($user['User']['del_flag']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List M Roles'), array('controller' => 'm_roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New M Role'), array('controller' => 'm_roles', 'action' => 'add')); ?> </li>
	</ul>
</div>
