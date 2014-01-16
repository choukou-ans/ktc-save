<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class TaxImputationController extends AppController {

    public $name = 'TaxImputation';
    public $components = array('FormatRespon', 'Check', 'Format');

    /**
     * list_data method
     * WS120302
     * @throws Exception
     * @param
     * @return json
     * @author GiangNT
     */

    public function list_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $this -> loadModel('MTaxImputation');
        $data_find = $this -> MTaxImputation -> find('all', array('recursive' => 0));

        if ($this -> Check -> is_multiArrayEmpty($data_find)) {
            $res['status'] = STS_EMPTY;
        } else {
            $res['status'] = STS_SUCCESS;
            $res['data_res'] = $data_find;
        }

        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }
}
