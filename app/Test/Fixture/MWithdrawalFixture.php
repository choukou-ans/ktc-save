<?php
/**
 * MWithdrawalFixture
 *
 */
class MWithdrawalFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 3),
		'name' => array('type' => 'string', 'null' => false, 'length' => 10),
		'description' => array('type' => 'string', 'null' => true, 'length' => 20),
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
			'code' => 'L',
			'name' => 'Lorem ip',
			'description' => 'Lorem ipsum dolor '
		),
	);

}
