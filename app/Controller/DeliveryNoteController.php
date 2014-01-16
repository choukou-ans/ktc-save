<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class DeliveryNoteController extends AppController {

    public $name = 'DeliveryNote';
    public $uses = array('Token', 'Spec', 'MProcess', 'DeliveryNote', 'DeliveryNoteDetail', 'MTax');
    public $components = array('FormatRespon', 'Check', 'Format');

    /**
     * list_data method
     * WS090100,
     * @throws Exception
     * @param user_id,token,flag,CustomerCode,CustomerName,GoodsCode,DeliveryFrom,DeliveryTo
     * @return json
     * @author GiangNT
     */

    public function list_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        $this -> log($data, LOG_DEBUG);
        if (isset($data['user_id'], $data['token'], $data['flag'], $data['CustomerCode'], $data['CustomerName'], $data['GoodsCode'], $data['DeliveryFrom'], $data['DeliveryTo'])) {
            if ($data['flag'] == TRUE) {
                try {
                    $list_id = $this -> MProcess -> find('list', array('conditions' => array('MProcess.code >' => PROCESS_10, 'MProcess.code <' => PROCESS_30), 'fields' => array('MProcess.id'), 'recursive' => -1));
                    $query_customer_code = strtolower(ltrim($data['CustomerCode']));
                    $query_customer_name = strtolower(ltrim($data['CustomerName']));
                    $query_goods_code = strtolower(ltrim($data['GoodsCode']));
                    $conditions = array(
                    	'Spec.del_flag' => FALSE, 
                    	'Spec.m_process_id' => $list_id, 
                    	'ltrim(LOWER(Customer.code)) LIKE' => $query_customer_code . "%", 
                    	'ltrim(LOWER(Customer.name)) LIKE' => "%" . $query_customer_name . "%", 
                    	'ltrim(LOWER(Goods.code)) LIKE' => $query_goods_code . "%", 
                    	$data['DeliveryFrom'] != '0001-01-01' ? 'coalesce(Spec.delivery_date, \'0001-01-01\') >=' : 'Spec.delivery_date >=' => empty($data['DeliveryFrom']) ? '0001-01-01' : $data['DeliveryFrom'], 
                    	'coalesce(Spec.delivery_date, \'0001-01-01\') <=' => empty($data['DeliveryTo']) ? '9999-12-31' : $data['DeliveryTo'], 
					);
                    
                    $fields = array(
                        'Spec.id', 
                        'Customer.code', 
                        'Goods.code', 
                        'Customer.name', 
                        'Goods.name', 
                        'Spec.delivery_date', 
                        'Spec.m_process_id', 
                        'Spec.order_num', 
                        'Spec.po_delivery_note_flag',
                        'Spec.block_copy_uprice',
                        'Spec.plate_making_uprice',
                        'Spec.shiiping_uprice',
                    );
                    
                    $order = array('Customer.code', 'Goods.code', 'Spec.delivery_date');
                    $data_find = $this -> Spec -> find('all', array('order' => $order, 'conditions' => $conditions, 'fields' => $fields, 'recursive' => 0));
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $data_find;
                } catch(Exception $e) {
                    echo 'Exception: ', $e -> getMessage(), "\n";
                    $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
                }
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * get_next_order_num method
     * WS090200,
     * @throws Exception
     * @param token,user_id,customer_id
     * @return json
     * @author GiangNT
     */

    public function get_next_order_num() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['customer_id'])) {
            try {
                $conditions = array('DeliveryNote.customer_id' => $data['customer_id']);
                $fields = array('MAX(DeliveryNote.slip_num) as max_slip_num');
                $data_find = $this -> DeliveryNote -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
                if ($this -> Check -> is_multiArrayEmpty($data_find)) {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = 1;
                } else {
                    $res['status'] = STS_SUCCESS;
                    $res['data_res'] = $data_find[0]['max_slip_num'] + 1;
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

    /**
     * add method
     * WS090200,
     * @throws Exception
     * @param token,flag,delivery_note_details_title,delivery_note_details_data,delivery_notes_title,delivery_notes_data
     * @return json
     * @author GiangNT
     */

    public function add() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['flag'], $data['delivery_note_details_title'], $data['delivery_note_details_data'], $data['delivery_notes_title'], $data['delivery_notes_data'])) {
            try {
                $data_save_delivery_notes = $this -> Format -> formatSaveData('DeliveryNote', $data['delivery_notes_title'], $data['delivery_notes_data']);
                $tax_rate = $this -> MTax -> find('first', array('recursive' => -1, 'conditions' => array('MTax.start_date <=' => $data_save_delivery_notes[0]['DeliveryNote']['delivery_date']), 'order' => array('MTax.start_date DESC'), 'limit' => 1));
                if (empty($tax_rate['MTax']['tax_rate'])) {
                    $data_save_delivery_notes[0]['DeliveryNote']['tax_rate'] = 0;
                } else {
                    $data_save_delivery_notes[0]['DeliveryNote']['tax_rate'] = $tax_rate['MTax']['tax_rate'];
                }
                $data_save_delivery_notes_details = $this -> Format -> formatSaveData('DeliveryNoteDetail', $data['delivery_note_details_title'], $data['delivery_note_details_data']);

                if (empty($data_save_delivery_notes) || empty($data_save_delivery_notes_details)) {
                    goto set;
                }
                $dataSource_DeliveryNote = $this -> DeliveryNote -> getDataSource();
                $dataSource_DeliveryNoteDetail = $this -> DeliveryNoteDetail -> getDataSource();
                $dataSource_DeliveryNote -> begin();
                $dataSource_DeliveryNoteDetail -> begin();
                if ($this -> DeliveryNote -> saveAll($data_save_delivery_notes)) {
                    $id_delivery_note = $this -> DeliveryNote -> id;
                    foreach ($data_save_delivery_notes_details as $key_delivery_notes_detail => &$value_delivery_notes_detail) {
                        $value_delivery_notes_detail['DeliveryNoteDetail']['delivery_note_id'] = $id_delivery_note;
                    }
                    if ($this -> DeliveryNoteDetail -> saveAll($data_save_delivery_notes_details)) {

                        //slip_num
                        $conditions_slip_num = array('DeliveryNote.customer_id' => $data_save_delivery_notes[0]['DeliveryNote']['customer_id']);
                        $fields_slip_num = array('MAX(DeliveryNote.slip_num) as max_slip_num');
                        $data_slip_num = $this -> DeliveryNote -> find('first', array('conditions' => $conditions_slip_num, 'fields' => $fields_slip_num, 'recursive' => -1));
                        if (empty($data_slip_num)) {
                            $slip_num = 1;
                        } else {
                            $slip_num = $data_slip_num[0]['max_slip_num'] + 1;
                        }

                        //flag
                        switch ((int)$data['flag']) {
                            case 1 :
                                $m_porccess_id = $this -> MProcess -> find('list', array('fields' => array('MProcess.id'), 'conditions' => array('MProcess.code' => PROCESS_30)));
                                if (!empty($m_porccess_id)) {
                                    if ($this -> Spec -> updateAll(array('Spec.po_delivery_note_flag' => TRUE), array('Spec.m_process_id' => $m_porccess_id))) {
                                        $dataSource_DeliveryNoteDetail -> commit();
                                        $dataSource_DeliveryNote -> commit();
                                        $res['status'] = STS_SUCCESS;
                                        $res['data_res'] = $slip_num;

                                    } else {
                                        $dataSource_DeliveryNoteDetail -> rollback();
                                        $dataSource_DeliveryNote -> rollback();
                                        $res['status'] = STS_DB_UPDATE_ERROR;
                                    }
                                } else {
                                    $dataSource_DeliveryNoteDetail -> commit();
                                    $dataSource_DeliveryNote -> commit();
                                }
                                break;
                            case 0 :
                                $spec_id = array_map(function($val) {
                                    return $val['DeliveryNoteDetail']['spec_id'];
                                }, $data_save_delivery_notes_details);
                                if ($this -> Spec -> updateAll(array('Spec.po_delivery_note_flag' => TRUE), array('Spec.id' => $spec_id))) {
                                    $dataSource_DeliveryNoteDetail -> commit();
                                    $dataSource_DeliveryNote -> commit();
                                    $res['status'] = STS_SUCCESS;
                                    $res['data_res'] = $slip_num;
                                } else {
                                    $dataSource_DeliveryNoteDetail -> rollback();
                                    $dataSource_DeliveryNote -> rollback();
                                    $res['status'] = STS_DB_UPDATE_ERROR;
                                }
                                break;
                            default :
                                throw new Exception("Flag not 1 or 0", 1);
                                break;
                        }

                    } else {
                        $dataSource_DeliveryNote -> rollback();
                        $res['status'] = STS_DB_UPDATE_ERROR;
                    }
                } else {
                    $res['status'] = STS_DB_UPDATE_ERROR;
                }
            } catch(Exception $e) {
                echo 'Exception: ', $e -> getMessage(), "\n";
                $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
                exit ;
            }
        } else {
            set:
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    public function getTaxRate() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['start_date'])) {
            try {
                $data_find = $this -> MTax -> find('first', array('recursive' => -1, 'conditions' => array('MTax.start_date <=' => $data['start_date']), 'order' => array('MTax.start_date DESC'), 'limit' => 1));
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

    /**
     * list_menoy_by_delivery_date method
     * WS180101,
     * @throws Exception
     * @param token,user_id,extract_date
     * @return json
     * @author GiangNT
     */
     
    public function list_menoy_by_delivery_date() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['extract_date'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        try {
           $conditions = array(
                'DeliveryNote.del_flag' => FALSE,
                'DeliveryNote.delivery_date >=' => $data['extract_date'],
                'Customer.deliver_flag'=> TRUE,
                'Customer.del_flag'=> FALSE,
           );
           
           $data_find = $this->DeliveryNote->find('all', array(
                'conditions' => $conditions,
                'fields' => array(
                    'Spec.bml_delivery_date',
                    'Customer.code',
                    'Goods.code',
                    'Customer.name',
                    'Goods.name',
                    'Spec.special_mention_b',
                    'Spec.plate_makeing_total',
                    'Spec.shipping_total',
                    'Spec.block_copy_total',
                    'Spec.delivery_num',
                    'DeliveryNoteDetail.num',
                    'DeliveryNoteDetail.unit_price',
                    'DeliveryNoteDetail.price',
                ),
                'order' => array(
                    'DeliveryNote.delivery_date', 
                    'Customer.code', 
                    'Goods.code',
                ),
                'recursive' => -1,
                // 'limit' => 3,
                'joins' => array(
                    array(
                        'table' => 'customers',
                        'alias' => 'Customer',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNote.customer_id = Customer.id'
                        )
                    ),
                    array(
                        'table' => 'delivery_note_details',
                        'alias' => 'DeliveryNoteDetail',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNote.id = DeliveryNoteDetail.delivery_note_id'
                        )
                    ),
                    array(
                        'table' => 'specs',
                        'alias' => 'Spec',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNoteDetail.spec_id = Spec.id'
                        )
                    ),
                    array(
                        'table' => 'goods',
                        'alias' => 'Goods',
                        'type' => 'inner',
                        'conditions' => array(
                            'Spec.goods_id = Goods.id'
                        )
                    ),
                   
                ),
              
           ));
           
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
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * list_menony_summary method
     * WS180104,
     * @throws Exception
     * @param token,user_id,extract_date_from,extract_date_to
     * @return json
     * @author GiangNT
     */
     
    public function list_menony_summary() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['extract_date_from'], $data['extract_date_to'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        try {
           $conditions = array(
                'DeliveryNote.del_flag' => FALSE,
                'date(DeliveryNote.delivery_date) >=' => $data['extract_date_from'],
                'date(DeliveryNote.delivery_date) <=' => $data['extract_date_to'],
                'Customer.deliver_flag'=> TRUE,
                'Customer.del_flag'=> FALSE,
           );
           
           $data_find = $this->DeliveryNote->find('all', array(
                'conditions' => $conditions,
                'fields' => array(
                    'Spec.bml_delivery_date',
                    'Customer.code',
                    'Goods.code',
                    'Goods.name',
                    'Spec.unit_price',
                    'DeliveryNoteDetail.num',
                    'Spec.price',
                    'Spec.block_copy_total',
                    'Spec.plate_makeing_total',
                    'Spec.shipping_total',
                ),
                'order' => array(
                    'DeliveryNote.delivery_date', 
                    'Customer.code', 
                    'Goods.code',
                ),
                'recursive' => -1,
                // 'limit' => 3,
                'joins' => array(
                    array(
                        'table' => 'customers',
                        'alias' => 'Customer',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNote.customer_id = Customer.id'
                        )
                    ),
                    array(
                        'table' => 'delivery_note_details',
                        'alias' => 'DeliveryNoteDetail',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNote.id = DeliveryNoteDetail.delivery_note_id'
                        )
                    ),
                    array(
                        'table' => 'specs',
                        'alias' => 'Spec',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNoteDetail.spec_id = Spec.id'
                        )
                    ),
                    array(
                        'table' => 'goods',
                        'alias' => 'Goods',
                        'type' => 'inner',
                        'conditions' => array(
                            'Spec.goods_id = Goods.id'
                        )
                    ),
                   
                ),
              
           ));
           
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
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * list_by_delivery_date method
     * WS180102,
     * @throws Exception
     * @param token,user_id,extract_date
     * @return json
     * @author GiangNT
     */

    public function list_by_delivery_date() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['extract_date'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        try {
           $conditions = array(
                'DeliveryNote.del_flag' => FALSE,
                'DeliveryNote.delivery_date >=' => $data['extract_date'],
                'Customer.deliver_flag'=> TRUE,
                'Customer.del_flag'=> FALSE,
           );
           
           $data_find = $this->DeliveryNote->find('all', array(
                'conditions' => $conditions,
                'fields' => array(
                    'Spec.bml_delivery_date',
                    'Customer.code',
                    'Goods.code',
                    'Customer.name',
                    'Goods.name',
                    'Spec.special_mention_b',
                    'Spec.customer_goods_code',
                    'Spec.delivery_num',
                    'DeliveryNoteDetail.num',
                ),
                'order' => array(
                    'DeliveryNote.delivery_date', 
                    'Customer.code', 
                    'Goods.code',
                ),
                'recursive' => -1,
                // 'limit' => 3,
                'joins' => array(
                    array(
                        'table' => 'customers',
                        'alias' => 'Customer',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNote.customer_id = Customer.id'
                        )
                    ),
                    array(
                        'table' => 'delivery_note_details',
                        'alias' => 'DeliveryNoteDetail',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNote.id = DeliveryNoteDetail.delivery_note_id'
                        )
                    ),
                    array(
                        'table' => 'specs',
                        'alias' => 'Spec',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNoteDetail.spec_id = Spec.id'
                        )
                    ),
                    array(
                        'table' => 'goods',
                        'alias' => 'Goods',
                        'type' => 'inner',
                        'conditions' => array(
                            'Spec.goods_id = Goods.id'
                        )
                    ),
                   
                ),
              
           ));
           
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
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * list_delivery_fax method
     * WS180103,
     * @throws Exception
     * @param token,user_id,extract_date
     * @return json
     * @author GiangNT
     */

    public function list_delivery_fax() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['extract_date'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        try {
           $conditions = array(
                'DeliveryNote.del_flag' => FALSE,
                'DeliveryNote.delivery_date >=' => $data['extract_date'],
                'Customer.deliver_flag'=> TRUE,
                'Customer.del_flag'=> FALSE,
           );
           
           $data_find = $this->DeliveryNote->find('all', array(
                'conditions' => $conditions,
                'fields' => array(
                    'Goods.name',
                    'DeliveryNoteDetail.num',
                    'DeliveryNoteDetail.unit',
                    'Spec.delivery_num',
                    'Spec.special_mention_b',
                    'Spec.bml_delivery_date',
                ),
                'order' => array(
                    'DeliveryNote.delivery_date', 
                    'Customer.code', 
                    'Goods.code',
                ),
                'recursive' => -1,
                // 'limit' => 3,
                'joins' => array(
                    array(
                        'table' => 'customers',
                        'alias' => 'Customer',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNote.customer_id = Customer.id'
                        )
                    ),
                    array(
                        'table' => 'delivery_note_details',
                        'alias' => 'DeliveryNoteDetail',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNote.id = DeliveryNoteDetail.delivery_note_id'
                        )
                    ),
                    array(
                        'table' => 'specs',
                        'alias' => 'Spec',
                        'type' => 'inner',
                        'conditions' => array(
                            'DeliveryNoteDetail.spec_id = Spec.id'
                        )
                    ),
                    array(
                        'table' => 'goods',
                        'alias' => 'Goods',
                        'type' => 'inner',
                        'conditions' => array(
                            'Spec.goods_id = Goods.id'
                        )
                    ),
                   
                ),
              
           ));
           
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
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

}
