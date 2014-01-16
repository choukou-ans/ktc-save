<?php
App::uses('AppModel', 'Model');
/**
 * Delivery Model
 *
 * @property Customer $Customer
 * @property MCourier $MCourier
 */
class Delivery extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'customer_id' => array(
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
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MCourier' => array(
			'className' => 'MCourier',
			'foreignKey' => 'm_courier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    public function beforeSave($options = array()) {

    }
}
