<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class GoodsController extends AppController {

    public $uses = array('Token', 'Goods');
    public $components = array('Format', 'Check', 'Common', 'FormatRespon');

    /**
     * add method
     * WS030100,
     * @throws Exception
     * @param token, user_id, fields_in, value, model, fields_out
     * @return json
     * @author GiangNT
     */
    public function add() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        $this -> log($data, LOG_DEBUG);
        if (isset($data['token'], $data['user_id'], $data['fields_in'], $data['value'], $data['model'], $data['fields_out'])) {
            $nameModel = $data['model'];
            if ($this -> Check -> isset_model($nameModel)) {
                //================
                $new_data = $this -> Format -> formatSaveData($data['model'], $data['fields_in'], $data['value']);
                $model = ClassRegistry::init($data['model']);
                if (!empty($new_data)) {
                    try {
                        if ($model -> saveAll($new_data)) {
                            $res['status'] = STS_SUCCESS;
                            $res['id'] = $model -> id;
                        } else {
                            $error = $model -> validationErrors;
                            $res['status'] = STS_DB_UPDATE_ERROR;
                            if (!empty($error[0]['unique'])) {
                                $res['status'] = $error[0]['unique'];
                            }
                        }
                    } catch(Exception $e) {
                        echo 'Exception: ', $e -> getMessage(), "\n";
                        $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
                    }

                } else {
                    $res['status'] = STS_ERROR_AUTH;
                }
                //=============================
            } else {
                $res['status'] = STS_MISSINGMODEL;
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * search method
     * WS030200,WS030100,
     * @throws Exception
     * @param fields_in, value, model, fields_out
     * @return json
     * @author GiangNT
     */
    public function search() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['fields_in'], $data['value'], $data['fields_out'])) {
            $nameModel = 'Goods';
            try {
                $fields = $this -> Common -> addModeltoFileds($nameModel, $data['fields_out']);
                $fields_condtions = $this -> Common -> addModeltoFileds($nameModel, $data['fields_in']);
                $conditions = $this -> Common -> mapTwoArray($data['value'], $fields_condtions);
                if (array_key_exists('del_flag', $this -> $nameModel -> getColumnTypes())) {
                    $conditions[$nameModel . '.del_flag'] = FALSE;
                }
                $data_find[0] = $this -> $nameModel -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
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
