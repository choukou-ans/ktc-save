<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class ClassifyController extends AppController {

    public $name = 'Classify';
    public $components = array('Check');
    public $uses = array('MClassify');

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
        if (isset($data['code'], $data['no'])) {
            try {
                $conditions = array('MClassify.code' => $data['code'], 'MClassify.num' => $data['no']);
                $fields = array('MClassify.id', 'MClassify.num', 'MClassify.code', 'MClassify.name');
                $data_find[] = $this -> MClassify -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
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
