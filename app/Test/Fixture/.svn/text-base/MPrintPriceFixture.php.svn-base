<?php
/**
 * MPrintPriceFixture
 *
 */
class MPrintPriceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'm_paper_size_id' => array('type' => 'integer', 'null' => false),
		'num' => array('type' => 'integer', 'null' => false),
		'price' => array('type' => 'integer', 'null' => true),
		'coefficient' => array('type' => 'float', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_print_prices_ix1' => array('unique' => false, 'column' => array('m_paper_size_id', 'num'))
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
			'm_paper_size_id' => 1,
			'num' => 1,
			'price' => 1,
			'coefficient' => 1
		),
	);

}
