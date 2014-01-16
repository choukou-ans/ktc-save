<?php
App::uses('AppModel', 'Model');
/**
 * DeliveryNoteDetail Model
 *
 * @property DeliveryNote $DeliveryNote
 * @property Spec $Spec
 * @property Goods $Goods
 */
class DeliveryNoteDetail extends AppModel {

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
		'delivery_note_id' => array(
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
		'DeliveryNote' => array(
			'className' => 'DeliveryNote',
			'foreignKey' => 'delivery_note_id',
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
		'Goods' => array(
			'className' => 'Goods',
			'foreignKey' => 'goods_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    public function beforeSave($options = array()) {
      $max_seqno = $this->find('first', array('conditions' => array('delivery_note_id' => $this->data[$this->alias]['delivery_note_id']), 'fields' => array('MAX(seqno)')));
      $this->data[$this->alias]['seqno'] = $max_seqno[0]['max'] + 1;
    }
    
    public function dateFormatBeforeSave($dateString) {
        return date('YY-MM-DD', strtotime($dateString));
    }
}
