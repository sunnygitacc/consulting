<?php
App::uses('GroupGroupConnect', 'Model');

/**
 * GroupGroupConnect Test Case
 *
 */
class GroupGroupConnectTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.group_group_connect',
		'app.requestby_user',
		'app.actionby_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GroupGroupConnect = ClassRegistry::init('GroupGroupConnect');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GroupGroupConnect);

		parent::tearDown();
	}

}
