<?php
/**
 * CustomerBranchFixture
 *
 */
class CustomerBranchFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 5),
		'name' => array('type' => 'string', 'null' => false, 'length' => 100),
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
			'code' => 'Lor',
			'name' => 'Lorem ipsum dolor sit amet'
		),
	);

}
