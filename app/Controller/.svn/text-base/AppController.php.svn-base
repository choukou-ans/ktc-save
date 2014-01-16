<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array('DebugKit.Toolbar' => array(), 'RequestHandler', 'Session');

    public function beforeFilter() {
        $this -> _checkToken();
		$this->_checkUser();
    }

    public function beforeRender() {
        // if ($this -> name == 'CakeError') {
        // //$this -> layout = 'error';
        // }
    }

    /*
     * トークンが正しいかチェックする
     * パラメータの'token'を元にチェックする
     *
     * 戻り値：
     *   true    正しい
     *   false   正しくない
     */
    protected function _ValidToken() {
        $token = $this -> request -> data['token'];
        if (!isset($token)) {
            return false;
        }

        $model = $this -> Token -> find('first', array('conditions' => array('Token.token' => $token)));
        if (empty($model)) {
            return false;
        }
        return true;

    }

    /**
     * findToken method
     *
     * @throws Exception
     * @param token
     * @return Boolean
     * @author GiangNT
     */
    protected function _findToken($token) {
        if (!isset($token)) {
            return false;
        }
        $model_token = ClassRegistry::init('Token');
        $model = $model_token -> find('first', array('conditions' => array('Token.token' => $token)));
        if (empty($model)) {
            return false;
        }
        return true;

    }

    protected function _checkToken() {
        if (isset($this -> request -> data['token'])) {
            $model_token = ClassRegistry::init('Token');
            $model = $model_token -> find('first', array('conditions' => array('Token.token' => $this -> request -> data['token'])));
            if (empty($model)) {
                return $this -> redirect(array('controller' => 'Auth', 'action' => 'deny'));
            }
        }
        return true;
    }
	
    protected function _checkUser() {
        if (isset($this -> request -> data['user_id'])) {
            $model_user = ClassRegistry::init('User');
            $model = $model_user -> find('first', array('conditions' => array('User.id' => $this -> request -> data['user_id'], 'User.del_flag' => FALSE)));
            if (empty($model)) {
                return $this -> redirect(array('controller' => 'Auth', 'action' => 'notFoundUserId'));
            }
        }
        return true;
    }

}
