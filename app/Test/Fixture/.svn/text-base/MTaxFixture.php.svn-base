<?php
/**
 * MTaxFixture
 *
 */
class MTaxFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'm_taxs';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'start_date' => array('type' => 'date', 'null' => false),
		'tax_rate' => array('type' => 'integer', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_taxs_ix1' => array('unique' => false, 'column' => 'start_date')
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
			'start_date' => '2013-12-13',
			'tax_rate' => 1
		),
	);

}
