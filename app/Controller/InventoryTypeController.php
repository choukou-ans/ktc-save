<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class InventoryTypeController extends AppController {

    public $name = 'InventoryType';
    public $components = array('Check');
    public $uses = array('InventoryType');
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
        if (isset($data['code'], $data['flag'])) {
            try {
                $fields = array('InventoryType.id', 'InventoryType.code', 'InventoryType.name');
                if (strtolower($data['flag']) == 'true') {
                    $conditions = array('InventoryType.code' => $data['code'], 'InventoryType.del_flag' => FALSE, "AND" => array('InventoryType.code' => array('N', 'A', 'S')));
                } elseif (strtolower($data['flag']) == 'false') {
                    $conditions = array(
                    	'InventoryType.code' => $data['code'], 
                    	'InventoryType.del_flag' => FALSE, 
                    	"AND" => array(
                    		'InventoryType.code SIMILAR TO' => '[0-9W-Z]'
						)
					);
                } else {
                    goto flag;
                }
                $data_find[0] = $this -> InventoryType -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
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
            flag:
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

}
