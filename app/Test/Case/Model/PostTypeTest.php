<?php
App::uses('PostType', 'Model');

/**
 * PostType Test Case
 *
 */
class PostTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post_type',
		'app.post',
		'app.user',
		'app.post_user_comment',
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
		'app.user_group_relation',
		'app.role',
		'app.role_permission_relation',
		'app.permission',
		'app.user_certification',
		'app.user_education',
		'app.user_event_action',
		'app.event',
		'app.user_group_follower',
		'app.user_log',
		'app.action',
		'app.wall',
		'app.user_mentor_follower',
		'app.mentor',
		'app.user_mentor_rating',
		'app.user_post_view',
		'app.user_report_abus',
		'app.user_work'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PostType = ClassRegistry::init('PostType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PostType);

		parent::tearDown();
	}

}