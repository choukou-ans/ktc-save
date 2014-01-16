<?php
/**
 * MPaperFixture
 *
 */
class MPaperFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 25),
		'm_paper_size_id' => array('type' => 'integer', 'null' => false),
		'unit_price' => array('type' => 'float', 'null' => true),
		'cur_num' => array('type' => 'integer', 'null' => true),
		'threshold' => array('type' => 'integer', 'null' => true),
		'packing_num' => array('type' => 'integer', 'null' => true),
		'cutting_num' => array('type' => 'integer', 'null' => true),
		'supplier' => array('type' => 'string', 'null' => true, 'length' => 25),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_papers_ix1' => array('unique' => true, 'column' => array('code', 'm_paper_size_id'))
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
			'code' => 'Lorem ipsum dolor sit a',
			'm_paper_size_id' => 1,
			'unit_price' => 1,
			'cur_num' => 1,
			'threshold' => 1,
			'packing_num' => 1,
			'cutting_num' => 1,
			'supplier' => 'Lorem ipsum dolor sit a',
			'created' => '2013-12-17 13:14:22',
			'updated' => '2013-12-17 13:14:22',
			'del_flag' => 1
		),
	);

}
