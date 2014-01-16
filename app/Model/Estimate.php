<?php
App::uses('AppModel', 'Model');
/**
 * Estimate Model
 *
 * @property Customer $Customer
 * @property Goods $Goods
 * @property User $User
 * @property Spec $Spec
 * @property MPaperSize $MPaperSize
 * @property FinishPaperSize $FinishPaperSize
 * @property Bookbinding $Bookbinding
 * @property HoleType1 $HoleType1
 * @property HoleType2 $HoleType2
 * @property Fold $Fold
 * @property EstimateDetail $EstimateDetail
 * @property EstimateOutsource $EstimateOutsource
 */
class Estimate extends AppModel {

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
		'goods_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'estimate_num' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
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
		'Goods' => array(
			'className' => 'Goods',
			'foreignKey' => 'goods_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Spec' => array(
			'className' => 'Spec',
			'foreignKey' => 'spec_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MPaperSize' => array(
			'className' => 'MPaperSize',
			'foreignKey' => 'm_paper_size_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MProductPaperSize' => array(
			'className' => 'MProductPaperSize',
			'foreignKey' => 'finish_paper_size_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Bookbinding' => array(
			'className' => 'Bookbinding',
			'foreignKey' => 'bookbinding_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'HoleType1' => array(
			'className' => 'HoleType',
			'foreignKey' => 'hole_type_id1',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'HoleType2' => array(
			'className' => 'HoleType',
			'foreignKey' => 'hole_type_id2',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Fold' => array(
			'className' => 'Fold',
			'foreignKey' => 'fold_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'EstimateDetail' => array(
			'className' => 'EstimateDetail',
			'foreignKey' => 'estimate_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'EstimateOutsource' => array(
			'className' => 'EstimateOutsource',
			'foreignKey' => 'estimate_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
