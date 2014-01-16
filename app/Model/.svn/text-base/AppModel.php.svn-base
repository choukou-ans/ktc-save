<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
    /**
     * unset updated when updated = created
     *
     * @return void
     * @author GiangNT
     */
    public function save($data = null, $validate = true, $fieldList = array()) {
        // Clear updated field value before each save
        $this -> set($data);
        if (empty($this -> data[$this -> alias]['id']) || !$this -> exists($this -> data[$this -> alias]['id'])) {
            $this -> data[$this -> alias]['updated'] = false;
        }
        return parent::save($this -> data, $validate, $fieldList);
    }

    /**
     * isset Record
     *
     * @return boolean
     * @author GiangNT
     */
    public function issetRecord($conditions = array(), $recursive = 0) {
        try {
            if (array_key_exists('del_flag', $this -> getColumnTypes())) {
                $conditions[$this -> alias . '.del_flag'] = FALSE;
            }
            $data = $this -> find('first', array('conditions' => $conditions, 'recursive' => $recursive));
            if (empty($data)) {
                return false;
            }
            return TRUE;
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERR);
        }
    }

    /**
     * getData method
     *
     * @return array
     * @author GiangNT
     */
    public function getIdByFields($conditions = array()) {
        try {
            return $this -> find('first', array('conditions' => $conditions, 'fields' => array($this -> alias . '.id'), 'recursive' => -1));

        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERR);
        }
    }

}
