<?php
App::uses('AppModel', 'Model');
/**
 * MClassify Model
 *
 */
class MClassify extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'code';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
		    'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create',
                'message' => '801'
            ),
		),
	);
}
