<?php
/**
 * UserGroupProfilePicFixture
 *
 */
class UserGroupProfilePicFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'wall_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true),
		'wall_type' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'link' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'is_avatar' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'is_active' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'date_shared' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'wall_id' => 1,
			'wall_type' => 1,
			'link' => 'Lorem ipsum dolor sit amet',
			'is_avatar' => 1,
			'is_active' => 1,
			'date_shared' => '2015-06-11 14:03:30'
		),
	);

}
