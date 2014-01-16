<?php
/**
 * DelivoryFixture
 *
 */
class DelivoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'customer_id' => array('type' => 'integer', 'null' => false),
		'zip' => array('type' => 'string', 'null' => true, 'length' => 8),
		'address1' => array('type' => 'string', 'null' => true, 'length' => 50),
		'address2' => array('type' => 'string', 'null' => true, 'length' => 50),
		'corp_name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'dept' => array('type' => 'string', 'null' => true, 'length' => 50),
		'contact_person' => array('type' => 'string', 'null' => true, 'length' => 50),
		'tel' => array('type' => 'string', 'null' => true, 'length' => 13),
		'm_courier_id' => array('type' => 'integer', 'null' => true),
		'createed' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
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
			'customer_id' => 1,
			'zip' => 'Lorem ',
			'address1' => 'Lorem ipsum dolor sit amet',
			'address2' => 'Lorem ipsum dolor sit amet',
			'corp_name' => 'Lorem ipsum dolor sit amet',
			'dept' => 'Lorem ipsum dolor sit amet',
			'contact_person' => 'Lorem ipsum dolor sit amet',
			'tel' => 'Lorem ipsum',
			'm_courier_id' => 1,
			'createed' => '2013-11-07 13:17:25',
			'updated' => '2013-11-07 13:17:25',
			'del_flag' => 1
		),
	);

}
