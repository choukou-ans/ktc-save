<?php
App::uses('AppModel', 'Model');
/**
 * Spec Model
 *
 * @property Customer $Customer
 * @property Goods $Goods
 * @property MProcess $MProcess
 * @property User $User
 * @property MPaperSize $MPaperSize
 * @property FinishPaperSize $FinishPaperSize
 * @property Bookbinding $Bookbinding
 * @property Fold $Fold
 * @property InventoryType $InventoryType
 * @property InventoryDelivery $InventoryDelivery
 * @property MReprint $MReprint
 * @property InventoryOutsource $InventoryOutsource
 * @property PaperInventory $PaperInventory
 * @property SpecDetail $SpecDetail
 * @property SpecOutsource $SpecOutsource
 */
class Spec extends AppModel {

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
		'order_num' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'm_process_id' => array(
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
		'MProcess' => array(
			'className' => 'MProcess',
			'foreignKey' => 'm_process_id',
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
		'MPaperSize' => array(
			'className' => 'MPaperSize',
			'foreignKey' => 'm_paper_size_id',
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
		'Fold' => array(
			'className' => 'Fold',
			'foreignKey' => 'fold_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'InventoryType' => array(
			'className' => 'InventoryType',
			'foreignKey' => 'inventory_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'InventoryDelivery' => array(
			'className' => 'InventoryType',
			'foreignKey' => 'inventory_delivery_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'InventoryOutsource' => array(
			'className' => 'InventoryType',
			'foreignKey' => 'inventory_outsource_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MReprint' => array(
			'className' => 'MReprint',
			'foreignKey' => 'm_reprint_id',
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
		'MProductPaperSize' => array(
			'className' => 'MProductPaperSize',
			'foreignKey' => 'finish_paper_size_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PaperInventory' => array(
			'className' => 'PaperInventory',
			'foreignKey' => 'spec_id',
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
		'SpecDetail' => array(
			'className' => 'SpecDetail',
			'foreignKey' => 'spec_id',
			'dependent' => TRUE,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SpecOutsource' => array(
			'className' => 'SpecOutsource',
			'foreignKey' => 'spec_id',
			'dependent' => TRUE,
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

    public function beforeSave($options = array()) {

    }

}
