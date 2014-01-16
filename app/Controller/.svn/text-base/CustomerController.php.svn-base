<?php
App::uses('AppController', 'Controller');

class CustomerController extends AppController {
    //public $name = 'customer';
    public $uses = array('Token', 'Customer', 'User', 'MClassify', 'MWithdrawal', 'MCutoffType');
    public $components = array('Format', 'FormatRespon', 'Common', 'Check');

    /**
     * list_data method
     * WS120301
     * @throws Exception
     * @param user_id, token, CusCode, CusNam, login
     * @return json
     * @author GiangNT
     */
    public function list_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        // debug($data);die;
        if (isset($data['user_id'], $data['token'], $data['CusCode'], $data['CusNam'], $data['login'])) {
            
            $condtions = array(
                'ltrim(UPPER(Customer.code)) LIKE' => $this->Common->queryUpper($data['CusCode']) . "%", 
                'UPPER(Customer.name) LIKE' => "%" . $this->Common->queryUpper($data['CusNam']) . "%", 
                'Customer.disp_flag' => TRUE, 
                'Customer.del_flag' => FALSE,
            );
            
            if (!empty($data['login'])) {
                $condtions['UPPER(User.login) LIKE'] = "%" . $this->Common->queryUpper($data['login']) . "%";
            } 
            $fields = array('Customer.id', 'Customer.code', 'Customer.name', 'Customer.total_type', 'Customer.withdrawal_day', 'User.name', 'MCutoffType.name', 'MWithdrawalCycle.name');
            $data_customers = $this -> Customer -> find('all', array('order' => array('Customer.code'), 'recursive' => 0, 'conditions' => $condtions, 'fields' => $fields));
            $res['status'] = STS_SUCCESS;
            $res['data_res'] = $data_customers;
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * del method
     * WS120301
     * @throws Exception
     * @param model, id, token
     * @return json
     * @author GiangNT
     */

    public function del() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['id'], $data['token'],  $data['user_id'])) {
            $listId = explode(GLUE_DATA, $data['id']);
            $conditions = array('Customer.id' => $listId);
            if ($this -> Customer -> updateAll(array('Customer.del_flag' => TRUE), $conditions)) {
                $id_true = $this -> Customer -> find('list', array('order' => array('Customer.id'), 'conditions' => array('Customer.del_flag' => TRUE, 'Customer.id' => $listId), 'fields' => array('Customer.id')));
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

    /**
     * get_data method
     * WS120302
     * @throws Exception
     * @param user_id, token, custId, code
     * @return json
     * @author GiangNT
     */

    public function get_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['custId']) || isset($data['token'], $data['user_id'], $data['code'])) {
            if (isset($data['custId'])) {
                $conditions = array('Customer.id' => $data['custId'], 'Customer.del_flag' => FALSE);
            }
            if (isset($data['code'])) {
                $conditions = array('Customer.code' => $data['code'], 'Customer.del_flag' => FALSE);
            }
            $fields = array();
            $data_find[] = $this -> Customer -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => 0));
            if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                $res['status'] = STS_EMPTY;
            } else {
                $bill_customer_id = $data_find[0]['Customer']['bill_customer_id'];
                $info_bill = $this -> Customer -> find('first', array('conditions' => array('Customer.id' => $bill_customer_id), 'fields' => array('Customer.code', 'Customer.name'), 'recursive' => -1));
                // MClassify
                $m_classify_id1 = $data_find[0]['Customer']['m_classify_id1'];
                $m_classify_id2 = $data_find[0]['Customer']['m_classify_id2'];
                $m_classify_id3 = $data_find[0]['Customer']['m_classify_id3'];
                $m_classify_id4 = $data_find[0]['Customer']['m_classify_id4'];
                $m_classify_id5 = $data_find[0]['Customer']['m_classify_id5'];

                $tmp1 = $this -> MClassify -> find('first', array('conditions' => array('MClassify.id' => $m_classify_id1, 'MClassify.num' => 1)));
                $tmp2 = $this -> MClassify -> find('first', array('conditions' => array('MClassify.id' => $m_classify_id2, 'MClassify.num' => 2)));
                $tmp3 = $this -> MClassify -> find('first', array('conditions' => array('MClassify.id' => $m_classify_id3, 'MClassify.num' => 3)));
                $tmp4 = $this -> MClassify -> find('first', array('conditions' => array('MClassify.id' => $m_classify_id4, 'MClassify.num' => 4)));
                $tmp5 = $this -> MClassify -> find('first', array('conditions' => array('MClassify.id' => $m_classify_id5, 'MClassify.num' => 5)));
                if (!empty($info_bill)) {$data_find[0]['Bill_Customer'] = $info_bill['Customer'];
                } else {$data_find[0]['Bill_Customer'] = array('code' => '', 'name' => '');
                }
                if (!empty($tmp1)) { $data_find[0]['m_classify_id1'] = $tmp1['MClassify'];
                } else {$data_find[0]['m_classify_id1'] = array('id' => '', 'code' => '', 'name' => '');
                }
                if (!empty($tmp2)) { $data_find[0]['m_classify_id2'] = $tmp2['MClassify'];
                } else {$data_find[0]['m_classify_id2'] = array('id' => '', 'code' => '', 'name' => '');
                }
                if (!empty($tmp3)) { $data_find[0]['m_classify_id3'] = $tmp3['MClassify'];
                } else {$data_find[0]['m_classify_id3'] = array('id' => '', 'code' => '', 'name' => '');
                }
                if (!empty($tmp4)) { $data_find[0]['m_classify_id4'] = $tmp4['MClassify'];
                } else {$data_find[0]['m_classify_id4'] = array('id' => '', 'code' => '', 'name' => '');
                }
                if (!empty($tmp5)) { $data_find[0]['m_classify_id5'] = $tmp5['MClassify'];
                } else {$data_find[0]['m_classify_id5'] = array('id' => '', 'code' => '', 'name' => '');
                }
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
     * updateCustomer method
     * WS120302
     * @throws Exception
     * @param token, user_id, fields_in, value, model, fields_out
     * @return json
     * @author GiangNT
     */

    public function update() {
        $this -> viewClass = 'Json';
        $res = array();
        $flag = TRUE;
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['fields_in'], $data['value'], $data['model'], $data['fields_out'])) {
            if ($this -> Check -> isset_model($data['model'])) {
                $this -> loadModel($data['model']);
                $model = ClassRegistry::init($data['model']);
                //================
                $new_data = $this -> Format -> formatSaveData($data['model'], $data['fields_in'], $data['value']);
                // debug($new_data);
                if (empty($new_data[0]['Customer']['id'])) {
                    $id_max = $this -> Customer -> find('first', array('fields' => array('MAX(Customer.id)')));
                    $id_new = $id_max[0]['max'] + 1;
                    $new_data[0]['Customer']['id'] = $id_new;
                    //bill_customer_id
                    if (empty($new_data[0]['Customer']['bill_customer_id'])) {
                        $new_data[0]['Customer']['bill_customer_id'] = $id_new;
                    } else {
                        $tmp_bill_customer_id = $this -> Customer -> find('first', array('recursive' => -1, 'fields' => array('Customer.id'), 'conditions' => array('Customer.code' => $new_data[0]['Customer']['bill_customer_id'])));
                        if (!empty($tmp_bill_customer_id)) {
                            $new_data[0]['Customer']['bill_customer_id'] = $tmp_bill_customer_id['Customer']['id'];
                        } else {
                            $flag = FALSE;
                            $res['error'][] = 'not bill_customer_id';
                        }
                    }
                } else {
                    //bill_customer_id
                    if (empty($new_data[0]['Customer']['bill_customer_id'])) {
                        $new_data[0]['Customer']['id'] = $new_data[0]['Customer']['id'];
                    } else {
                        $tmp_bill_customer_id = $this -> Customer -> find('first', array('recursive' => -1, 'fields' => array('Customer.id'), 'conditions' => array('Customer.code' => $new_data[0]['Customer']['bill_customer_id'])));
                        if (!empty($tmp_bill_customer_id)) {
                            $new_data[0]['Customer']['bill_customer_id'] = $tmp_bill_customer_id['Customer']['id'];
                        } else {
                            $flag = FALSE;
                            $res['error'][] = 'not bill_customer_id';
                        }
                    }
                }

                if (!empty($new_data[0]['Customer']['user_id'])) {
                    $tmp_user_id = $this -> User -> find('first', array('recursive' => -1, 'fields' => array('User.id'), 'conditions' => array('User.login' => $new_data[0]['Customer']['user_id'])));
                    if (empty($tmp_user_id)) {
                        $flag = FALSE;
                        $res['error'][] = 'not user_id';
                    } else {
                        $new_data[0]['Customer']['user_id'] = $tmp_user_id['User']['id'];
                    }
                }
                if (!empty($new_data[0]['Customer']['m_cutoff_type_id'])) {
                    $tmp_m_cutoff_type_id = $this -> MCutoffType -> find('first', array('recursive' => -1, 'fields' => array('MCutoffType.id'), 'conditions' => array('MCutoffType.code' => $new_data[0]['Customer']['m_cutoff_type_id'])));
                    if (empty($tmp_m_cutoff_type_id)) {
                        $flag = FALSE;
                        $res['error'][] = 'not m_cutoff_type_id';
                    } else {
                        $new_data[0]['Customer']['m_cutoff_type_id'] = $tmp_m_cutoff_type_id['MCutoffType']['id'];
                    }
                }
                if (!empty($new_data[0]['Customer']['m_withdrawal_id'])) {
                    $tmp_m_withdrawal_id = $this -> MWithdrawal -> find('first', array('recursive' => -1, 'fields' => array('MWithdrawal.id'), 'conditions' => array('MWithdrawal.code' => $new_data[0]['Customer']['m_withdrawal_id'])));
                    if (empty($tmp_m_withdrawal_id)) {
                        $flag = FALSE;
                        $res['error'][] = 'not m_withdrawal_id';
                    } else {
                        $new_data[0]['Customer']['m_withdrawal_id'] = $tmp_m_withdrawal_id['MWithdrawal']['id'];
                    }
                }
                if (!empty($new_data[0]['Customer']['m_classify_id1'])) {
                    $tmp_classify1 = $this -> MClassify -> find('first', array('recursive' => -1, 'conditions' => array('MClassify.code' => $new_data[0]['Customer']['m_classify_id1'], 'MClassify.num' => 1), 'fields' => array('MClassify.id')));
                    if (!empty($tmp_classify1)) {
                        $new_data[0]['Customer']['m_classify_id1'] = $tmp_classify1['MClassify']['id'];
                    } else {
                        $flag = FALSE;
                        $res['error'][] = 'not m_classify_id1';
                    }
                }
                if (!empty($new_data[0]['Customer']['m_classify_id2'])) {
                    $tmp_classify2 = $this -> MClassify -> find('first', array('recursive' => -1, 'conditions' => array('MClassify.code' => $new_data[0]['Customer']['m_classify_id2'], 'MClassify.num' => 2), 'fields' => array('MClassify.id')));
                    if (!empty($tmp_classify2)) {
                        $new_data[0]['Customer']['m_classify_id2'] = $tmp_classify2['MClassify']['id'];
                    } else {
                        $flag = FALSE;
                        $res['error'][] = 'not m_classify_id2';
                    }
                }
                if (!empty($new_data[0]['Customer']['m_classify_id3'])) {
                    $tmp_classify3 = $this -> MClassify -> find('first', array('recursive' => -1, 'conditions' => array('MClassify.code' => $new_data[0]['Customer']['m_classify_id3'], 'MClassify.num' => 3), 'fields' => array('MClassify.id')));
                    if (!empty($tmp_classify3)) {
                        $new_data[0]['Customer']['m_classify_id3'] = $tmp_classify3['MClassify']['id'];
                    } else {
                        $flag = FALSE;
                        $res['error'][] = 'not m_classify_id3';
                    }
                }
                if (!empty($new_data[0]['Customer']['m_classify_id4'])) {
                    $tmp_classify4 = $this -> MClassify -> find('first', array('recursive' => -1, 'conditions' => array('MClassify.code' => $new_data[0]['Customer']['m_classify_id4'], 'MClassify.num' => 4), 'fields' => array('MClassify.id')));
                    if (!empty($tmp_classify4)) {
                        $new_data[0]['Customer']['m_classify_id4'] = $tmp_classify4['MClassify']['id'];
                    } else {
                        $flag = FALSE;
                        $res['error'][] = 'not m_classify_id4';
                    }
                }
                if (!empty($new_data[0]['Customer']['m_classify_id5'])) {
                    $tmp_classify5 = $this -> MClassify -> find('first', array('recursive' => -1, 'conditions' => array('MClassify.code' => $new_data[0]['Customer']['m_classify_id5'], 'MClassify.num' => 5), 'fields' => array('MClassify.id')));
                    if (!empty($tmp_classify5)) {
                        $new_data[0]['Customer']['m_classify_id5'] = $tmp_classify5['MClassify']['id'];
                    } else {
                        $flag = FALSE;
                        $res['error'][] = 'not m_classify_id5';
                    }
                }
                if (!empty($new_data) && $flag) {
                    try {
                        if ($model -> save($new_data[0])) {
                            $res['status'] = STS_SUCCESS;
                            $res['id'] = $model -> getInsertID();
                        } else {
                            $error = $model -> validationErrors;
                            $res['status'] = STS_DB_UPDATE_ERROR;
                            if (isset($error['code'][0]) && $error['code'][0] == 'unique') {
                                $res['status'] = STS_Duplicate;
                            }
                        }
                    } catch(Exception $e) {
                        echo 'Exception: ', $e -> getMessage(), "\n";
                        $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
                    }
                } else {
                    $res['status'] = STS_ERROR_NOTDATA;
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
     * Search Customer method
     * @tutorial WS190300
     * @throws NotFoundException
     * @param string $customer_code
     * @return record Customer
     * @author GiangNT
     */
    public function search() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['code'])) {
            try {
                $fields = array('Customer.id', 'Customer.code', 'Customer.name');
                $conditions = array('Customer.code' => $data['code'], 'Customer.del_flag' => FALSE);
                $data_find[0] = $this -> Customer -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
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
