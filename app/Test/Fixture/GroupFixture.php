<?php
/**
 * GroupFixture
 *
 */
class GroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'sub_category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'type' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'createdby_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'updatedby_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => false),
		'date_updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'sub_category_id' => array('column' => 'sub_category_id', 'unique' => 0)
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
			'description' => 'Lorem ipsum dolor ',
			'sub_category_id' => 1,
			'type' => 1,
			'status' => 1,
			'createdby_id' => 1,
			'date_created' => '2015-05-22 17:01:34',
			'updatedby_id' => 1,
			'date_updated' => '2015-05-22 17:01:34'
		),
	);

}
