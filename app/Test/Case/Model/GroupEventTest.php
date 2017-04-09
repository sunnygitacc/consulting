<?php
App::uses('GroupEvent', 'Model');

/**
 * GroupEvent Test Case
 *
 */
class GroupEventTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.group_event',
		'app.group',
		'app.sub_category',
		'app.category',
		'app.vertical',
		'app.user_category_relation',
		'app.createdby',
		'app.user_group_relation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GroupEvent = ClassRegistry::init('GroupEvent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GroupEvent);

		parent::tearDown();
	}

}
