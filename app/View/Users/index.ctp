<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('salt'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('dob'); ?></th>
			<th><?php echo $this->Paginator->sort('country'); ?></th>
			<th><?php echo $this->Paginator->sort('state'); ?></th>
			<th><?php echo $this->Paginator->sort('city'); ?></th>
			<th><?php echo $this->Paginator->sort('is_mentor'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('activate_key'); ?></th>
			<th><?php echo $this->Paginator->sort('activated'); ?></th>
			<th><?php echo $this->Paginator->sort('date_activated'); ?></th>
			<th><?php echo $this->Paginator->sort('date_created'); ?></th>
			<th><?php echo $this->Paginator->sort('date_updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['salt']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['gender']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['dob']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['country']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['state']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['city']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['is_mentor']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['status']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['activate_key']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['activated']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['date_activated']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['date_created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['date_updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Post User Comments'), array('controller' => 'post_user_comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post User Comment'), array('controller' => 'post_user_comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Post User Likes'), array('controller' => 'post_user_likes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post User Like'), array('controller' => 'post_user_likes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Awards'), array('controller' => 'user_awards', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Award'), array('controller' => 'user_awards', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Category Relations'), array('controller' => 'user_category_relations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Category Relation'), array('controller' => 'user_category_relations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Certifications'), array('controller' => 'user_certifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Certification'), array('controller' => 'user_certifications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Educations'), array('controller' => 'user_educations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Education'), array('controller' => 'user_educations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Event Actions'), array('controller' => 'user_event_actions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Event Action'), array('controller' => 'user_event_actions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Group Followers'), array('controller' => 'user_group_followers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Group Follower'), array('controller' => 'user_group_followers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Group Relations'), array('controller' => 'user_group_relations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Group Relation'), array('controller' => 'user_group_relations', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Logs'), array('controller' => 'user_logs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Log'), array('controller' => 'user_logs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Mentor Followers'), array('controller' => 'user_mentor_followers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Mentor Follower'), array('controller' => 'user_mentor_followers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Mentor Ratings'), array('controller' => 'user_mentor_ratings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Mentor Rating'), array('controller' => 'user_mentor_ratings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Post Views'), array('controller' => 'user_post_views', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Post View'), array('controller' => 'user_post_views', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Report Abuses'), array('controller' => 'user_report_abuses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Report Abus'), array('controller' => 'user_report_abuses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List User Works'), array('controller' => 'user_works', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Work'), array('controller' => 'user_works', 'action' => 'add')); ?> </li>
	</ul>
</div>
