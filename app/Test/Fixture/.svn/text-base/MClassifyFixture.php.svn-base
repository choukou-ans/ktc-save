<?php
/**
 * MClassifyFixture
 *
 */
class MClassifyFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'num' => array('type' => 'integer', 'null' => true),
		'code' => array('type' => 'string', 'null' => true, 'length' => 2),
		'name' => array('type' => 'string', 'null' => true, 'length' => 10),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_classifies_ix1' => array('unique' => false, 'column' => array('num', 'code'))
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
			'num' => 1,
			'code' => '',
			'name' => 'Lorem ip'
		),
	);

}
