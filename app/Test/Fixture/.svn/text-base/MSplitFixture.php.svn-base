<?php
/**
 * MSplitFixture
 *
 */
class MSplitFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'm_paper_size_id' => array('type' => 'integer', 'null' => false),
		'm_product_paper_size_id' => array('type' => 'integer', 'null' => false),
		'split_num' => array('type' => 'integer', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_splits_ix1' => array('unique' => false, 'column' => array('m_paper_size_id', 'm_product_paper_size_id'))
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
			'm_product_paper_size_id' => 1,
			'split_num' => 1
		),
	);

}
