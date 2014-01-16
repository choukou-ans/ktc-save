<?php
/**
 * HoleTypyFixture
 *
 */
class HoleTypyFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 2),
		'direction' => array('type' => 'string', 'null' => true, 'length' => 10),
		'm_hole_num_id' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'upated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'hole_typies_ix1' => array('unique' => false, 'column' => 'code')
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'code' => '',
			'direction' => 'Lorem ip',
			'm_hole_num_id' => 1,
			'created' => '2013-11-07 09:30:43',
			'upated' => '2013-11-07 09:30:43',
			'del_flag' => 1
		),
	);

}
