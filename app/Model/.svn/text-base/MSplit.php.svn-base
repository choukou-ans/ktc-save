<?php
App::uses('AppModel', 'Model');
/**
 * MSplit Model
 *
 * @property MPaperSize $MPaperSize
 * @property MProductPaperSize $MProductPaperSize
 */
class MSplit extends AppModel {

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
		'm_paper_size_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'm_product_paper_size_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'split_num' => array(
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
		'MPaperSize' => array(
			'className' => 'MPaperSize',
			'foreignKey' => 'm_paper_size_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MProductPaperSize' => array(
			'className' => 'MProductPaperSize',
			'foreignKey' => 'm_product_paper_size_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
