<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class SpecController extends AppController {
    public $name = 'Spec';
    public $uses = array('Token', 'Spec', 'Goods', 'PaperInventory', 'MPaperSize', 'MPaper', 'Customer', 'User', 'SpecDetail', 'SpecOutsource', 'MProcess', 'InventoryType', 'Fold', 'InventoryOutsource');
    public $components = array('Format', 'Check', 'FormatRespon', 'Common');

    /**
     * get_data method
     * WS030200
     * @throws NotFoundException
     * @param  id,token,user_id
     * @return json
     * @author GiangNT
     */
    public function get_data() {
        $this -> viewClass = 'Json';
        $res = array();
        //$data = $this -> request -> data;
        $this->log($data, LOG_DEBUG);
        if (isset($data['id'], $data['token'], $data['user_id'])) {
            try {
                if (!$this -> Spec -> exists($data['id'])) {
                    $res['status'] = STS_EMPTY_ID;
                    goto set;
                }
                $data_find = $this -> getData($data['id']);
                if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                    $res['status'] = STS_EMPTY;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $data_find;
                }
            } catch(Exception $e) {
                echo 'Exception: ', $e -> getMessage(), "\n";
                $this -> log('Exception: ' . $e -> getMessage(), LOG_ERR);
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * get_latest_data method
     * WS030200
     * @throws NotFoundException
     * @param  token,user_id,customerID,goodsID
     * @return json
     * @author GiangNT
     */

    public function get_latest_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['customerID'], $data['goodsID'])) {
            try {
                $conditions = array('Spec.customer_id' => $data['customerID'], 'Spec.goods_id' => $data['goodsID'], 'Spec.del_flag' => FALSE);

                $this -> Customer -> unbindModel(array('hasMany' => array('ConsignorMap', 'ConsignorList', 'CustomerDept', 'Delivery', 'DeliveryNote', 'Estimate', 'Goods', 'Spec', 'UserCustomerMap')));
                $this -> Customer -> unbindModel(array('belongsTo' => array('User')));
                $this -> InventoryType -> unbindModel(array('hasMany' => array('Spec')));
                $this -> Fold -> unbindModel(array('hasMany' => array('Spec')));
                $this -> MPaperSize -> unbindModel(array('hasMany' => array('MPaper', 'MPrintPrice')));
                $this -> SpecOutsource -> unbindModel(array('belongsTo' => array('Spec')));
                $this -> Goods -> unbindModel(array('belongsTo' => array('Customer')));
                $this -> SpecDetail -> unbindModel(array('belongsTo' => array('Spec')));
                $this -> PaperInventory -> unbindModel(array('belongsTo' => array('Spec', 'User')));

                $data_find[0] = $this -> Spec -> find('first', array('conditions' => $conditions, 'order' => array('Spec.order_num DESC'), 'recursive' => 2, 'limit' => 1));

                if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                    $res['status'] = STS_EMPTY;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $data_find;
                }
            } catch(Exception $e) {
                echo 'Exception: ', $e -> getMessage(), "\n";
                $this -> log('Exception: ' . $e -> getMessage(), LOG_ERR);
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * add_only method
     * WS030100, ....
     * @throws NotFoundException
     * @param  token, user_id, fields_in, value, model, fields_out
     * @return json
     * @author GiangNT
     */
    public function add_only() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['fields_in'], $data['value'], $data['model'], $data['fields_out'])) {

            //================
            $new_data = $this -> Format -> formatSaveData($data['model'], $data['fields_in'], $data['value']);
            $list_goods_id = $this -> Goods -> getCode($new_data[0]['Spec']['goods_id']);
            $conditions_max = array('Spec.customer_id' => $new_data[0]['Spec']['customer_id'], 'Spec.goods_id' => $list_goods_id);
            $fields_MAX = array('MAX(Spec.order_num)');
            $max_oder_num = $this -> Spec -> find('first', array('fields' => $fields_MAX, 'conditions' => $conditions_max, 'recursive' => 0));
            $new_data[0]['Spec']['order_num'] = $max_oder_num[0]['max'] + 1;
            $model = ClassRegistry::init($data['model']);
            if (!empty($new_data)) {
                if ($model -> saveAll($new_data)) {
                    $res['status'] = STS_SUCCESS;
                    $res['id'] = $model -> id;
                } else {
                    $error = $model -> validationErrors;
                    $this->log($error, LOG_DEBUG);
                    $res['status'] = STS_DB_UPDATE_ERROR;
                }
            } else {
                $res['status'] = STS_ERROR_AUTH;
            }
            //=============================
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));

    }

    /**
     * Update Spec method
     * @tutorial WS030201
     * @throws NotFoundException
     * @param  token,user_id,Spec_title,Spec_value,Spec_Detail_title,Spec_Detail_value,Spec_Outsource_title,Spec_Outsource_value
     * @return array
     * @author GiangNT
     */

    public function update() {
        $this -> viewClass = 'Json';
        $res = array();
        $PaperInventory_data = array();
        $flag = TRUE;
        $date = date("Y-m-d H:i:s");
        $data = $this -> request -> data;
        $this->log($data, LOG_DEBUG);
        if (!isset($data['token'], $data['user_id'], $data['Spec_title'], $data['Spec_value'], $data['Spec_Detail_title'], $data['Spec_Detail_value'], $data['Spec_Outsource_title'], $data['Spec_Outsource_value']) || empty($data['user_id'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        try {
            $spec_data = $this -> Format -> formatDataAssociate($data['Spec_title'], $data['Spec_value'], 0);
            $spec_detail_datas = $this -> Format -> formatDataAssociate($data['Spec_Detail_title'], $data['Spec_Detail_value'], 0);
            $spec_outsource_datas = $this -> Format -> formatDataAssociate($data['Spec_Outsource_title'], $data['Spec_Outsource_value'], 0);
            // New Goods, New MPaper
            $data_Goods = $this -> MPaper -> getDataSource();
            $data_MPaper = $this -> MPaper -> getDataSource();
            $data_Spec = $this -> Spec -> getDataSource();
            $data_Outsource = $this -> SpecOutsource -> getDataSource();
            $data_Spec_Detail = $this -> SpecDetail -> getDataSource();
            $data_Paper_Inventory = $this -> PaperInventory -> getDataSource();

            $data_Goods -> begin();
            $data_MPaper -> begin();
            $data_Spec -> begin();
            $data_Outsource -> begin();
            $data_Spec_Detail -> begin();
            $data_Paper_Inventory -> begin();
            if (!$this -> Goods -> issetRecord(array('Goods.code' => $spec_data[0]['Goods']['code'], 'Goods.customer_id' => $spec_data[0]['Spec']['customer_id']))) {
                $Goods_new_data = array('code' => $spec_data[0]['Goods']['code'], 'customer_id' => $spec_data[0]['Spec']['customer_id'], 'name' => $spec_data[0]['Goods']['name'], );
                $this -> Goods -> create();
                if ($this -> Goods -> save($Goods_new_data)) {
                    $spec_data[0]['Spec']['goods_id'] = $this -> Goods -> id;
                } else {
                    $flag = FALSE;
                    $res['error'] = "add goods error";
                    $res['validate'] = $this -> Goods -> validationErrors;

                }
            }

            foreach ($spec_detail_datas as $key_spec_detail => $spec_detail_data) {

                if ($spec_detail_data['SpecDetail']['print_num'] != (int)$spec_detail_data['SpecDetail']['print_num']) {
                    $spec_detail_datas[$key_spec_detail]['SpecDetail']['print_num'] = (int)$spec_detail_data['SpecDetail']['print_num'] + 1;
                }
                
                if (!empty($spec_data[0]['Spec']['id'])) {
                    $spec_detail_datas[$key_spec_detail]['SpecDetail']['spec_id'] = $spec_data[0]['Spec']['id'];
                }

                //MPaper
                if(empty($spec_data[0]['Spec']['m_paper_size_id']) || empty($spec_detail_data['MPaper']['code'])){
                   continue;
                }
                
                //PaperInventory
                $PaperInventory_data[$key_spec_detail]['PaperInventory']['inventory_num'] = $spec_detail_datas[$key_spec_detail]['SpecDetail']['print_num'] + $spec_detail_datas[$key_spec_detail]['SpecDetail']['reserve_num'];
                $PaperInventory_data[$key_spec_detail]['PaperInventory']['inventory_date'] = $date;
                $PaperInventory_data[$key_spec_detail]['PaperInventory']['user_id'] = $data['user_id'];
				$PaperInventory_data[$key_spec_detail]['PaperInventory']['spec_id'] = $spec_data[0]['Spec']['id'];
				
                if (!$this -> MPaper -> issetRecord(array('MPaper.code' => $spec_detail_data['MPaper']['code'], 'MPaper.m_paper_size_id' => $spec_data[0]['Spec']['m_paper_size_id']))) {
                    $cur_num = 0 - $PaperInventory_data[$key_spec_detail]['PaperInventory']['inventory_num'];
                    $MPaper_new_data = array('code' => $spec_detail_data['MPaper']['code'], 'm_paper_size_id' => $spec_data[0]['Spec']['m_paper_size_id'], 'unit_price' => 0, 'cur_num' => $cur_num);
                    $this -> MPaper -> create();
                    
                    if ($this -> MPaper -> save($MPaper_new_data)) {
                        $PaperInventory_data[$key_spec_detail]['PaperInventory']['m_paper_id'] = $spec_detail_datas[$key_spec_detail]['SpecDetail']['m_paper_id'] = $this -> MPaper -> id;

                        $PaperInventory_data[$key_spec_detail]['PaperInventory']['prev_num'] = 0;
                    } else {
                        $flag = FALSE;
                        $res['error'] = "add Mpaper error";
                        $res['validate'] = $this -> MPaper -> validationErrors;
                    }
                } else {
                    $conditions_mpaper = array('MPaper.code' => $spec_detail_data['MPaper']['code'], 'MPaper.m_paper_size_id' => $spec_data[0]['Spec']['m_paper_size_id']);
                    $MPaper_data = $this -> MPaper -> find('first', array('conditions' => $conditions_mpaper, 'fields' => array('MPaper.id', 'MPaper.cur_num'), 'recursive' => -1));
                    $spec_detail_datas[$key_spec_detail]['SpecDetail']['m_paper_id'] = $MPaper_data['MPaper']['id'];
                    $cur_num = $MPaper_data['MPaper']['cur_num'] - $PaperInventory_data[$key_spec_detail]['PaperInventory']['inventory_num'];

                    $PaperInventory_data[$key_spec_detail]['PaperInventory']['m_paper_id'] = $MPaper_data['MPaper']['id'];
                    $PaperInventory_data[$key_spec_detail]['PaperInventory']['prev_num'] = $MPaper_data['MPaper']['cur_num'];

                    if (!$this -> MPaper -> updateAll(array('MPaper.cur_num' => $cur_num), array('MPaper.id' => $MPaper_data['MPaper']['id']))) {
                        $flag = FALSE;
                        $res['error'] = "Update cur_num Mpaper";
                    }
                }
            }
            
            if ($flag) {
                $spec_data[0]['Spec']['printout_date'] = $date;
                if (empty($spec_data[0]['Spec']['id'])) {
                    $spec_data[0]['Spec']['printout_count'] = 1;
                    $spec_data[0]['Spec']['m_process_id'] = 2;

                    // get ordernum
                    $list_goods_id = $this -> Goods -> getCode($spec_data[0]['Spec']['goods_id']);
                    $conditions_max = array('Spec.customer_id' => $spec_data[0]['Spec']['customer_id'], 'Spec.goods_id' => $list_goods_id);
                    $fields_MAX = array('MAX(Spec.order_num)');
                    $max_oder_num = $this -> Spec -> find('first', array('fields' => $fields_MAX, 'conditions' => $conditions_max, 'recursive' => -1));
                    $spec_data[0]['Spec']['order_num'] = $max_oder_num[0]['max'] + 1;

                    //save
                    if ($this -> Spec -> saveAll($spec_data)) {
                        $id_spec_new = $this -> Spec -> id;
                    } else {
                        $res['error'] = "Save Spec error";
                        $res['validate'] = $this -> Spec -> validationErrors;
                        goto rollback;
                    }
                    
                    //add spec_id into paperinvertory
                    foreach ($PaperInventory_data as $key_pi => &$value_pi) {
                        $value_pi['PaperInventory']['spec_id'] = $id_spec_new;
                    }
                    
                    foreach ($spec_detail_datas as $key_spec_detail => $spec_detail_data) {
                        $spec_detail_datas[$key_spec_detail]['SpecDetail']['spec_id'] = $id_spec_new;
                    }
                    
                    foreach ($spec_outsource_datas as $key_spec_outsorce => $spec_outsource_data) {
                        $spec_outsource_datas[$key_spec_outsorce]['SpecOutsource']['spec_id'] = $id_spec_new;
                    }

                    if (!empty($spec_detail_datas)) {
                        if (!$this -> SpecDetail -> saveAll($spec_detail_datas)) {
                            $res['error'] = "add Specdetail  error";
                            $res['validate'] = $this -> SpecDetail -> validationErrors;
                            goto rollback;
                        }
                    }
                    if (!empty($spec_outsource_datas)) {
                        if (!$this -> SpecOutsource -> saveAll($spec_outsource_datas)) {
                            $res['error'] = "add  Spec Outsourt error";
                            $res['validate'] = $this -> SpecOutsource -> validationErrors;
                            goto rollback;
                        }
                    }

                } else {
                    //Del all spec-detail spec-outsource
                    $list_spec_detail_id = $this -> SpecDetail -> find('list', array('conditions' => array('SpecDetail.spec_id' => $spec_data[0]['Spec']['id']), 'fields' => array('SpecDetail.id')));
                    $list_spec_outsource_id = $this -> SpecOutsource -> find('list', array('conditions' => array('SpecOutsource.spec_id' => $spec_data[0]['Spec']['id']), 'fields' => array('SpecOutsource.id')));
                    if (!empty($list_spec_detail_id)) {
                        if (!$this -> SpecDetail -> deleteAll(array('SpecDetail.id' => $list_spec_detail_id), false)) {
                            $res['error'] = "del Specdetail or SpecOutsource error";
                            goto rollback;
                        }
                    }
                    if (!empty($list_spec_outsource_id)) {
                        if (!$this -> SpecOutsource -> deleteAll(array('SpecOutsource.id' => $list_spec_outsource_id), false)) {
                            $res['error'] = "del Specdetail or SpecOutsource error";
                            goto rollback;
                        }
                    }
                    foreach ($spec_outsource_datas as $key_spec_outsorce => $spec_outsource_data) {
                        $spec_outsource_datas[$key_spec_outsorce]['SpecOutsource']['spec_id'] = $spec_data[0]['Spec']['id'];
                    }
                    $printout_count = $this -> Spec -> find('first', array('conditions' => array('Spec.id' => $spec_data[0]['Spec']['id']), 'fields' => array('Spec.printout_count'), 'recursive' => -1));
                    $spec_data[0]['Spec']['printout_count'] = (int)$printout_count['Spec']['printout_count'] + 1;
                    if (!$this -> Spec -> saveAll($spec_data)) {
                        $res['error'] = "add Spec error";
                        $res['validate'] = $this -> Spec -> validationErrors;
                        goto rollback;
                    }
                    if (!empty($spec_detail_datas)) {
                        if (!$this -> SpecDetail -> saveAll($spec_detail_datas)) {
                            $res['error'] = "add Specdetail  error";
                            $res['validate'] = $this -> SpecDetail -> validationErrors;
                            goto rollback;
                        }
                    }
                    if (!empty($spec_outsource_datas)) {
                        if (!$this -> SpecOutsource -> saveAll($spec_outsource_datas)) {
                            $res['error'] = "add  Spec Outsourt error";
                            $res['validate'] = $this -> SpecOutsource -> validationErrors;
                            goto rollback;
                        }
                    }
                }

                $this->log($PaperInventory_data, LOG_DEBUG);

                if (!empty($PaperInventory_data)) {
                    if (!$this -> PaperInventory -> saveAll($PaperInventory_data)) {
                        $res['error'] = "add PaperInventory error";
                        $res['validate'] = $this -> PaperInventory -> validationErrors;
                        goto rollback;
                    }
                }
                $data_Goods -> commit();
                $data_MPaper -> commit();
                $data_Spec_Detail -> commit();
                $data_Outsource -> commit();
                $data_Spec -> commit();
                $data_Paper_Inventory -> commit();
                $res['status'] = STS_SUCCESS;
                if (isset($id_spec_new)) {
                    $res['data_res'] = $this -> getData($id_spec_new);
                } else {
                    $res['data_res'] = $this -> getData($spec_data[0]['Spec']['id']);
                }
            } else {
                rollback:
                $res['status'] = STS_DB_UPDATE_ERROR;
                $data_Goods -> rollback();
                $data_MPaper -> rollback();
                $data_Spec_Detail -> rollback();
                $data_Outsource -> rollback();
                $data_Spec -> rollback();
                $data_Paper_Inventory -> rollback();
            }

        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERR);
        }
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /*
     * @author Tu Vu
     * @tutorial WS030201
     * */

    private function searchByIdAndModel($model = String, $id = String) {
        $this -> loadModel($model);
        $instanceOfModel = ClassRegistry::init($model);
        $colums = $instanceOfModel -> getColumnTypes();
        if (array_key_exists('del_flag', $colums)) {
            $options['conditions'] = array($model . '.id' => $id, $model . '.del_flag' => false);
        } else {
            $options['conditions'] = array($model . '.id' => $id);
        }
        $options['fields'] = array($model . '.id');
        $options['recursive'] = -1;
        return $this -> $model -> find('first', $options);
    }

    /*
     * format one record
     * @param1 $model: Model name need get (example 'User')
     * @param2 $columns: name field of table (example 'User.name', 'Customer.code')
     * @param3 $values: one record value
     * @author Tu Vu
     *
     * */

    private function getManyRecordWithModelField($model = '', $columns = '', $values = '') {
        $result = array();
        $existModelField = array();
        $columns = explode(GLUE, $columns);
        $values = explode(GLUE, $values);

        foreach ($columns as $key => $val) {
            if (strpos($val, '.') !== false) {
                if ($this -> checkModel($val, $model)) {
                    if (!in_array($val, $existModelField)) {
                        $keys = $this -> searchAllKeysWithValue($val, $columns);
                        if (!empty($keys)) {
                            $field = explode('.', $val);
                            foreach ($keys as $k => $v) {
                                $result[$k][$model][$field[1]] = trim($values[$v]);
                            }
                        }
                        array_push($existModelField, $val);
                    }
                }
            }
        }
        return $result;
    }

    /*
     * @author Tu Vu
     * @tutorial WS030201
     *
     * */
    private function searchAllKeysWithValue($value = String, $data = array()) {
        $result = array();
        foreach ($data as $key => $val) {
            if (strcmp($value, $val) == 0) {
                array_push($result, $key);
            }
        }
        return $result;
    }

    /*
     * @author Tu Vu
     * @tutorial WS030201
     *
     * */
    private function checkModel($data = '', $model = '') {
        $flag = false;
        $val = explode('.', $data);
        if (strcmp($model, $val[0]) == 0) {
            $flag = true;
        }
        return $flag;
    }

    /**
     * get_delivery_data method
     *
     * WS090200
     * @return json
     * @author GiangNT
     */
    public function get_delivery_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['specID'], $data['token'], $data['user_id'])) {
            try {
                $id = str_getcsv($data['specID']);
                $fields = array(
                    'Spec.order_num', 
                    'Goods.id', 
                    'Goods.name', 
                    'Goods.code', 
                    'Spec.num', 
                    'Spec.unit',
                    'Spec.unit_price',  
                    'Spec.price', 
                    'Spec.delivery_memo', 
                    'Spec.customer_goods_code', 
                    'Spec.lot', 
                    'Spec.po_delivery_note_flag',
                    'Spec.block_copy_title',
                    'Spec.block_copy_num',
                    'Spec.block_copy_unit',
                    'Spec.block_copy_uprice',
                    'Spec.plate_making_title',
                    'Spec.plate_making_num',
                    'Spec.plate_making_unit',
                    'Spec.plate_making_uprice',
                    'Spec.shiiping_title',
                    'Spec.shiiping_num',
                    'Spec.shiiping_unit',
                    'Spec.shiiping_uprice',
                );
                $conditions = array('Spec.id' => $id, 'Spec.del_flag' => FALSE);
                $data_find = $this -> Spec -> find('all', array('conditions' => $conditions, 'fields' => $fields, 'order' => array('Spec.customer_id', 'Spec.goods_id', 'Spec.order_num DESC'), 'recursive' => 0));
                if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                    $res['status'] = STS_EMPTY;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $data_find;
                }
            } catch(Exception $e) {
                echo 'Exception: ', $e -> getMessage(), "\n";
                $this -> log('Exception: ' . $e -> getMessage(), LOG_ERR);
            }

        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * get_nodelivery_data method
     *
     * WS090200
     * @return json
     * @author GiangNT
     */
    public function get_nodelivery_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['customerID'], $data['goodscode'])) {
            try {
                $list_id = $this -> MProcess -> find('list', array('conditions' => array('MProcess.code >' => PROCESS_10, 'MProcess.code <' => PROCESS_30), 'fields' => array('MProcess.id'), 'recursive' => -1)); ;
                $conditions = array('Spec.m_process_id' => $list_id, 'Goods.code' => $data['goodscode'], 'Spec.customer_id' => $data['customerID'], 'Spec.del_flag' => FALSE);
                $fields = array(
                    'Spec.id', 
                    'Spec.order_num', 
                    'Goods.id', 
                    'Goods.name', 
                    'Goods.code', 
                    'Spec.num', 
                    'Spec.unit', 
                    'Spec.unit_price', 
                    'Spec.price', 
                    'Spec.delivery_memo', 
                    'Spec.customer_goods_code', 
                    'Spec.lot', 
                    'Spec.po_delivery_note_flag',
                    'Spec.block_copy_title',
                    'Spec.block_copy_num',
                    'Spec.block_copy_unit',
                    'Spec.block_copy_uprice',
                    'Spec.plate_making_title',
                    'Spec.plate_making_num',
                    'Spec.plate_making_unit',
                    'Spec.plate_making_uprice',
                    'Spec.shiiping_title',
                    'Spec.shiiping_num',
                    'Spec.shiiping_unit',
                    'Spec.shiiping_uprice',
                );
                $data_find = $this -> Spec -> find('all', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => 0, 'order' => array('Spec.delivery_date DESC')));
                if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                    $res['status'] = STS_EMPTY;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $data_find;
                }
            } catch(Exception $e) {
                echo 'Exception: ', $e -> getMessage(), "\n";
                $this -> log('Exception: ' . $e -> getMessage(), LOG_ERR);
            }

        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * check_order_num method
     *
     * WS090200
     * @param token,user_id,customer_id,goods_code,order_num
     * @return json
     * @author GiangNT
     */

    public function check_order_num() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['customer_id'], $data['goods_code'], $data['order_num'])) {
            try {
                $list_id = $this -> MProcess -> find('list', array('conditions' => array('MProcess.code >' => PROCESS_10, 'MProcess.code <' => PROCESS_30), 'fields' => array('MProcess.id'), 'recursive' => -1)); ;
                $conditions = array('Spec.m_process_id' => $list_id, 'Goods.code' => $data['goods_code'], 'Spec.customer_id' => $data['customer_id'], 'Spec.order_num' => $data['order_num'], 'Spec.del_flag' => FALSE);
                $fields = array(
                    'Spec.id', 
                    'Spec.order_num', 
                    'Goods.id', 
                    'Goods.name', 
                    'Goods.code', 
                    'Spec.num', 
                    'Spec.unit', 
                    'Spec.unit_price', 
                    'Spec.price', 
                    'Spec.delivery_memo', 
                    'Spec.customer_goods_code', 
                    'Spec.lot', 
                    'Spec.po_delivery_note_flag',
                    'Spec.block_copy_title',
                    'Spec.block_copy_num',
                    'Spec.block_copy_unit',
                    'Spec.block_copy_uprice',
                    'Spec.plate_making_title',
                    'Spec.plate_making_num',
                    'Spec.plate_making_unit',
                    'Spec.plate_making_uprice',
                    'Spec.shiiping_title',
                    'Spec.shiiping_num',
                    'Spec.shiiping_unit',
                    'Spec.shiiping_uprice',
                );
                $data_find = $this -> Spec -> find('all', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => 1, 'order' => array('Spec.delivery_date')));
                if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                    $res['status'] = STS_EMPTY;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $data_find;
                }
            } catch(Exception $e) {
                echo 'Exception: ', $e -> getMessage(), "\n";
                $this -> log('Exception: ' . $e -> getMessage(), LOG_ERR);
            }

        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * delete method
     * @tutorial WS040100
     * @throws NotFoundException
     * @param string $model, $ids
     * @return void
     * @author Tu Vu
     */
    public function del() {

        $this -> viewClass = 'Json';
        $res = array();
        $dataSource = $this -> Spec -> getDataSource();
        $dataSource -> begin();

        try {
            if ($this -> request -> is('post')) {
                $data = $this -> request -> data;
                if (isset($data['id'], $data['user_id'], $data['token'])) {
                    $listId = explode(GLUE_DATA, $data['id']);
                    $tmp = "";
                    $i = 0;
                    foreach ($listId as $key => $val) {
                        if ($this -> Spec -> updateAll(array('Spec.del_flag' => true), array('Spec.id' => array($val)))) {
                            $dataSource -> commit();
                            if (empty($tmp)) {
                                $tmp .= $val;
                            } else {
                                $tmp .= ',' . $val;
                            }
                            $i++;
                        }
                    }
                    if ($i = count($listId)) {
                        $res['status'] = STS_SUCCESS;
                    } else {
                        $res['status'] = STS_DB_UPDATE_ERROR;
                    }
                    $res['data_res'] = $tmp;
                } else {
                    $res['status'] = STS_ERROR_MISSINGDATA;
                }
            } else {
                $res['status'] = 'NotPost';
            }
        } catch (Exception $e) {
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
            $dataSource -> rollback();
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * getDataAfterUpdate Spec method
     *@tutorial WS030201
     * @throws NotFoundException
     * @param  $id
     * @return array
     * @author GiangNT
     */

    protected function getData($id = null) {
        if (!$this -> Spec -> exists($id)) {
            return STS_EMPTY;
        } else {
            
            $this -> Spec -> unbindModel(array('hasMany' => array('PaperInventory')));
            
            $this -> Customer -> unbindModel(array('hasMany' => array('ConsignorMap', 'ConsignorList', 'CustomerDept', 'Delivery', 'DeliveryNote', 'Estimate', 'Goods', 'Spec', 'UserCustomerMap')));
            $this -> Customer -> unbindModel(array('belongsTo' => array('User')));

            $this -> InventoryType -> unbindModel(array('hasMany' => array('Spec')));
            $this -> Fold -> unbindModel(array('hasMany' => array('Spec')));
            $this -> MPaperSize -> unbindModel(array('hasMany' => array('MPaper', 'MPrintPrice')));
            $this -> SpecOutsource -> unbindModel(array('belongsTo' => array('Spec')));
            $this -> Goods -> unbindModel(array('belongsTo' => array('Customer')));
            $this -> SpecDetail -> unbindModel(array('belongsTo' => array('Spec')));
            $this -> PaperInventory -> unbindModel(array('belongsTo' => array('Spec', 'User')));
            $data_find[0] = $this -> Spec -> find('first', array('conditions' => array('Spec.id' => $id), 'recursive' => 2));
            if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                return STS_EMPTY;
            } else {
                return $data_find;
            }
        }

    }

    /**
     * print_estimate method
     *@tutorial WS080100
     * @throws NotFoundException
     * @param  $id
     * @return array
     * @author GiangNT
     */

    public function print_estimate() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['spec_id'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        if($this ->Spec->updateAll(array('Spec.estimate_flag' => TRUE), array('Spec.id' => $data['spec_id']))){
            $res['status'] = STS_SUCCESS;
        }else{
            $res['status'] = STS_DB_UPDATE_ERROR;
        }

        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

	/**
	 * update_process method
	 *
	 * @throws NotFoundException
	 * @param token,user_id,spec_id,process_code
	 * @return void
	 * @auth  GiangNT
	 */
	 
	 public function update_process() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['spec_id'], $data['process_code'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
		
		$list_spec_id = explode(GLUE_DATA, $data['spec_id']);
		$list_process_code = explode(GLUE_DATA, $data['process_code']);
		if(count($list_spec_id) != count($list_process_code)){
			$res['error'] = 'Not sync id vs code';
			$this->log($res['error'], LOG_ERROR);
			goto set;
		}
		
		//displayField
		$this->MProcess->displayField = 'code';
		$list_process_id = $this->MProcess->find('list', array('fields' => array('code', 'id')));
		
		foreach ($list_spec_id as $key => $id) {
			if(isset($list_process_id[$list_process_code[$key]])){
				$Spec_data[$key]['Spec']['id'] = $id;
				$Spec_data[$key]['Spec']['m_process_id'] = $list_process_id[$list_process_code[$key]];
			}else{
				$res['error'] = 'Not exist !';
				$res['status'] = STS_DB_UPDATE_ERROR;
				goto set;
			}
		}
		if(empty($Spec_data)){
			$res['status'] = STS_EMPTY_DATA_REQUEST;
			goto set;
		}
		$data_Spec = $this->Spec->getDataSource();
		$data_Spec->begin();
		if(!$this->Spec->saveMany($Spec_data)){
			$data_Spec->rollback();
			$res['status'] = STS_DB_UPDATE_ERROR;
			goto set;
		}
		$data_Spec->commit();
		$res['status'] = STS_SUCCESS;

        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
	 }

    /**
     * update_all_process method
     * @tutorial WS050200
     * @throws NotFoundException
     * @param  token,user_id,process_id,spec_code
     * @return array
     * @author GiangNT
     */

    public function update_all_process() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['process_id'], $data['spec_code'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        
       $a_spec_code = explode(GLUE_DATA, $data['spec_code']);
       foreach ($a_spec_code as $index => $spec_code) {
           $customer_code = substr($spec_code, 0, 4);
           $goods_code = substr($spec_code, 4, 5);
           $order_num = (int)substr($spec_code, -4, 4);
           
           $spec_id = $this->Spec->find('first', array(
                'fields' => array('Spec.id'), 
                'conditions' => array(
                    'Spec.order_num' => $order_num,
                    'Customer.code' => $customer_code,
                    'Goods.code' => $goods_code,
                    'Spec.del_flag' => FALSE
                ),
                'order' => array('Spec.id'),
                'recursive' => 0,
            ));
           
           if(!empty($spec_id)){
               $Spec_data[$index]['Spec']['id'] = $spec_id['Spec']['id'];
               $Spec_data[$index]['Spec']['m_process_id'] = $data['process_id'];
           }elseif(!isset($res['error_spec_code'])){
               $res['error_spec_code'] =  $a_spec_code[$index];
           }else{
               $res['error_spec_code'] =  $res['error_spec_code'] . GLUE_DATA . $a_spec_code[$index];
           }
       }
       if(empty($Spec_data)){
            $res['status'] = STS_EMPTY_DATA_REQUEST;
            goto set;
        }
       
       $data_Spec = $this->Spec->getDataSource();
       $data_Spec->begin();
       
       if(!$this->Spec->saveMany($Spec_data)){
            $data_Spec->rollback();
            $res['status'] = STS_DB_UPDATE_ERROR;
            goto set;
        }
       
        $data_Spec->commit();
        $res['status'] = STS_SUCCESS;
        
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

	/**
	 * search method
	 *
	 * @throws NotFoundException
	 * @param token,user_id,customer_code,customer_name,S_user_id,delivery_date_from,delivery_date_to,
	 * goods_name,process_code_from,process_code_to,sheet_num,paper_size_id,part_name,outsource_id
	 * @return void
	 * @auth  GiangNT
	 */
	 
	 public function search() {
		$this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['customer_code'], $data['customer_name'], $data['S_user_id'], $data['delivery_date_from'], $data['delivery_date_to'], $data['goods_name'], $data['process_code_from'], $data['process_code_to'], $data['sheet_num'], $data['paper_size_id'], $data['part_name'], $data['outsource_id'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
		
		//get mprocess_id
		$conditions_m = array(
			'MProcess.code >=' => empty($data['process_code_from']) ? 0 : $data['process_code_from'],
			empty($data['process_code_to']) ? 'MProcess.code <' : 'MProcess.code <=' => empty($data['process_code_to']) ? PROCESS_30 : $data['process_code_to'],
		);
		
		$fields = array('id');
		$mp_ids = $this->MProcess->find('list', array(
			'conditions' => $conditions_m,
			'fields' => $fields,
		));
		
		// get data Spec
		$this -> Spec -> Behaviors->load('Containable');
		$conditions_spec = array(
			'Spec.del_flag' => FALSE,
			'ltrim(UPPER(Customer.code)) LIKE' => $this->Common->queryUpper($data['customer_code']) . "%",
			'ltrim(UPPER(Customer.name)) LIKE' => "%" . $this->Common->queryUpper($data['customer_name']) . "%", 
			'ltrim(UPPER(Goods.name)) LIKE' => $this->Common->queryUpper($data['goods_name']) . "%", 
			$data['delivery_date_from'] != '0001-01-01' ? 'date(coalesce(Spec.delivery_date, \'0001-01-01\')) >=' : 'date(Spec.delivery_date) >=' => empty($data['delivery_date_from']) ? '0001-01-01' : $data['delivery_date_from'],
			'date(coalesce(Spec.delivery_date, \'0001-01-01\')) <=' => empty($data['delivery_date_to']) ? '9999-12-31' : $data['delivery_date_to'],
			'Spec.m_process_id' => $mp_ids,
			//'ltrim(UPPER(SpecDetail.part_name)) LIKE' => $this->Common->queryUpper($data['part_name']) . "%",
			//'SpecOutsource.outsource_id' => $data['outsource_id'],
		);
		if(!empty($data['S_user_id'])){
			$conditions_spec['Spec.user_id'] = $data['S_user_id'];
		}
		if(!empty($data['sheet_num'])){
			$conditions_spec['Spec.sheet_num'] = $data['sheet_num'];
		}
		if(!empty($data['paper_size_id'])){
			$conditions_spec['Spec.m_paper_size_id'] = $data['paper_size_id'];
		}
			//get list of spec_id follow part_name and outsource_id
		$list_sp_id = $this->getListSpecID($data['part_name'], $data['outsource_id']);
		if($list_sp_id != 'default'){
		    if(empty($list_sp_id)){
		        $res['status'] = STS_EMPTY;
                goto set;
		    }
			$conditions_spec['Spec.id'] = $list_sp_id;
		}
		$data_finds = $this->Spec->find('all', array(
			'conditions' => $conditions_spec,
			'fields' => array('id', 'sheet_num', 'm_paper_size_id', 'order_num', 'delivery_date', 'num', 'unit_price', 'price'),
			'recursive' => -1,
			'contain' => array(
				'Customer' => array('id', 'code', 'name'),
				'MProcess' => array('id', 'code'),
				'User' => array('name'),
				'Goods' => array('id', 'code', 'name'),
				'SpecOutsource' => array(
					'fields' => array('outsource_id'),
					'Outsource' => array('id', 'name'),
				),
			),
			// 'limmit' => 1,
			
		));
		
		if ($this -> Check -> is_multiArrayEmpty($data_finds)) {
            $res['status'] = STS_EMPTY;
        } else {
            $res['status'] = STS_SUCCESS;
            $res['data_res'] = $data_finds;
        }
		
		set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
	 }
	
	/**
	 * getListSpecID method
	 *
	 * @param $part_name, $outsource_id
	 * @return list spec_id
	 * @auth  GiangNT
	 */
	
	private function getListSpecID($part_name = '', $outsource_id = '') {
		if(!empty($part_name)){
			$List_SP_ID_D = $this->SpecDetail->find('list', array(
				'conditions' => array(
					'ltrim(UPPER(SpecDetail.part_name)) LIKE' => $this->Common->queryUpper($part_name) . "%",
				),
				'fields' => array('SpecDetail.spec_id'),
				'order' => array('SpecDetail.spec_id'),
				'recursive' => -1,
			));
		}
		if(!empty($outsource_id)){
			$List_SP_ID_O = $this->SpecOutsource->find('list', array(
				'conditions' => array(
					'SpecOutsource.outsource_id' => $outsource_id,
				),
				'fields' => array('SpecOutsource.spec_id'),
				'order' => array('SpecOutsource.spec_id'),
				'recursive' => -1,
			));
		}
		
		if(isset($List_SP_ID_D, $List_SP_ID_O)){
			return array_unique(array_intersect($List_SP_ID_D, $List_SP_ID_O));
		}elseif(isset($List_SP_ID_D)){
			return array_unique($List_SP_ID_D);
		}elseif(isset($List_SP_ID_O)){
			return array_unique($List_SP_ID_O);
		}
		
		return 'default';
	}
	
	/**
	 * list_data_bml method
	 *
	 * @throws NotFoundException
	 * @param token,user_id,p_code_start,p_code_finish,date_start,date_finish
	 * @return void
	 * @auth GiangNT
	 */
	 
	 public function list_data_bml() {
	 	$this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['p_code_start'], $data['p_code_finish'], $data['date_start'], $data['date_finish'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
		
		//get mprocess_id
		$conditions_m = array(
			'MProcess.code >=' => empty($data['p_code_start']) ? 0 : $data['p_code_start'],
			empty($data['p_code_finish']) ? 'MProcess.code <' : 'MProcess.code <=' => empty($data['p_code_finish']) ? PROCESS_30 : $data['p_code_finish'],
		);
		
		$fields = array('id');
		
		$mp_ids = $this->MProcess->find('list', array(
			'conditions' => $conditions_m,
			'fields' => $fields,
		));
		
		//get data Spec
		
		$conditions_sp = array(
			'Spec.del_flag' => FALSE,
			'Customer.deliver_flag' => TRUE,
			$data['date_start'] != '0001-01-01' ? 'coalesce(Spec.delivery_date, \'0001-01-01\') >=' : 'Spec.delivery_date >=' => empty($data['date_start']) ? '0001-01-01' : $data['date_start'], 
        	'coalesce(Spec.delivery_date, \'0001-01-01\') <=' => empty($data['date_finish']) ? '9999-12-31' : $data['date_finish'], 
		);
		
		if(!empty($mp_ids)){
			$conditions_sp['Spec.m_process_id'] = $mp_ids;
		}
		
		$this -> Spec -> Behaviors->load('Containable');
		$data_finds = $this->Spec->find('all', array(
			'conditions' => $conditions_sp,
			'fields' => array('id', 'order_num', 'delivery_date', 'num', 'unit', 'block_copy_total', 'plate_makeing_total', 'shipping_total', 
				'packing_total', 'customer_goods_code', 'special_mention_a', 'special_mention_b', 'estimate_flag', 'purchase_flag', 'delivery_flag', 
				'm_reprint_id', 'unit_price', 'packaging', 'delivery_memo', 'price', 'bml_delivery_date'
			),
			'recursive' => -1,
			'order' => array('Spec.delivery_date'),
			'contain' => array(
				'Customer' => array('code', 'name', 'deliver_flag'),
				'Goods' => array('code', 'name'),
				'MProcess' => array('code'),
				'User' => array('name'),
				'MReprint' => array('code'),
			),
		));
		
		$this->loadModel('CustomerDept');
		$this->loadModel('DeliveryNoteDetail');
		// $this->loadModel('DeliveryNote');
		$this -> DeliveryNoteDetail -> unbindModel(array('belongsTo' => array('Spec', 'Goods')));
		foreach ($data_finds as $index => &$data_find) {
			//get CustomerDept code
             $dept = $this->CustomerDept->find('first', array(
                'conditions' => array(
                     'CustomerDept.customer_id' => $data_find['Customer']['id'],
                     '0' => '\'' . $data_find['Goods']['code'] . '\'' . ' ~ replace(CustomerDept.product_code_mask, \'X\', \'.\')'
                ),
                'fields' => array(
                    'CustomerDept.code', 
                    'CustomerDept.name', 
                    'product_code_mask',
                ),
                'order' => array('CustomerDept.product_code_mask'),
                'recursive' => -1,
            ));
            if(isset($dept['CustomerDept'])){
               $data_find['CustomerDept'] = $dept['CustomerDept'];
            }
        }

		if ($this -> Check -> is_multiArrayEmpty($data_finds)) {
            $res['status'] = STS_EMPTY;
        } else {
            $res['status'] = STS_SUCCESS;
            $res['data_res'] = $data_finds;
        }
		set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
	 }
}
