<?php
/**
 * PaperInventoryFixture
 *
 */
class PaperInventoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'm_paper_id' => array('type' => 'integer', 'null' => false),
		'prev_num' => array('type' => 'integer', 'null' => true),
		'inventory_num' => array('type' => 'integer', 'null' => true),
		'inventory_date' => array('type' => 'datetime', 'null' => true),
		'spec_id' => array('type' => 'integer', 'null' => true),
		'user_id' => array('type' => 'integer', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true),
		'updated' => array('type' => 'datetime', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'paper_inventories_ix1' => array('unique' => false, 'column' => array('m_paper_id', 'inventory_date', 'user_id'))
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
			'm_paper_id' => 1,
			'prev_num' => 1,
			'inventory_num' => 1,
			'inventory_date' => '2013-12-02 11:23:58',
			'spec_id' => 1,
			'user_id' => 1,
			'created' => '2013-12-02 11:23:58',
			'updated' => '2013-12-02 11:23:58'
		),
	);

}
