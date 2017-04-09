<?php
App::uses('SubCategory', 'Model');

/**
 * SubCategory Test Case
 *
 */
class SubCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.sub_category',
		'app.category',
		'app.vertical',
		'app.group',
		'app.user_category_relation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SubCategory = ClassRegistry::init('SubCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SubCategory);

		parent::tearDown();
	}

}
