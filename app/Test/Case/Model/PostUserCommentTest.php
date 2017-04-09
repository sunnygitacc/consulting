<?php
App::uses('PostUserComment', 'Model');

/**
 * PostUserComment Test Case
 *
 */
class PostUserCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post_user_comment',
		'app.user',
		'app.post_user_like',
		'app.user_award',
		'app.user_category_relation',
		'app.user_certification',
		'app.user_education',
		'app.user_event_action',
		'app.user_group_follower',
		'app.user_group_relation',
		'app.user_log',
		'app.user_mentor_follower',
		'app.user_mentor_rating',
		'app.user_post_view',
		'app.user_report_abus',
		'app.user_work',
		'app.post',
		'app.postby',
		'app.postto',
		'app.post_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PostUserComment = ClassRegistry::init('PostUserComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PostUserComment);

		parent::tearDown();
	}

}
