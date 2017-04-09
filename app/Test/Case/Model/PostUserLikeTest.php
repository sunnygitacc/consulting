<?php
App::uses('PostUserLike', 'Model');

/**
 * PostUserLike Test Case
 *
 */
class PostUserLikeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post_user_like',
		'app.user',
		'app.post_user_comment',
		'app.post',
		'app.postby',
		'app.postto',
		'app.post_type',
		'app.user_post_view',
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
		'app.user_report_abus',
		'app.user_work',
		'app.item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PostUserLike = ClassRegistry::init('PostUserLike');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PostUserLike);

		parent::tearDown();
	}

}
