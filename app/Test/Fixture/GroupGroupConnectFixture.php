<?php
/**
 * GroupGroupConnectFixture
 *
 */
class GroupGroupConnectFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'group_id_from' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'group_id_to' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'requestby_user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'request_status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false),
		'actionby_user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'date_requested' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_action' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'group_id_from' => array('column' => 'group_id_from', 'unique' => 0),
			'group_id_to' => array('column' => 'group_id_to', 'unique' => 0),
			'requestby_user_id' => array('column' => 'requestby_user_id', 'unique' => 0),
			'actionby_user_id' => array('column' => 'actionby_user_id', 'unique' => 0)
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
			'group_id_from' => 1,
			'group_id_to' => 1,
			'requestby_user_id' => 1,
			'request_status' => 1,
			'actionby_user_id' => 1,
			'date_requested' => '2015-05-22 17:06:20',
			'date_action' => '2015-05-22 17:06:20'
		),
	);

}
