<?php
App::uses('AppModel', 'Model');
/**
 * MEditMasterRole Model
 *
 * @property MEditMaster $MEditMaster
 * @property MRole $MRole
 */
class MEditMasterRole extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'm_edit_master_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'm_role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'MEditMaster' => array(
			'className' => 'MEditMaster',
			'foreignKey' => 'm_edit_master_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MRole' => array(
			'className' => 'MRole',
			'foreignKey' => 'm_role_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
