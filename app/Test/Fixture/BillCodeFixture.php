<?php
/**
 * BillCodeFixture
 *
 */
class BillCodeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'sub_goods_code' => array('type' => 'string', 'null' => false, 'length' => 5),
		'bill_desc' => array('type' => 'string', 'null' => false, 'length' => 50),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'bill_codes_ix1' => array('unique' => false, 'column' => 'sub_goods_code')
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
			'sub_goods_code' => 'Lor',
			'bill_desc' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-11-07 18:55:54',
			'updated' => '2013-11-07 18:55:54',
			'del_flag' => 1
		),
	);

}
