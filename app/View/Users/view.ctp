<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Salt'); ?></dt>
		<dd>
			<?php echo h($user['User']['salt']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($user['User']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Dob'); ?></dt>
		<dd>
			<?php echo h($user['User']['dob']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($user['User']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo h($user['User']['state']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($user['User']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Mentor'); ?></dt>
		<dd>
			<?php echo h($user['User']['is_mentor']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($user['User']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activate Key'); ?></dt>
		<dd>
			<?php echo h($user['User']['activate_key']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activated'); ?></dt>
		<dd>
			<?php echo h($user['User']['activated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Activated'); ?></dt>
		<dd>
			<?php echo h($user['User']['date_activated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['date_created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Updated'); ?></dt>
		<dd>
			<?php echo h($user['User']['date_updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Post User Comments'); ?></h3>
	<?php if (!empty($user['PostUserComment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Post Id'); ?></th>
		<th><?php echo __('Comment'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Deletedby Id'); ?></th>
		<th><?php echo __('Date Commented'); ?></th>
		<th><?php echo __('Date Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['PostUserComment'] as $postUserComment): ?>
		<tr>
			<td><?php echo $postUserComment['id']; ?></td>
			<td><?php echo $postUserComment['user_id']; ?></td>
			<td><?php echo $postUserComment['post_id']; ?></td>
			<td><?php echo $postUserComment['comment']; ?></td>
			<td><?php echo $postUserComment['status']; ?></td>
			<td><?php echo $postUserComment['deletedby_id']; ?></td>
			<td><?php echo $postUserComment['date_commented']; ?></td>
			<td><?php echo $postUserComment['date_deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'post_user_comments', 'action' => 'view', $postUserComment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'post_user_comments', 'action' => 'edit', $postUserComment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'post_user_comments', 'action' => 'delete', $postUserComment['id']), array(), __('Are you sure you want to delete # %s?', $postUserComment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Post User Comment'), array('controller' => 'post_user_comments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Post User Likes'); ?></h3>
	<?php if (!empty($user['PostUserLike'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Item Type'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Date Liked'); ?></th>
		<th><?php echo __('Date Unliked'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['PostUserLike'] as $postUserLike): ?>
		<tr>
			<td><?php echo $postUserLike['id']; ?></td>
			<td><?php echo $postUserLike['user_id']; ?></td>
			<td><?php echo $postUserLike['item_id']; ?></td>
			<td><?php echo $postUserLike['item_type']; ?></td>
			<td><?php echo $postUserLike['status']; ?></td>
			<td><?php echo $postUserLike['date_liked']; ?></td>
			<td><?php echo $postUserLike['date_unliked']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'post_user_likes', 'action' => 'view', $postUserLike['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'post_user_likes', 'action' => 'edit', $postUserLike['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'post_user_likes', 'action' => 'delete', $postUserLike['id']), array(), __('Are you sure you want to delete # %s?', $postUserLike['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Post User Like'), array('controller' => 'post_user_likes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Awards'); ?></h3>
	<?php if (!empty($user['UserAward'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Award'); ?></th>
		<th><?php echo __('Authority'); ?></th>
		<th><?php echo __('Date Awarded'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserAward'] as $userAward): ?>
		<tr>
			<td><?php echo $userAward['id']; ?></td>
			<td><?php echo $userAward['user_id']; ?></td>
			<td><?php echo $userAward['award']; ?></td>
			<td><?php echo $userAward['authority']; ?></td>
			<td><?php echo $userAward['date_awarded']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_awards', 'action' => 'view', $userAward['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_awards', 'action' => 'edit', $userAward['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_awards', 'action' => 'delete', $userAward['id']), array(), __('Are you sure you want to delete # %s?', $userAward['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Award'), array('controller' => 'user_awards', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Category Relations'); ?></h3>
	<?php if (!empty($user['UserCategoryRelation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Sub Category Id'); ?></th>
		<th><?php echo __('Vertical Id'); ?></th>
		<th><?php echo __('Is Mentor'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Date Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserCategoryRelation'] as $userCategoryRelation): ?>
		<tr>
			<td><?php echo $userCategoryRelation['id']; ?></td>
			<td><?php echo $userCategoryRelation['user_id']; ?></td>
			<td><?php echo $userCategoryRelation['sub_category_id']; ?></td>
			<td><?php echo $userCategoryRelation['vertical_id']; ?></td>
			<td><?php echo $userCategoryRelation['is_mentor']; ?></td>
			<td><?php echo $userCategoryRelation['status']; ?></td>
			<td><?php echo $userCategoryRelation['date_updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_category_relations', 'action' => 'view', $userCategoryRelation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_category_relations', 'action' => 'edit', $userCategoryRelation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_category_relations', 'action' => 'delete', $userCategoryRelation['id']), array(), __('Are you sure you want to delete # %s?', $userCategoryRelation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Category Relation'), array('controller' => 'user_category_relations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Certifications'); ?></h3>
	<?php if (!empty($user['UserCertification'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Certification'); ?></th>
		<th><?php echo __('Authority'); ?></th>
		<th><?php echo __('Date Certified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserCertification'] as $userCertification): ?>
		<tr>
			<td><?php echo $userCertification['id']; ?></td>
			<td><?php echo $userCertification['user_id']; ?></td>
			<td><?php echo $userCertification['certification']; ?></td>
			<td><?php echo $userCertification['authority']; ?></td>
			<td><?php echo $userCertification['date_certified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_certifications', 'action' => 'view', $userCertification['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_certifications', 'action' => 'edit', $userCertification['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_certifications', 'action' => 'delete', $userCertification['id']), array(), __('Are you sure you want to delete # %s?', $userCertification['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Certification'), array('controller' => 'user_certifications', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Educations'); ?></h3>
	<?php if (!empty($user['UserEducation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Education'); ?></th>
		<th><?php echo __('Institute'); ?></th>
		<th><?php echo __('University'); ?></th>
		<th><?php echo __('Date From'); ?></th>
		<th><?php echo __('Date To'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserEducation'] as $userEducation): ?>
		<tr>
			<td><?php echo $userEducation['id']; ?></td>
			<td><?php echo $userEducation['user_id']; ?></td>
			<td><?php echo $userEducation['education']; ?></td>
			<td><?php echo $userEducation['institute']; ?></td>
			<td><?php echo $userEducation['university']; ?></td>
			<td><?php echo $userEducation['date_from']; ?></td>
			<td><?php echo $userEducation['date_to']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_educations', 'action' => 'view', $userEducation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_educations', 'action' => 'edit', $userEducation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_educations', 'action' => 'delete', $userEducation['id']), array(), __('Are you sure you want to delete # %s?', $userEducation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Education'), array('controller' => 'user_educations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Event Actions'); ?></h3>
	<?php if (!empty($user['UserEventAction'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Event Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Date Acted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserEventAction'] as $userEventAction): ?>
		<tr>
			<td><?php echo $userEventAction['id']; ?></td>
			<td><?php echo $userEventAction['user_id']; ?></td>
			<td><?php echo $userEventAction['event_id']; ?></td>
			<td><?php echo $userEventAction['status']; ?></td>
			<td><?php echo $userEventAction['date_acted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_event_actions', 'action' => 'view', $userEventAction['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_event_actions', 'action' => 'edit', $userEventAction['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_event_actions', 'action' => 'delete', $userEventAction['id']), array(), __('Are you sure you want to delete # %s?', $userEventAction['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Event Action'), array('controller' => 'user_event_actions', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Group Followers'); ?></h3>
	<?php if (!empty($user['UserGroupFollower'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Groupid'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Date Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserGroupFollower'] as $userGroupFollower): ?>
		<tr>
			<td><?php echo $userGroupFollower['id']; ?></td>
			<td><?php echo $userGroupFollower['user_id']; ?></td>
			<td><?php echo $userGroupFollower['groupid']; ?></td>
			<td><?php echo $userGroupFollower['status']; ?></td>
			<td><?php echo $userGroupFollower['date_updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_group_followers', 'action' => 'view', $userGroupFollower['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_group_followers', 'action' => 'edit', $userGroupFollower['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_group_followers', 'action' => 'delete', $userGroupFollower['id']), array(), __('Are you sure you want to delete # %s?', $userGroupFollower['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Group Follower'), array('controller' => 'user_group_followers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Group Relations'); ?></h3>
	<?php if (!empty($user['UserGroupRelation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('Role Id'); ?></th>
		<th><?php echo __('Role Alias'); ?></th>
		<th><?php echo __('Rolesetby Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Invitedby Id'); ?></th>
		<th><?php echo __('Blockedbyid'); ?></th>
		<th><?php echo __('Date Requested'); ?></th>
		<th><?php echo __('Date Invited'); ?></th>
		<th><?php echo __('Date Joined'); ?></th>
		<th><?php echo __('Date Roleset'); ?></th>
		<th><?php echo __('Date Exited'); ?></th>
		<th><?php echo __('Date Blocked'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserGroupRelation'] as $userGroupRelation): ?>
		<tr>
			<td><?php echo $userGroupRelation['id']; ?></td>
			<td><?php echo $userGroupRelation['user_id']; ?></td>
			<td><?php echo $userGroupRelation['group_id']; ?></td>
			<td><?php echo $userGroupRelation['role_id']; ?></td>
			<td><?php echo $userGroupRelation['role_alias']; ?></td>
			<td><?php echo $userGroupRelation['rolesetby_id']; ?></td>
			<td><?php echo $userGroupRelation['status']; ?></td>
			<td><?php echo $userGroupRelation['invitedby_id']; ?></td>
			<td><?php echo $userGroupRelation['blockedbyid']; ?></td>
			<td><?php echo $userGroupRelation['date_requested']; ?></td>
			<td><?php echo $userGroupRelation['date_invited']; ?></td>
			<td><?php echo $userGroupRelation['date_joined']; ?></td>
			<td><?php echo $userGroupRelation['date_roleset']; ?></td>
			<td><?php echo $userGroupRelation['date_exited']; ?></td>
			<td><?php echo $userGroupRelation['date_blocked']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_group_relations', 'action' => 'view', $userGroupRelation['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_group_relations', 'action' => 'edit', $userGroupRelation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_group_relations', 'action' => 'delete', $userGroupRelation['id']), array(), __('Are you sure you want to delete # %s?', $userGroupRelation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Group Relation'), array('controller' => 'user_group_relations', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Logs'); ?></h3>
	<?php if (!empty($user['UserLog'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Action Id'); ?></th>
		<th><?php echo __('Wall Id'); ?></th>
		<th><?php echo __('Wall Type'); ?></th>
		<th><?php echo __('Extras'); ?></th>
		<th><?php echo __('Ip Address'); ?></th>
		<th><?php echo __('Date Viewed'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserLog'] as $userLog): ?>
		<tr>
			<td><?php echo $userLog['id']; ?></td>
			<td><?php echo $userLog['user_id']; ?></td>
			<td><?php echo $userLog['action_id']; ?></td>
			<td><?php echo $userLog['wall_id']; ?></td>
			<td><?php echo $userLog['wall_type']; ?></td>
			<td><?php echo $userLog['extras']; ?></td>
			<td><?php echo $userLog['ip_address']; ?></td>
			<td><?php echo $userLog['date_viewed']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_logs', 'action' => 'view', $userLog['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_logs', 'action' => 'edit', $userLog['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_logs', 'action' => 'delete', $userLog['id']), array(), __('Are you sure you want to delete # %s?', $userLog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Log'), array('controller' => 'user_logs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Mentor Followers'); ?></h3>
	<?php if (!empty($user['UserMentorFollower'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Mentor Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Date Updated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserMentorFollower'] as $userMentorFollower): ?>
		<tr>
			<td><?php echo $userMentorFollower['id']; ?></td>
			<td><?php echo $userMentorFollower['user_id']; ?></td>
			<td><?php echo $userMentorFollower['mentor_id']; ?></td>
			<td><?php echo $userMentorFollower['status']; ?></td>
			<td><?php echo $userMentorFollower['date_updated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_mentor_followers', 'action' => 'view', $userMentorFollower['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_mentor_followers', 'action' => 'edit', $userMentorFollower['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_mentor_followers', 'action' => 'delete', $userMentorFollower['id']), array(), __('Are you sure you want to delete # %s?', $userMentorFollower['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Mentor Follower'), array('controller' => 'user_mentor_followers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Mentor Ratings'); ?></h3>
	<?php if (!empty($user['UserMentorRating'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Mentor Id'); ?></th>
		<th><?php echo __('Rating'); ?></th>
		<th><?php echo __('Date Rated'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserMentorRating'] as $userMentorRating): ?>
		<tr>
			<td><?php echo $userMentorRating['id']; ?></td>
			<td><?php echo $userMentorRating['user_id']; ?></td>
			<td><?php echo $userMentorRating['mentor_id']; ?></td>
			<td><?php echo $userMentorRating['rating']; ?></td>
			<td><?php echo $userMentorRating['date_rated']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_mentor_ratings', 'action' => 'view', $userMentorRating['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_mentor_ratings', 'action' => 'edit', $userMentorRating['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_mentor_ratings', 'action' => 'delete', $userMentorRating['id']), array(), __('Are you sure you want to delete # %s?', $userMentorRating['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Mentor Rating'), array('controller' => 'user_mentor_ratings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Post Views'); ?></h3>
	<?php if (!empty($user['UserPostView'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Post Id'); ?></th>
		<th><?php echo __('Ip Address'); ?></th>
		<th><?php echo __('Date Viewed'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserPostView'] as $userPostView): ?>
		<tr>
			<td><?php echo $userPostView['id']; ?></td>
			<td><?php echo $userPostView['user_id']; ?></td>
			<td><?php echo $userPostView['post_id']; ?></td>
			<td><?php echo $userPostView['ip_address']; ?></td>
			<td><?php echo $userPostView['date_viewed']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_post_views', 'action' => 'view', $userPostView['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_post_views', 'action' => 'edit', $userPostView['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_post_views', 'action' => 'delete', $userPostView['id']), array(), __('Are you sure you want to delete # %s?', $userPostView['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Post View'), array('controller' => 'user_post_views', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Report Abuses'); ?></h3>
	<?php if (!empty($user['UserReportAbus'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Item Id'); ?></th>
		<th><?php echo __('Item Type'); ?></th>
		<th><?php echo __('Date Reported'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserReportAbus'] as $userReportAbus): ?>
		<tr>
			<td><?php echo $userReportAbus['id']; ?></td>
			<td><?php echo $userReportAbus['user_id']; ?></td>
			<td><?php echo $userReportAbus['item_id']; ?></td>
			<td><?php echo $userReportAbus['item_type']; ?></td>
			<td><?php echo $userReportAbus['date_reported']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_report_abuses', 'action' => 'view', $userReportAbus['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_report_abuses', 'action' => 'edit', $userReportAbus['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_report_abuses', 'action' => 'delete', $userReportAbus['id']), array(), __('Are you sure you want to delete # %s?', $userReportAbus['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Report Abus'), array('controller' => 'user_report_abuses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related User Works'); ?></h3>
	<?php if (!empty($user['UserWork'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Company'); ?></th>
		<th><?php echo __('Jobtitle'); ?></th>
		<th><?php echo __('Date From'); ?></th>
		<th><?php echo __('Date To'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['UserWork'] as $userWork): ?>
		<tr>
			<td><?php echo $userWork['id']; ?></td>
			<td><?php echo $userWork['user_id']; ?></td>
			<td><?php echo $userWork['company']; ?></td>
			<td><?php echo $userWork['jobtitle']; ?></td>
			<td><?php echo $userWork['date_from']; ?></td>
			<td><?php echo $userWork['date_to']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'user_works', 'action' => 'view', $userWork['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'user_works', 'action' => 'edit', $userWork['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'user_works', 'action' => 'delete', $userWork['id']), array(), __('Are you sure you want to delete # %s?', $userWork['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New User Work'), array('controller' => 'user_works', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
