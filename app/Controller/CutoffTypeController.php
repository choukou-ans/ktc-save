<?php
App::uses('AppController', 'Controller');
// App::import('Controller', 'Add');
// $Add = new AddController;
/**
 *
 * @Auth: GiangNT
 *
 */
class CutoffTypeController extends AppController {

    public $name = 'CutoffType';
    public $components = array('Check');
    public $uses = array('MCutoffType');

    /**
     * search method
     * WS120302
     * @throws Exception
     * @param
     * @return json
     * @author GiangNT
     */

    public function search() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['code'])) {
            $conditions = array('MCutoffType.code' => $data['code']);
            $fields = array('MCutoffType.id', 'MCutoffType.code', 'MCutoffType.name');
            $data_find[] = $this -> MCutoffType -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
            if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                $res['status'] = STS_EMPTY;
            } else {
                $res['status'] = STS_SUCCESS;
                $res['data_res'] = $data_find;
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

}
