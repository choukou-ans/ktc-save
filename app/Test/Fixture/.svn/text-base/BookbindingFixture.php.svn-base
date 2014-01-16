<?php
/**
 * BookbindingFixture
 *
 */
class BookbindingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 2),
		'direction' => array('type' => 'string', 'null' => true, 'length' => 10),
		'binding_type' => array('type' => 'string', 'null' => true, 'length' => 20),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'bookbindings_ix1' => array('unique' => false, 'column' => 'code')
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
			'code' => '',
			'direction' => 'Lorem ip',
			'binding_type' => 'Lorem ipsum dolor ',
			'created' => '2013-11-07 18:51:48',
			'updated' => '2013-11-07 18:51:48',
			'del_flag' => 1
		),
	);

}
