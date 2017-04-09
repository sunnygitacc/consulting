<?php
App::uses('UserGroupProfilePic', 'Model');

/**
 * UserGroupProfilePic Test Case
 *
 */
class UserGroupProfilePicTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_group_profile_pic',
		'app.group',
		'app.sub_category',
		'app.category',
		'app.vertical',
		'app.user_category_relation',
		'app.user',
		'app.post_user_comment',
		'app.post',
		'app.user_post_view',
		'app.post_user_like',
		'app.user_award',
		'app.user_certification',
		'app.user_education',
		'app.user_event_action',
		'app.event',
		'app.user_group_follower',
		'app.user_group_relation',
		'app.role',
		'app.role_permission_relation',
		'app.permission',
		'app.user_log',
		'app.action',
		'app.wall',
		'app.user_mentor_follower',
		'app.mentor',
		'app.user_mentor_rating',
		'app.user_report_abus',
		'app.item',
		'app.user_work',
		'app.group_event',
		'app.createdby'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserGroupProfilePic = ClassRegistry::init('UserGroupProfilePic');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserGroupProfilePic);

		parent::tearDown();
	}

}
