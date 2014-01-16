<?php
App::uses('AppModel', 'Model');
/**
 * EstimateOutsource Model
 *
 * @property Estimate $Estimate
 * @property Outsource $Outsource
 */
class EstimateOutsource extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'estimate_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'seqno' => array(
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
		'Estimate' => array(
			'className' => 'Estimate',
			'foreignKey' => 'estimate_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Outsource' => array(
			'className' => 'Outsource',
			'foreignKey' => 'outsource_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
