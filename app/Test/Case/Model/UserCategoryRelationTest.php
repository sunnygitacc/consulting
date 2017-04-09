<?php
App::uses('UserCategoryRelation', 'Model');

/**
 * UserCategoryRelation Test Case
 *
 */
class UserCategoryRelationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user_category_relation',
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
		'app.sub_category',
		'app.category',
		'app.vertical',
		'app.group',
		'app.createdby',
		'app.group_event'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UserCategoryRelation = ClassRegistry::init('UserCategoryRelation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UserCategoryRelation);

		parent::tearDown();
	}

}
