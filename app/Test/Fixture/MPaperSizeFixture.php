<?php
/**
 * MPaperSizeFixture
 *
 */
class MPaperSizeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 20),
		'x' => array('type' => 'integer', 'null' => true),
		'y' => array('type' => 'integer', 'null' => true),
		'ps_flag' => array('type' => 'boolean', 'null' => false, 'default' => false),
		'product_flag' => array('type' => 'boolean', 'null' => false, 'default' => false),
		'unit_price' => array('type' => 'integer', 'null' => true),
		'cost_price' => array('type' => 'integer', 'null' => true),
		'ratio' => array('type' => 'float', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_paper_sizes_ix1' => array('unique' => false, 'column' => array('code', 'ps_flag', 'product_flag'))
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
			'code' => 'Lorem ipsum dolor ',
			'x' => 1,
			'y' => 1,
			'ps_flag' => 1,
			'product_flag' => 1,
			'unit_price' => 1,
			'cost_price' => 1,
			'ratio' => 1,
			'created' => '2013-11-07 18:55:32',
			'updated' => '2013-11-07 18:55:32'
		),
	);

}
