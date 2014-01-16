<?php
App::uses('AppModel', 'Model');
/**
 * SpecOutsource Model
 *
 * @property Spec $Spec
 * @property Outsource $Outsource
 */
class SpecOutsource extends AppModel {

    public $displayField = 'id';
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
		'Outsource' => array(
			'className' => 'Outsource',
			'foreignKey' => 'outsource_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
    public function beforeSave($options = array()) {
      $max_seqno = $this->find('first', array('conditions' => array('spec_id' => $this->data[$this->alias]['spec_id']), 'fields' => array('MAX(seqno)'),'recursive' => -1));
      $this->data[$this->alias]['seqno'] = $max_seqno[0]['max'] + 1;
    }
}
