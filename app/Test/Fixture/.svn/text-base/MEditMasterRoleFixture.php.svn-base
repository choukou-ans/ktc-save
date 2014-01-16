<?php
/**
 * MEditMasterRoleFixture
 *
 */
class MEditMasterRoleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'm_edit_master_id' => array('type' => 'integer', 'null' => false),
		'm_role_id' => array('type' => 'integer', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'm_edit_master_roles_ix1' => array('unique' => false, 'column' => array('m_edit_master_id', 'm_role_id'))
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
			'm_edit_master_id' => 1,
			'm_role_id' => 1
		),
	);

}
