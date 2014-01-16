﻿<?php
/**
 * User Controller
 *
 * Windowsアプリケーションの認証
 *  *
 * - 認証されたクライアントからのアクセスかチェックする
 *
 */
App::uses('Controller', 'Controller');
class UserController extends AppController {
    public $name = 'User';

    public $uses = array('User', 'Token', 'MEditMaster', 'MEditMasterRole', 'MRole', 'Customer', 'UserCustomerMap');

    public $components = array('Format', 'Check', 'FormatRespon');

    public function index() {
    }

    /**
     * Combo roles method
     * @tutorial WS190200
     * @throws NotFoundException
     * @param
     * @return list roles
     * @author Tu Vu
     */
    public function combo_roles() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> MRole -> find('all', array('recursive' => -1));
        if (!empty($data)) {
            $res['status'] = STS_SUCCESS;
            $res['data_res'] = $data;
        } else {
            $res['status'] = STS_ERROR_NOTDATA;
        }

        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * Get list data method
     * @tutorial WS190200, WS190300
     * @throws NotFoundException
     * @param MasterID, Token, user_id
     * @return Array
     * @author Tu Vu
     */

    public function list_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;

        if (isset($data['token'], $data['user_id'], $data['userFlag'])) {
            if (strcmp($data['userFlag'], "True") == 0) {// get data WS190200
                $options = array();
                $options['fields'] = array('User.id', 'User.employee_num', 'User.name', 'User.login', 'User.password', 'User.m_role_id', 'MRole.name');
                $options['conditions'] = array('User.del_flag' => false, 'not' => array('User.employee_num' => null));
                $options['recursive'] = 0;
                $options['order'] = array('User.employee_num ASC');
                $datat = $this -> User -> find('all', $options);

                if (empty($datat)) {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = null;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $datat;
                }
            } else {// get list data  WS190300
                $options = array();
                $options['fields'] = array('User.id', 'User.company_name', 'User.name', 'User.login', 'User.password', 'Customer.id', 'Customer.code', 'Customer.name');
                $options['conditions'] = array('User.del_flag' => false, 'User.employee_num' => null);
                $options['recursive'] = -1;
                $options['order'] = array('User.login ASC');
                $options['joins'] = array( array('table' => 'user_customer_maps', 'alias' => 'UserCustomerMap', 'type' => 'LEFT', 'conditions' => array('User.id = UserCustomerMap.user_id', )), array('table' => 'customers', 'alias' => 'Customer', 'type' => 'LEFT', 'conditions' => array('Customer.id = UserCustomerMap.customer_id', )));

                $datat = $this -> User -> find('all', $options);

                if (!empty($datat)) {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $this -> formatResponseCustomerLogin($datat);
                } else {
                    $res['status'] = STS_ERROR_NOTDATA;
                    $res['data_res'] = null;
                }
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
            $res['data_res'] = null;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * update method
     * @tutorial WS190200, WS190300
     * @return void
     * @author Tu Vu
     */
    public function update() {
        $this -> viewClass = 'Json';
        $dataSource = $this -> User -> getDataSource();
        $dataSource -> begin();

        $res = array();
        $data = array();
        $new_data = array();
        $duplicate = array();
        $old_data = array();

        try {
            if ($this -> request -> is('post')) {
                $data = $this -> request -> data;
                if (isset($data['model'], $data['columns'], $data['values'], $data['token'], $data['user_id'], $data['userFlag'])) {
                    $new_data = $this -> formatDataSaveOneRecord($data);
                    $model = ClassRegistry::init($data['model']);
                    if (!empty($new_data)) {
                        if (empty($new_data['User']['id']) || $new_data['User']['id'] == null || $new_data['User']['id'] == '') {
                            //check duplicate login
                            $options = array();
                            $options['conditions'] = array('login' => $new_data['User']['login'], 'del_flag' => false);
                            $options['recursive'] = -1;
                            $duplicate = $this -> User -> find('first', $options);

                            $new_data['User']['password'] = md5($new_data['User']['password']);
                            $id_max = $this -> User -> find('first', array('fields' => array('MAX(User.id)')));
                            $new_data['User']['id'] = $id_max[0]['max'] + 1;
                            $lastInsertUser = $id_max[0]['max'] + 1;
                        } else {
                            //check duplicate login
                            $options = array();
                            $options['recursive'] = -1;
                            $options['conditions'] = array('login' => $new_data['User']['login'], 'del_flag' => false, 'id not ' => $new_data['User']['id']);
                            $duplicate = $this -> User -> find('first', $options);

                            $old_data = $this -> User -> find('first', array('recursive' => -1, 'conditions' => array('id' => $new_data['User']['id'])));
                            if (!empty($old_data)) {
                                //check change password
                                if (!empty($new_data['User']['password'])) {
                                    $new_data['User']['password'] = md5($new_data['User']['password']);
                                } else {
                                    $new_data['User']['password'] = $old_data['User']['password'];
                                }
                            }
                            $lastInsertUser = $new_data['User']['id'];
                        }

                        if (!empty($duplicate)) {
                            $res['status'] = STS_Duplicate;
                        } else {
                            if ($model -> save($new_data)) {
                                if (isset($data['customer_id']) && strcmp($data['userFlag'], "False") == 0) {
                                    $this -> UserCustomerMap -> deleteAll(array('UserCustomerMap.user_id' => $lastInsertUser));
                                    // set data for insert user_customer_maps
                                    if (!empty($data['customer_id'])) {
                                        if (strpos($data['customer_id'], GLUE_DATA) !== false) {
                                            $data['customer_id'] = explode(GLUE_DATA, $data['customer_id']);
                                        } else {
                                            $data['customer_id'] = array($data['customer_id']);
                                        }
                                        $dataUserCustomerMap = $this -> formatDataSaveManyRecord($data['customer_id'], $lastInsertUser);

                                        // save data for user_customer_maps
                                        foreach ($dataUserCustomerMap as $key => $val) {
                                            $id_max = $this -> UserCustomerMap -> find('first', array('fields' => array('MAX(UserCustomerMap.id)')));
                                            $val['UserCustomerMap']['id'] = $id_max[0]['max'] + 1;
                                            $this -> UserCustomerMap -> save($val);
                                        }
                                    }
                                }
                                $res['status'] = STS_SUCCESS;
                                $dataSource -> commit();
                            } else {
                                $error = $model -> validationErrors;
                                $res['status'] = STS_DB_UPDATE_ERROR;
                            }
                        }
                    } else {
                        $res['status'] = STS_ERROR_NOTDATA;
                    }
                } else {
                    $res['status'] = STS_ERROR_MISSINGDATA;
                }

            }
        } catch (Exception $e) {
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
            $dataSource -> rollback();
        }

        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * delete method
     * @tutorial WS190200, WS190300
     * @throws NotFoundException
     * @param token,user_id,id
     * @return void
     * @author GiangNT
     */
    public function delete() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['id'], $data['token'],  $data['user_id'])) {
            $listId = explode(GLUE_DATA, $data['id']);
            $conditions = array('User.id' => $listId);
            if ($this -> User -> updateAll(array('User.del_flag' => TRUE), $conditions)) {
                $id_true = $this -> User -> find('list', array('order' => array('User.id'), 'conditions' => array('User.del_flag' => TRUE, 'User.id' => $listId), 'fields' => array('User.id')));
                if (count($listId) == count($id_true)) {
                    $res['status'] = STS_SUCCESS;
                } else {
                    $res['status'] = STS_DB_DELETE;
                }
                $res['data_res'] = implode(GLUE_DATA, $id_true);
            } else {
                $res['status'] = STS_DB_DELETE;
                $res['data_res'] = $data['id'];
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
	}

    private function formatDataSaveOneRecord($data = array()) {
        $dataf = array();
        $columns = explode(GLUE, $data['columns']);
        $values = explode(GLUE, $data['values']);
        if (count($columns) == count($values)) {
            for ($i = 0; $i < count($columns); $i++) {
                $dataf[$data['model']][trim($columns[$i])] = trim($values[$i]);
            }
        } else {
            $dataf = null;
        }
        return $dataf;
    }

    private function formatDataSaveManyRecord($data = array(), $userID = Interger) {
        $dataUserCustomerMap = array();
        $i = 0;
        foreach ($data as $key => $val) {
            $dataUserCustomerMap[$i]['UserCustomerMap']['user_id'] = $userID;
            $dataUserCustomerMap[$i]['UserCustomerMap']['customer_id'] = $val;
            $i++;
        }
        return $dataUserCustomerMap;
    }

    /**
     * search method
     *
     * @throws NotFoundException
     * @param code,model
     * @return json
     * @author GiangNT
     */
    public function search() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['code'])) {
            $nameModel = 'User';
            if ($this -> Check -> isset_model($nameModel)) {
                $this -> loadModel($nameModel);
                $fields = array($nameModel . '.id', $nameModel . '.login', $nameModel . '.name');
                $conditions = array($nameModel . '.login' => $data['code'], $nameModel . '.del_flag' => FALSE);
                $data_find[0] = $this -> $nameModel -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
                if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                    $res['status'] = STS_EMPTY;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $data_find;
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
     *
     * @throws NotFoundException
     * @param array
     * @return array
     * @author Tu Vu
     */
    private function formatResponseCustomerLogin($datat = array()) {
        $totalArr = count($datat);
        $dataf = array();
        $k = 0;
        $l = 0;
        $i = 0;
        $tmp = array();
        if ($totalArr == 1) {
            if (empty($datat[$i]['Customer']['id']) && empty($datat[$i]['Customer']['code']) && empty($datat[$i]['Customer']['name'])) {
                $tmp = null;
            } else {
                $tmp[$l]['id'] = $datat[$i]['Customer']['id'];
                $tmp[$l]['code'] = $datat[$i]['Customer']['code'];
                $tmp[$l]['name'] = $datat[$i]['Customer']['name'];
            }

            $dataf[$l]['User']['id'] = $datat[$i]['User']['id'];
            $dataf[$l]['User']['company_name'] = $datat[$i]['User']['company_name'];
            $dataf[$l]['User']['name'] = $datat[$i]['User']['name'];
            $dataf[$l]['User']['login'] = $datat[$i]['User']['login'];
            $dataf[$l]['User']['password'] = $datat[$i]['User']['password'];
            $dataf[$l]['User']['combo'] = $tmp;

        } else {
            for ($i; $i < $totalArr - 1; $i++) {
                if ($datat[$i]['User']['id'] != $datat[$i + 1]['User']['id']) {
                    if (empty($datat[$i]['Customer']['id']) && empty($datat[$i]['Customer']['code']) && empty($datat[$i]['Customer']['name'])) {
                        $tmp = null;
                    } else {
                        $tmp[$l]['id'] = $datat[$i]['Customer']['id'];
                        $tmp[$l]['code'] = $datat[$i]['Customer']['code'];
                        $tmp[$l]['name'] = $datat[$i]['Customer']['name'];
                    }

                    $dataf[$k]['User']['id'] = $datat[$i]['User']['id'];
                    $dataf[$k]['User']['company_name'] = $datat[$i]['User']['company_name'];
                    $dataf[$k]['User']['name'] = $datat[$i]['User']['name'];
                    $dataf[$k]['User']['login'] = $datat[$i]['User']['login'];
                    $dataf[$k]['User']['password'] = $datat[$i]['User']['password'];
                    $dataf[$k]['User']['combo'] = $tmp;
                    $tmp = null;
                    $k++;
                    $l = 0;

                    if ($i == $totalArr - 2) {
                        if (empty($datat[$i + 1]['Customer']['id']) && empty($datat[$i + 1]['Customer']['code']) && empty($datat[$i + 1]['Customer']['name'])) {
                            $tmp = null;
                        } else {
                            $tmp[$l]['id'] = $datat[$i + 1]['Customer']['id'];
                            $tmp[$l]['code'] = $datat[$i + 1]['Customer']['code'];
                            $tmp[$l]['name'] = $datat[$i + 1]['Customer']['name'];
                        }

                        $dataf[$k]['User']['id'] = $datat[$i + 1]['User']['id'];
                        $dataf[$k]['User']['company_name'] = $datat[$i + 1]['User']['company_name'];
                        $dataf[$k]['User']['name'] = $datat[$i + 1]['User']['name'];
                        $dataf[$k]['User']['login'] = $datat[$i + 1]['User']['login'];
                        $dataf[$k]['User']['password'] = $datat[$i + 1]['User']['password'];
                        $dataf[$k]['User']['combo'] = $tmp;
                    }
                } else {
                    $tmp[$l]['id'] = $datat[$i]['Customer']['id'];
                    $tmp[$l]['code'] = $datat[$i]['Customer']['code'];
                    $tmp[$l]['name'] = $datat[$i]['Customer']['name'];

                    $l++;

                    if ($i == $totalArr - 2) {
                        $tmp[$l]['id'] = $datat[$i + 1]['Customer']['id'];
                        $tmp[$l]['code'] = $datat[$i + 1]['Customer']['code'];
                        $tmp[$l]['name'] = $datat[$i + 1]['Customer']['name'];

                        $dataf[$k]['User']['id'] = $datat[$i + 1]['User']['id'];
                        $dataf[$k]['User']['company_name'] = $datat[$i + 1]['User']['company_name'];
                        $dataf[$k]['User']['name'] = $datat[$i + 1]['User']['name'];
                        $dataf[$k]['User']['login'] = $datat[$i + 1]['User']['login'];
                        $dataf[$k]['User']['password'] = $datat[$i + 1]['User']['password'];
                        $dataf[$k]['User']['combo'] = $tmp;

                    }
                }
            }
        }
        return $dataf;
    }

}
?>
