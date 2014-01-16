<?php
/**
 * DeliveryNoteFixture
 *
 */
class DeliveryNoteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false),
		'user_id' => array('type' => 'integer', 'null' => true),
		'user_name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'slip_num' => array('type' => 'integer', 'null' => false),
		'delivery_date' => array('type' => 'date', 'null' => true),
		'tax_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'tax_rate' => array('type' => 'integer', 'null' => true),
		'total_price' => array('type' => 'integer', 'null' => true),
		'supplier_code' => array('type' => 'string', 'null' => true, 'length' => 5),
		'customer_code' => array('type' => 'string', 'null' => true, 'length' => 4),
		'etc' => array('type' => 'string', 'null' => true, 'length' => 50),
		'slip_type' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'delivery_notes_ix1' => array('unique' => false, 'column' => array('customer_id', 'user_id', 'slip_num', 'delivery_date', 'del_flag'))
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
			'customer_id' => 1,
			'user_id' => 1,
			'user_name' => 'Lorem ipsum dolor sit amet',
			'slip_num' => 1,
			'delivery_date' => '2013-12-27',
			'tax_flag' => 1,
			'tax_rate' => 1,
			'total_price' => 1,
			'supplier_code' => 'Lor',
			'customer_code' => 'Lo',
			'etc' => 'Lorem ipsum dolor sit amet',
			'slip_type' => 1,
			'created' => '2013-12-27 11:04:05',
			'updated' => '2013-12-27 11:04:05',
			'del_flag' => 1
		),
	);

}
