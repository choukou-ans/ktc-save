<?php
/**
 * DeliveryNoteDetailFixture
 *
 */
class DeliveryNoteDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'delivery_note_id' => array('type' => 'integer', 'null' => false),
		'seqno' => array('type' => 'integer', 'null' => false),
		'spec_id' => array('type' => 'integer', 'null' => true),
		'goods_id' => array('type' => 'integer', 'null' => true),
		'goods_name' => array('type' => 'string', 'null' => true),
		'num' => array('type' => 'integer', 'null' => true),
		'unit' => array('type' => 'string', 'null' => true, 'length' => 1),
		'unit_price' => array('type' => 'integer', 'null' => true),
		'price' => array('type' => 'integer', 'null' => true),
		'etc' => array('type' => 'string', 'null' => true, 'length' => 50),
		'customer_goods_code' => array('type' => 'string', 'null' => true, 'length' => 25),
		'lot' => array('type' => 'integer', 'null' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'delivery_note_details_ix1' => array('unique' => false, 'column' => array('delivery_note_id', 'seqno'))
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
			'delivery_note_id' => 1,
			'seqno' => 1,
			'spec_id' => 1,
			'goods_id' => 1,
			'goods_name' => 'Lorem ipsum dolor sit amet',
			'num' => 1,
			'unit' => 'Lorem ipsum dolor sit ame',
			'unit_price' => 1,
			'price' => 1,
			'etc' => 'Lorem ipsum dolor sit amet',
			'customer_goods_code' => 'Lorem ipsum dolor sit a',
			'lot' => 1
		),
	);

}
