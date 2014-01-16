<?php
/**
 * MPrepareFeeFixture
 *
 */
class MPrepareFeeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'page_num' => array('type' => 'integer', 'null' => true),
		'color_type_id' => array('type' => 'integer', 'null' => true),
		'fee' => array('type' => 'float', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_prepare_fees_ix1' => array('unique' => false, 'column' => array('page_num', 'color_type_id'))
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
			'name' => 'Lorem ipsum dolor sit amet',
			'page_num' => 1,
			'color_type_id' => 1,
			'fee' => 1
		),
	);

}
