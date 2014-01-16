<?php
/**
 * HomeDeliveryFixture
 *
 */
class HomeDeliveryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 5),
		'name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'zip' => array('type' => 'string', 'null' => true, 'length' => 8),
		'address1' => array('type' => 'string', 'null' => true, 'length' => 50),
		'address2' => array('type' => 'string', 'null' => true, 'length' => 50),
		'tel' => array('type' => 'string', 'null' => true, 'length' => 13),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'home_deliveries_ix1' => array('unique' => false, 'column' => 'code')
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
			'code' => 'Lor',
			'name' => 'Lorem ipsum dolor sit amet',
			'zip' => 'Lorem ',
			'address1' => 'Lorem ipsum dolor sit amet',
			'address2' => 'Lorem ipsum dolor sit amet',
			'tel' => 'Lorem ipsum',
			'created' => '2013-11-07 18:52:02',
			'updated' => '2013-11-07 18:52:02',
			'del_flag' => 1
		),
	);

}
