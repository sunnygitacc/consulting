<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'salt' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'gender' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'dob' => array('type' => 'date', 'null' => false, 'default' => null),
		'country' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5, 'unsigned' => true, 'key' => 'index'),
		'state' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 5, 'unsigned' => true, 'key' => 'index'),
		'city' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'is_mentor' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'activate_key' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'activated' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'date_activated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'country' => array('column' => 'country', 'unique' => 0),
			'state' => array('column' => 'state', 'unique' => 0),
			'city' => array('column' => 'city', 'unique' => 0)
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
			'first_name' => 'Lorem ipsum dolor ',
			'last_name' => 'Lorem ipsum dolor ',
			'email' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'salt' => 'Lorem ipsum dolor sit amet',
			'gender' => 'Lorem ipsum dolor sit ame',
			'dob' => '2015-05-22',
			'country' => 1,
			'state' => 1,
			'city' => 1,
			'is_mentor' => 1,
			'status' => 1,
			'activate_key' => 'Lorem ipsum dolor sit amet',
			'activated' => 1,
			'date_activated' => '2015-05-22 16:50:33',
			'date_created' => '2015-05-22 16:50:33',
			'date_updated' => '2015-05-22 16:50:33'
		),
	);

}
