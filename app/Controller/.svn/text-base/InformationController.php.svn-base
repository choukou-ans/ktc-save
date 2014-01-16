<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class InformationController extends AppController {

    public $name = 'Information';
    public $components = array('Check');

    /**
     * index method
     * WS000300
     * @throws Exception
     * @param
     * @return json
     * @author GiangNT
     */

    public function index() {
        $this -> viewClass = 'Json';
        $res = array();

        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

}
