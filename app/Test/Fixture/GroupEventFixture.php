<?php
/**
 * GroupEventFixture
 *
 */
class GroupEventFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => false, 'key' => 'primary'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'event_start' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'event_end' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 3, 'unsigned' => false),
		'createdby_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true),
		'modifiedby_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => true),
		'date_created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'group_id' => array('column' => 'group_id', 'unique' => 0)
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
			'group_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'event_start' => '2015-05-22 17:05:04',
			'event_end' => '2015-05-22 17:05:04',
			'status' => 1,
			'createdby_id' => 1,
			'modifiedby_id' => 1,
			'date_created' => '2015-05-22 17:05:04',
			'date_modified' => '2015-05-22 17:05:04'
		),
	);

}
