<?php
/**
 * CategoryFixture
 *
 */
class CategoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'vertical_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false, 'key' => 'index'),
		'has_fans' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'type' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'vertical_id' => array('column' => 'vertical_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor ',
			'vertical_id' => 1,
			'has_fans' => 1,
			'type' => 1,
			'date_created' => '2015-05-22 16:41:30'
		),
	);

}
