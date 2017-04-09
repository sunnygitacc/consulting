<?php
App::uses('PostUserShare', 'Model');

/**
 * PostUserShare Test Case
 *
 */
class PostUserShareTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post_user_share',
		'app.shareby',
		'app.shareto'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PostUserShare = ClassRegistry::init('PostUserShare');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PostUserShare);

		parent::tearDown();
	}

}
