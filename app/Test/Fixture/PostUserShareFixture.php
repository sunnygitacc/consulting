<?php
/**
 * PostUserShareFixture
 *
 */
class PostUserShareFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'primary'),
		'shareby_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'shareto_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true),
		'wall_type' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'is_private' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'date_shared' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'shareby_id' => array('column' => 'shareby_id', 'unique' => 0)
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
			'shareby_id' => 1,
			'shareto_id' => 1,
			'wall_type' => 1,
			'is_private' => 1,
			'date_shared' => '2015-05-23 07:02:01'
		),
	);

}
