<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class OutsourceController extends AppController {

    public $name = 'Outsource';
    public $components = array('Check');
    public $uses = array('Outsource');
    /**
     * search method
     * WS030200
     * @throws Exception
     * @param code, model
     * @return json
     * @author GiangNT
     */

    public function search() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['code'])) {
            try {
                $fields = array('Outsource.id', 'Outsource.code', 'Outsource.name');
                $conditions = array('Outsource.code' => $data['code'], 'Outsource.del_flag' => FALSE);
                $data_find[0] = $this -> Outsource -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
                if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                    $res['status'] = STS_EMPTY;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $data_find;
                }
            } catch(Exception $e) {
                echo 'Exception: ', $e -> getMessage(), "\n";
                $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

}
