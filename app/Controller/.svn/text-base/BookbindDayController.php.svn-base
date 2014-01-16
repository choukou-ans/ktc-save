<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class BookbindDayController extends AppController {

    public $name = 'BookbindDay';
    public $uses = array('BookbindDay');
    public $components = array('Check');

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
        if (isset($data['day'])) {
            try {
                $fields = array('BookbindDay.id', 'BookbindDay.day', 'BookbindDay.name');
                $conditions = array('BookbindDay.day' => $data['day'], 'BookbindDay.del_flag' => FALSE);
                $data_find[] = $this -> BookbindDay -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
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
