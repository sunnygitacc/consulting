<?php
/**
 * UserGroupRelationFixture
 *
 */
class UserGroupRelationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false, 'key' => 'index'),
		'role_alias' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'rolesetby_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'invitedby_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'blockedbyid' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true, 'key' => 'index'),
		'date_requested' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_invited' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_joined' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_roleset' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_exited' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_blocked' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'user_id' => array('column' => 'user_id', 'unique' => 0),
			'rolesetby_id' => array('column' => 'rolesetby_id', 'unique' => 0),
			'invitedby_id' => array('column' => 'invitedby_id', 'unique' => 0),
			'blockedbyid' => array('column' => 'blockedbyid', 'unique' => 0),
			'group_id' => array('column' => 'group_id', 'unique' => 0),
			'role_id' => array('column' => 'role_id', 'unique' => 0)
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
			'user_id' => 1,
			'group_id' => 1,
			'role_id' => 1,
			'role_alias' => 'Lorem ipsum dolor ',
			'rolesetby_id' => 1,
			'status' => 1,
			'invitedby_id' => 1,
			'blockedbyid' => 1,
			'date_requested' => '2015-05-23 07:25:43',
			'date_invited' => '2015-05-23 07:25:43',
			'date_joined' => '2015-05-23 07:25:43',
			'date_roleset' => '2015-05-23 07:25:43',
			'date_exited' => '2015-05-23 07:25:43',
			'date_blocked' => '2015-05-23 07:25:43'
		),
	);

}
