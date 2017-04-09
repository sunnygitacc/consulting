<?php
/**
 * UserFriendFixture
 *
 */
class UserFriendFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'user_id_a' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'user_id_b' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'request_status' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'date_requested' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_activated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id_a' => array('column' => 'user_id_a', 'unique' => 0),
			'user_id_b' => array('column' => 'user_id_b', 'unique' => 0)
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
			'user_id_a' => 1,
			'user_id_b' => 1,
			'request_status' => 1,
			'date_requested' => '2015-05-23 07:20:30',
			'date_activated' => '2015-05-23 07:20:30'
		),
	);

}
