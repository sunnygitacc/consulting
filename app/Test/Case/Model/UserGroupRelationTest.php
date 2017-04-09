<?php
App::uses('UserGroupRelation', 'Model');

/**
 * UserGroupRelation Test Case
 *
 */
class UserGroupRelationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_group_relation',
		'app.user',
		'app.post_user_comment',
		'app.post',
		'app.postby',
		'app.postto',
		'app.post_type',
		'app.user_post_view',
		'app.post_user_like',
		'app.item',
		'app.user_award',
		'app.user_category_relation',
		'app.sub_category',
		'app.category',
		'app.vertical',
		'app.group',
		'app.createdby',
		'app.group_event',
		'app.user_certification',
		'app.user_education',
		'app.user_event_action',
		'app.event',
		'app.user_group_follower',
		'app.user_log',
		'app.user_mentor_follower',
		'app.user_mentor_rating',
		'app.user_report_abus',
		'app.user_work',
		'app.role',
		'app.role_permission_relation',
		'app.permission'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserGroupRelation = ClassRegistry::init('UserGroupRelation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserGroupRelation);

		parent::tearDown();
	}

}
