<?php
/**
 * MEditMasterFixture
 *
 */
class MEditMasterFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'master_name' => array('type' => 'string', 'null' => false, 'length' => 50),
		'table_name' => array('type' => 'string', 'null' => false, 'length' => 50),
		'model_name' => array('type' => 'string', 'null' => false, 'length' => 50),
		'sort_no' => array('type' => 'integer', 'null' => false),
		'edit_type' => array('type' => 'integer', 'null' => true),
		'condtion' => array('type' => 'string', 'null' => true),
		'columns' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'titles' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'title_width' => array('type' => 'text', 'null' => true, 'length' => 1073741824),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_edit_masters_ix1' => array('unique' => false, 'column' => array('master_name', 'sort_no'))
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
			'master_name' => 'Lorem ipsum dolor sit amet',
			'table_name' => 'Lorem ipsum dolor sit amet',
			'model_name' => 'Lorem ipsum dolor sit amet',
			'sort_no' => 1,
			'edit_type' => 1,
			'condtion' => 'Lorem ipsum dolor sit amet',
			'columns' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'titles' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'title_width' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
