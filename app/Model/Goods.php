<?php
App::uses('AppModel', 'Model');
/**
 * Good Model
 *
 * @property Customer $Customer
 */
class Goods extends AppModel {
     public $name = 'Goods';
     public $useTable = 'goods';
     public $primaryKey = 'id';
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
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['customer_id'], $this->data[$this->alias]['code'])) {
           if (!empty($this->data[$this->alias]['id'])){
               return true;
           } elseif (!$this->checkUnique($this->data[$this->alias]['customer_id'], $this->data[$this->alias]['code'])){
               $this->validationErrors['unique'] = STS_Duplicate;
               return FALSE;
           }
        }
        return true;
    }

    public function getCode($id = ''){
        try{
            $goods_code = $this->find('list', array('conditions' => array('Goods.id' => $id), 'fields' => array('Goods.code')));
            return $this->find('list', array('conditions' => array('Goods.code' => $goods_code), 'fields' => array('Goods.id')));
        }catch(Exception $e){
            echo '', $e->getMessage(), "\n";
        }
    }

    protected function checkUnique($field1, $field2) {
        $conditions = array('Goods.customer_id' => $field1, 'Goods.code' => $field2);
        $data = $this->find('first', array('conditions' => $conditions));
        return $this->is_multiArrayEmpty($data);
    }



    protected function is_multiArrayEmpty($multiarray) {
        if (is_array($multiarray) and !empty($multiarray)) {
            $tmp = array_shift($multiarray);
            if (!$this->is_multiArrayEmpty($multiarray) or !$this->is_multiArrayEmpty($tmp)) {
                return false;
            }
            return true;
        }
        if (empty($multiarray)) {
            return true;
        }
        return false;
    }
}
