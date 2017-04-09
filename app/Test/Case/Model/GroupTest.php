<?php
App::uses('Group', 'Model');

/**
 * Group Test Case
 *
 */
class GroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.group',
		'app.sub_category',
		'app.category',
		'app.vertical',
		'app.user_category_relation',
		'app.createdby',
		'app.group_event',
		'app.user_group_relation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Group = ClassRegistry::init('Group');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Group);

		parent::tearDown();
	}

}
