<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class ProductPaperSizeController extends AppController {

    public $name = 'ProductPaperSize';
    public $components = array('Check');
    public $uses = array('MProductPaperSize');

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
                $query_code = strtoupper($data['code']);
                $fields = array('MProductPaperSize.id', 'MProductPaperSize.code', 'MProductPaperSize.x', 'MProductPaperSize.y');
                $conditions = array('UPPER(MProductPaperSize.code)' => $query_code, 'MProductPaperSize.del_flag' => FALSE);
                $data_find[0] = $this -> MProductPaperSize -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
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
