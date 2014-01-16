<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ProcessController extends AppController {

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Process';

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('User', 'Token');

    public $components = array('Format', 'Check', 'FormatRespon', 'Common');

    /**
     * Get Process method
     * @tutorial WS040100
     *
     * @throws NotFoundException
     * @param  Token, user_id
     * @return array
     * @author Tu Vu
     */

    public function list_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $options = array();
        $data = $this -> request -> data;
        $nameModel = 'MProcess';
        $this -> loadModel($nameModel);

        if (isset($data['token'], $data['user_id'])) {        		
                $options['fields'] = array($nameModel.'.id', $nameModel.'.code', $nameModel.'.name');
                $options['recursive'] = -1;
                $options['order'] = array($nameModel.'.code ASC');
                $dataFind = $this -> $nameModel -> find('all', $options);

                if (empty($dataFind)) {
                    $res['status'] = STS_EMPTY;
                    $res['data_res'] = null;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $dataFind;
                }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }
}
