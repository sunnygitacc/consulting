<?php
App::uses('UserAward', 'Model');

/**
 * UserAward Test Case
 *
 */
class UserAwardTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_award',
		'app.user',
		'app.post_user_comment',
		'app.post',
		'app.postby',
		'app.postto',
		'app.post_type',
		'app.user_post_view',
		'app.post_user_like',
		'app.item',
		'app.user_category_relation',
		'app.user_certification',
		'app.user_education',
		'app.user_event_action',
		'app.user_group_follower',
		'app.user_group_relation',
		'app.user_log',
		'app.user_mentor_follower',
		'app.user_mentor_rating',
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
		$this->UserAward = ClassRegistry::init('UserAward');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserAward);

		parent::tearDown();
	}

}
