<?php
App::uses('AppController', 'Controller');
/**
 * Search Controller
 *
 * @Auth: GiangNT
 *
 */
class SearchsController extends AppController {

    public $uses = array('User', 'Token', 'Customer');
    public $components = array('FormatRespon', 'Common', 'Check');

    /**
     * get info method
     * WS030100,
     * @throws Exception
     * @param code, model
     * @return json
     * @author GiangNT
     */

    public function searchByCodeAndModel() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['code'], $data['model'])) {

            if ($this -> Check -> isset_model($data['model'])) {
                try {
                    $this -> loadModel($data['model']);
                    if ($data['model'] == 'User') {
                        $fields = array($data['model'] . '.id', $data['model'] . '.login', $data['model'] . '.name');
                        $conditions = array($data['model'] . '.login' => $data['code'], $data['model'] . '.del_flag' => FALSE);
                    } else {
                        $fields = array($data['model'] . '.id', $data['model'] . '.code', $data['model'] . '.name', $data['model'] . '.del_flag' => FALSE);
                        $conditions = array($data['model'] . '.code' => $data['code']);
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
                $res['status'] = STS_MISSINGMODEL;
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * get info method
     * W..
     * @throws Exception
     * @param code
     * @return json
     * @author GiangNT
     */
    public function searchFromMWithdrawal() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['code'])) {
            $this -> loadModel('MWithdrawal');
            $conditions = array('MWithdrawal.code' => $data['code']);
            $fields = array('MWithdrawal.id', 'MWithdrawal.code', 'MWithdrawal.name', 'MWithdrawal.description');
            $data_find[] = $this -> MWithdrawal -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
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

    /**
     * get info method
     * W..
     * @throws Exception
     * @param code, no, model
     * @return json
     * @author GiangNT
     */

    public function searchByCodeNoAndModel() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['code'], $data['no'], $data['model'])) {

            if ($this -> Check -> isset_model($data['model'])) {
                try {
                    $this -> loadModel($data['model']);
                    $conditions = array($data['model'] . '.code' => $data['code'], $data['model'] . '.num' => $data['no']);
                    $fields = array($data['model'] . '.id', $data['model'] . '.num', $data['model'] . '.code', $data['model'] . '.name');
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

    /**
     * get info method
     * WS030100, ..
     * @throws Exception
     * @param fields_in, value, model, fields_out
     * @return json
     * @author GiangNT
     */

    public function searchByFieldsAndModel() {
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

    /**
     * get info method
     * W..
     * @throws Exception
     * @param fields_in, value, model, fields_out
     * @return json
     * @author GiangNT
     */

    public function searchByFieldsAndAnyModel() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['fields_in'], $data['value'], $data['model'], $data['fields_out'])) {

            if ($this -> Check -> isset_model($data['model'])) {
                try {
                    $this -> loadModel($data['model']);
                    $fields = explode(GLUE, $data['fields_out']);
                    $fields_condtions = explode(GLUE, $data['fields_in']);
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

    /**
     * get info method
     * W..
     * @throws Exception
     * @param id, model, fields_out
     * @return json
     * @author GiangNT
     */

    public function searchAllById() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['id'], $data['model'], $data['fields_out'])) {

            if ($this -> Check -> isset_model($data['model'])) {
                try {
                    $this -> loadModel($data['model']);
                    if (!$this -> $data['model'] -> exists($data['id'])) {
                        throw new NotFoundException(__('Invalid ID'));
                    }
                    if (empty($data['fields_out']) || $data['fields_out'] == 'all') {
                        $fields = array();
                    } else {
                        $fields = explode(GLUE, $data['fields_out']);
                    }
                    $conditions = array($data['model'] . '.id' => $data['id']);
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
