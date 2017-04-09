<?php
App::uses('LogActionType', 'Model');

/**
 * LogActionType Test Case
 *
 */
class LogActionTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.log_action_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LogActionType = ClassRegistry::init('LogActionType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LogActionType);

		parent::tearDown();
	}

}
