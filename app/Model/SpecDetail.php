<?php
App::uses('AppModel', 'Model');
/**
 * SpecDetail Model
 *
 * @property Spec $Spec
 * @property Part $Part
 * @property MPaper $MPaper
 */
class SpecDetail extends AppModel {

/**
 * Display field
 *
 * @var string
 */
 
	public $displayField = 'id';
    
    public $virtualFields = array(
       // 'process_10_inventory' => 'MPaper.cur_num + SpecDetail.print_num + SpecDetail.reserve_num'
    );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'spec_id' => array(
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
		'Spec' => array(
			'className' => 'Spec',
			'foreignKey' => 'spec_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Part' => array(
			'className' => 'Part',
			'foreignKey' => 'part_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MPaper' => array(
			'className' => 'MPaper',
			'foreignKey' => 'm_paper_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    
    public function beforeSave($options = array()) {
      $max_seqno = $this->find('first', array('conditions' => array('spec_id' => $this->data[$this->alias]['spec_id']), 'fields' => array('MAX(seqno)')));
      $this->data[$this->alias]['seqno'] = $max_seqno[0]['max'] + 1;
    }
}
