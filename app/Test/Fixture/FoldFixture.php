<?php
/**
 * FoldFixture
 *
 */
class FoldFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => false, 'length' => 3),
		'name' => array('type' => 'string', 'null' => false, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'del_flag' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'folds_ix1' => array('unique' => false, 'column' => 'code')
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
			'created' => '2013-12-02 11:19:40',
			'updated' => '2013-12-02 11:19:40',
			'del_flag' => 1
		),
	);

}
