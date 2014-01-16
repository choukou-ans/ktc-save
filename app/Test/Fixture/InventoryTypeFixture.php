<?php
/**
 * InventoryTypeFixture
 *
 */
class InventoryTypeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 2),
		'name' => array('type' => 'string', 'null' => true, 'length' => 50),
		'label_color' => array('type' => 'string', 'null' => true, 'length' => 2),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'inventory_types_ix1' => array('unique' => true, 'column' => 'code'),
			'inventory_typies_ix1' => array('unique' => false, 'column' => 'code')
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
			'name' => 'Lorem ipsum dolor sit amet',
			'label_color' => '',
			'created' => '2013-11-29 17:31:01',
			'updated' => '2013-11-29 17:31:01',
			'del_flag' => 1
		),
	);

}
