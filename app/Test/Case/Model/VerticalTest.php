<?php
App::uses('Vertical', 'Model');

/**
 * Vertical Test Case
 *
 */
class VerticalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.vertical',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Vertical = ClassRegistry::init('Vertical');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Vertical);

		parent::tearDown();
	}

}
