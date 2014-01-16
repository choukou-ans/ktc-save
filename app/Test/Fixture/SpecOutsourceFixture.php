<?php
/**
 * SpecOutsourceFixture
 *
 */
class SpecOutsourceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'spec_id' => array('type' => 'integer', 'null' => false),
		'seqno' => array('type' => 'integer', 'null' => false),
		'outsource_id' => array('type' => 'integer', 'null' => true),
		'unit_price' => array('type' => 'integer', 'null' => true),
		'price' => array('type' => 'integer', 'null' => true),
		'packing_price' => array('type' => 'integer', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'spec_outsources_ix1' => array('unique' => false, 'column' => array('spec_id', 'seqno', 'outsource_id'))
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
			'spec_id' => 1,
			'seqno' => 1,
			'outsource_id' => 1,
			'unit_price' => 1,
			'price' => 1,
			'packing_price' => 1
		),
	);

}
