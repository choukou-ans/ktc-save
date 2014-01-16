<?php
/**
 * CustomerDeptFixture
 *
 */
class CustomerDeptFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false),
		'code' => array('type' => 'string', 'null' => false, 'length' => 50),
		'name' => array('type' => 'string', 'null' => true),
		'product_code_mask' => array('type' => 'string', 'null' => true, 'length' => 50),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'customer_depts_ix1' => array('unique' => true, 'column' => array('customer_id', 'code')),
			'customer_depts_ix2' => array('unique' => false, 'column' => array('customer_id', 'del_flag'))
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
			'code' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'product_code_mask' => 'Lorem ipsum dolor sit amet',
			'created' => '2013-12-02 11:18:19',
			'updated' => '2013-12-02 11:18:19',
			'del_flag' => 1
		),
	);

}
