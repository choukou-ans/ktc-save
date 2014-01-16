<?php
App::uses('AppModel', 'Model');
/**
 * Customer Model
 *
 * @property User $User
 * @property MTaxImputation $MTaxImputation
 * @property MDealType $MDealType
 * @property BillCustomer $BillCustomer
 * @property MCutoffType $MCutoffType
 * @property MoneyFraction $MoneyFraction
 * @property TaxFraction $TaxFraction
 * @property MWithdrawal $MWithdrawal
 * @property MWithdrawalCycle $MWithdrawalCycle
 * @property MFeeCharge $MFeeCharge
 * @property MClassify1 $MClassify1
 * @property MClassify2 $MClassify2
 * @property MClassify3 $MClassify3
 * @property MClassify4 $MClassify4
 * @property MClassify5 $MClassify5
 * @property ConsignorMap $ConsignorMap
 * @property ConsignorList $ConsignorList
 * @property CustomerDept $CustomerDept
 * @property Delivery $Delivery
 * @property DeliveryNote $DeliveryNote
 * @property Estimate $Estimate
 * @property Good $Good
 * @property Spec $Spec
 * @property UserCustomerMap $UserCustomerMap
 */
class Customer extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MTaxImputation' => array(
			'className' => 'MTaxImputation',
			'foreignKey' => 'm_tax_imputation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MDealType' => array(
			'className' => 'MDealType',
			'foreignKey' => 'm_deal_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MCutoffType' => array(
			'className' => 'MCutoffType',
			'foreignKey' => 'm_cutoff_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MWithdrawal' => array(
			'className' => 'MWithdrawal',
			'foreignKey' => 'm_withdrawal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MWithdrawalCycle' => array(
			'className' => 'MWithdrawalCycle',
			'foreignKey' => 'm_withdrawal_cycle_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MFeeCharge' => array(
			'className' => 'MFeeCharge',
			'foreignKey' => 'm_fee_charge_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MClassify1' => array(
			'className' => 'MClassify',
			'foreignKey' => 'm_classify_id1',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MClassify2' => array(
			'className' => 'MClassify',
			'foreignKey' => 'm_classify_id2',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MClassify3' => array(
			'className' => 'MClassify',
			'foreignKey' => 'm_classify_id3',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MClassify4' => array(
			'className' => 'MClassify',
			'foreignKey' => 'm_classify_id4',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MClassify5' => array(
			'className' => 'MClassify',
			'foreignKey' => 'm_classify_id5',
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
		'ConsignorMap' => array(
			'className' => 'ConsignorMap',
			'foreignKey' => 'customer_id',
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
		'ConsignorList' => array(
			'className' => 'ConsignorList',
			'foreignKey' => 'customer_id',
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
		'CustomerDept' => array(
			'className' => 'CustomerDept',
			'foreignKey' => 'customer_id',
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
		'Delivery' => array(
			'className' => 'Delivery',
			'foreignKey' => 'customer_id',
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
		'DeliveryNote' => array(
			'className' => 'DeliveryNote',
			'foreignKey' => 'customer_id',
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
		'Estimate' => array(
			'className' => 'Estimate',
			'foreignKey' => 'customer_id',
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
		'Goods' => array(
			'className' => 'Goods',
			'foreignKey' => 'customer_id',
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
		'Spec' => array(
			'className' => 'Spec',
			'foreignKey' => 'customer_id',
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
		'UserCustomerMap' => array(
			'className' => 'UserCustomerMap',
			'foreignKey' => 'customer_id',
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
