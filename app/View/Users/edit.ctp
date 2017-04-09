<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('salt');
		echo $this->Form->input('gender');
		echo $this->Form->input('dob');
		echo $this->Form->input('country');
		echo $this->Form->input('state');
		echo $this->Form->input('city');
		echo $this->Form->input('is_mentor');
		echo $this->Form->input('status');
		echo $this->Form->input('activate_key');
		echo $this->Form->input('activated');
		echo $this->Form->input('date_activated');
		echo $this->Form->input('date_created');
		echo $this->Form->input('date_updated');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
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
