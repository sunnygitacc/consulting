<?php
App::uses('UserCertification', 'Model');

/**
 * UserCertification Test Case
 *
 */
class UserCertificationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_certification',
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
		'app.user_group_relation',
		'app.user_education',
		'app.user_event_action',
		'app.user_group_follower',
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
		$this->UserCertification = ClassRegistry::init('UserCertification');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserCertification);

		parent::tearDown();
	}

}
