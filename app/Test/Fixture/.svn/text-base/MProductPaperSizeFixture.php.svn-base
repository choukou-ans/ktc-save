<?php
/**
 * MProductPaperSizeFixture
 *
 */
class MProductPaperSizeFixture extends CakeTestFixture {

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
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_product_paper_sizes_ix1' => array('unique' => false, 'column' => array('code', 'del_flag'))
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
			'created' => '2013-12-11 15:01:56',
			'updated' => '2013-12-11 15:01:56',
			'del_flag' => 1
		),
	);

}
