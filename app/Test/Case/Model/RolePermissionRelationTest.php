<?php
App::uses('RolePermissionRelation', 'Model');

/**
 * RolePermissionRelation Test Case
 *
 */
class RolePermissionRelationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.role_permission_relation',
		'app.permission',
		'app.role'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RolePermissionRelation = ClassRegistry::init('RolePermissionRelation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RolePermissionRelation);

		parent::tearDown();
	}

}
