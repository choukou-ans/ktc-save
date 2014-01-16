<?php
/**
 * OutsourceFixture
 *
 */
class OutsourceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 10),
		'name' => array('type' => 'string', 'null' => false, 'length' => 50),
		'zip' => array('type' => 'string', 'null' => true),
		'address1' => array('type' => 'string', 'null' => true),
		'address2' => array('type' => 'string', 'null' => true),
		'tel' => array('type' => 'string', 'null' => true),
		'bank_name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'branch_name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'account_type' => array('type' => 'integer', 'null' => true),
		'account_name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'account_number' => array('type' => 'string', 'null' => true, 'length' => 7),
		'charge_type' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'outsources_ix1' => array('unique' => false, 'column' => 'code')
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
			'code' => 'Lorem ip',
			'name' => 'Lorem ipsum dolor sit amet',
			'zip' => 'Lorem ipsum dolor sit amet',
			'address1' => 'Lorem ipsum dolor sit amet',
			'address2' => 'Lorem ipsum dolor sit amet',
			'tel' => 'Lorem ipsum dolor sit amet',
			'bank_name' => 'Lorem ipsum dolor sit amet',
			'branch_name' => 'Lorem ipsum dolor sit amet',
			'account_type' => 1,
			'account_name' => 'Lorem ipsum dolor sit amet',
			'account_number' => 'Lorem',
			'charge_type' => 1,
			'created' => '2013-11-07 18:50:47',
			'updated' => '2013-11-07 18:50:47',
			'del_flag' => 1
		),
	);

}
