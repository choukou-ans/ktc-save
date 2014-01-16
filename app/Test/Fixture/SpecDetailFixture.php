<?php
/**
 * SpecDetailFixture
 *
 */
class SpecDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'spec_id' => array('type' => 'integer', 'null' => false),
		'seqno' => array('type' => 'integer', 'null' => false),
		'equipment_type' => array('type' => 'string', 'null' => true, 'length' => 10),
		'printout_date' => array('type' => 'date', 'null' => true),
		'part_id' => array('type' => 'integer', 'null' => true),
		'part_name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'm_paper_id' => array('type' => 'integer', 'null' => true),
		'print_num' => array('type' => 'integer', 'null' => true),
		'reserve_num' => array('type' => 'integer', 'null' => true),
		'front_color_num' => array('type' => 'integer', 'null' => true),
		'back_color_num' => array('type' => 'integer', 'null' => true),
		'print_color1' => array('type' => 'integer', 'null' => true),
		'print_color2' => array('type' => 'integer', 'null' => true),
		'print_color3' => array('type' => 'integer', 'null' => true),
		'print_color4' => array('type' => 'integer', 'null' => true),
		'print_color5' => array('type' => 'integer', 'null' => true),
		'desensitizing_flag' => array('type' => 'string', 'null' => true, 'length' => 1),
		'comments' => array('type' => 'string', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
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
			'spec_id' => 1,
			'seqno' => 1,
			'equipment_type' => 'Lorem ip',
			'printout_date' => '2013-12-02',
			'part_id' => 1,
			'part_name' => 'Lorem ipsum dolor sit amet',
			'm_paper_id' => 1,
			'print_num' => 1,
			'reserve_num' => 1,
			'front_color_num' => 1,
			'back_color_num' => 1,
			'print_color1' => 1,
			'print_color2' => 1,
			'print_color3' => 1,
			'print_color4' => 1,
			'print_color5' => 1,
			'desensitizing_flag' => 'Lorem ipsum dolor sit ame',
			'comments' => 'Lorem ipsum dolor sit amet'
		),
	);

}
