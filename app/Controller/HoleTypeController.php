<?php
App::uses('AppController', 'Controller');
// App::import('Controller', 'Add');
// $Add = new AddController;
/**
 *
 * @Auth: GiangNT
 *
 */
class HoleTypeController extends AppController {

    public $name = 'HoleType';
    public $components = array('Check', 'Common');

    /**
     * search method
     * WS030200
     * @throws Exception
     * @param fields_in, value, model, fields_out
     * @return json
     * @author GiangNT
     */

    public function search() {
         $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['fields_in'], $data['value'], $data['model'], $data['fields_out'])) {

            if ($this -> Check -> isset_model($data['model'])) {
                try {
                    $this -> loadModel($data['model']);
                    $fields = $this -> Common -> addModeltoFileds($data['model'], $data['fields_out']);
                    $fields_condtions = $this -> Common -> addModeltoFileds($data['model'], $data['fields_in']);
                    $conditions = $this -> Common -> mapTwoArray($data['value'], $fields_condtions);
                    if (array_key_exists('del_flag', $this -> $data['model'] -> getColumnTypes())) {
                        $conditions[$data['model'] . '.del_flag'] = FALSE;
                    }
                    $data_find[] = $this -> $data['model'] -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
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
                $res['status'] = STS_ERROR_AUTH;
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

}
