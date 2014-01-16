<?php
/**
 * BookbindDayFixture
 *
 */
class BookbindDayFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'day' => array('type' => 'integer', 'null' => false),
		'name' => array('type' => 'string', 'null' => false, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true),
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
			'day' => 1,
			'name' => 'Lorem ip',
			'created' => '2013-12-02 11:15:39',
			'updated' => '2013-12-02 11:15:39',
			'del_flag' => 1
		),
	);

}
