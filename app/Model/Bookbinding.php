<?php
App::uses('AppModel', 'Model');
/**
 * Bookbinding Model
 *
 */
class Bookbinding extends AppModel {

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
	);

    public function beforeSave($options = array()) {

    }
}
