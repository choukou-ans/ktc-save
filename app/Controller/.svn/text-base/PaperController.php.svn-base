<?php
App::uses('AppController', 'Controller');

class PaperController extends AppController {

    public $name = 'Paper';

    public $uses = array('User', 'MPaper', 'MPaperSize', 'PaperInventory');

    public $components = array('Format', 'Check', 'FormatRespon', 'Common');

    /**
     * Get inventory method
     * @tutorial WS030201
     *
     * @throws NotFoundException
     * @param  Token, user_id, m_paper_id
     * @return array
     * @author Tu Vu
     */

    public function get_inventory() {
        $this -> viewClass = 'Json';
        $res = array();
        $options = array();
        $data = $this -> request -> data;
        $mpaperID = array();

        if (isset($data['token'], $data['user_id'], $data['m_paper_id'])) {
            if (!empty($data['m_paper_id'])) {
                $result = array();
                $list_mpaper = explode(GLUE_DATA, $data['m_paper_id']);
                foreach ($list_mpaper as $key => $val) {
                    if (empty($val)) {
                        $result[$key]['MPaper']['id'] = null;
                        $result[$key]['MPaper']['code'] = null;
                        $result[$key]['MPaper']['unit_price'] = null;
                        $result[$key]['MPaper']['cur_num'] = null;
                        $result[$key]['MPaper']['threshold'] = null;
                    } else {
                        $options['fields'] = array('MPaper.id', 'MPaper.code', 'MPaper.unit_price', 'MPaper.cur_num', 'MPaper.threshold');
                        $options['recursive'] = -1;
                        $options['conditions'] = array('del_flag' => false, 'id' => $val);
                        $options['order'] = array('code ASC');
                        $dataFind = $this -> MPaper -> find('first', $options);
                        $result[$key] = $dataFind;
                    }
                }
                $res['status'] = STS_SUCCESS;
                $res['data_res'] = $result;
            } else {
                $res['status'] = STS_SUCCESS;
                $res['data_res'] = null;
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    private function formatMPaperID($data = array()) {
        $formatMPaperID = array();
        if (strpos($data, GLUE_DATA) !== false) {
            $data = explode(GLUE_DATA, $data);
        } else {
            $data = array($data);
        }
        foreach ($data as $key => $val) {
            if (!empty($val)) {
                $formatMPaperID[$key] = $val;
            }
        }
        return $formatMPaperID;
    }

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
                    $data_find[0] = $this -> $data['model'] -> find('first', array('conditions' => $conditions, 'fields' => $fields, 'recursive' => -1));
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
     * list_inventory method
     * WS060100
     * @throws Exception
     * @param token,use_id,code,size,flag
     * @return json
     * @author GiangNT
     */
     
    public function list_inventory() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['code'], $data['size'], $data['flag'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        try{
        	
			$this->loadModel('MProcess');
            $this->loadModel('SpecDetail');
            //$this->SpecDetail->Behaviors->load('Containable');
            $mprocess_id = $this->MProcess->find('first', array('conditions' => array('MProcess.code' => PROCESS_10), 'fields' => array('id')));
			//Mpaper
            $conditons = array(
                 'ltrim(UPPER(MPaper.code)) LIKE' => strtoupper(rtrim(ltrim($data['code']))) . '%',  
                 'ltrim(UPPER(MPaperSize.code)) LIKE' => strtoupper(rtrim(ltrim($data['size']))) . '%',  
                 'MPaper.del_flag' => false,
            );
            
            if(strtolower($data['flag']) == 'true') {
                array_push($conditons,'MPaper.cur_num < COALESCE(MPaper.threshold, 0)::int');
            }
			
			$fields = array(
				'MPaper.id',
				'MPaper.code',
				'MPaper.threshold',
				'MPaper.cur_num',
				'MPaper.packing_num',
				'MPaper.cutting_num',
				'MPaper.supplier',
				'MPaperSize.code',
			);
            $data_finds = $this->MPaper->find('all', array(
                'conditions' => $conditons, 
                'fields' => $fields,
                'recursive' => 0,
                'order' => array('MPaper.code', 'MPaperSize.code'),
            ));
			$this->SpecDetail->virtualFields['process_10'] = 'SUM(coalesce(SpecDetail.print_num, 0)) + SUM(coalesce(SpecDetail.reserve_num, 0))';
			
			foreach ($data_finds as $key => &$data_find) {
				$Spec_process_10 = $this-> SpecDetail -> find('all', array(
                'conditions' => array(
                    'Spec.del_flag' => false,
                    'Spec.m_process_id' => $mprocess_id['MProcess']['id'],
                    'SpecDetail.m_paper_id' => $data_find['MPaper']['id'],
                ),
                'fields' => array(
                    'SpecDetail.process_10',
                ),
                'joins' => array(
                    array('table' => 'specs',
                    'alias' => 'Spec',
                    'type' => 'inner',
                    'conditions' => array(
                        'Spec.id = SpecDetail.spec_id'
                        )
                    ),
                ),
                'recursive' => -1,
            ));
			$data_find['MPaper']['process_10_inventory'] = $data_find['MPaper']['cur_num'] + $Spec_process_10[0]['SpecDetail']['process_10'];
			}
            if ($this -> Check -> is_multiArrayEmpty($data_finds)) {
                $res['status'] = STS_EMPTY;
            } else {
                $res['status'] = STS_SUCCESS;
                $res['data_res'] = $data_finds;
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
     * list_inventory_history method
     * WS060200
     * @throws Exception
     * @param token,user_id,code,from,to
     * @return json
     * @author GiangNT
     */
     
    public function list_inventory_history() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        
        if (!isset($data['token'], $data['user_id'], $data['code'], $data['from'], $data['to'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        $this->PaperInventory->Behaviors->load('Containable');
        
        $conditions = array(
           'ltrim(UPPER(MPaper.code)) LIKE' => strtoupper(rtrim(ltrim($data['code']))) . '%',
           'date(PaperInventory.inventory_date) >=' => $data['from'],
           'date(PaperInventory.inventory_date) <=' => $data['to'],
        );
        
        $fields = array(
            'PaperInventory.id',
            'date(PaperInventory.inventory_date) AS "PaperInventory__inventory_date"',
            'PaperInventory.prev_num',
            'PaperInventory.inventory_num',
            'PaperInventory.m_paper_id',
            'PaperInventory.spec_id',
            'PaperInventory.user_id',
        );
        
        $data_find = $this->PaperInventory->find('all', array(
            'conditions' => $conditions, 
            'fields' => $fields, 
            'order' => array('PaperInventory.inventory_date DESC'), 
            'recursive' => -1,
            'contain' => array(
                'Spec'=> array(
                    'fields'=> array('order_num'),
                    'Customer' => array('code'),
                    'Goods' => array('code')
                ),
                'MPaper' => array(
                    'fields' => array( 'code', 'cur_num', 'packing_num', 'cutting_num', 'supplier'),
                    'MPaperSize' => array('code')
                ),
                'User' => array('name')
            )
        ));
        
        if ($this -> Check -> is_multiArrayEmpty($data_find)) {
            $res['status'] = STS_EMPTY;
        } else {
            $res['status'] = STS_SUCCESS;
            $res['data_res'] = $data_find;
        }
        
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * list_inventory_history method
     * WS060200
     * @throws Exception
     * @param token,user_id,paper_id,inventory_num
     * @return json
     * @author GiangNT
     */
     
    public function inventory() {
        $this -> viewClass = 'Json';
        $data_PI = $data_MP = $res = array();
        $data = $this -> request -> data;
        $date = date("Y-m-d H:i:s");
        $flag = TRUE;
        if (!isset($data['token'], $data['user_id'], $data['paper_id'], $data['inventory_num'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        
        try{
            $list_m_paper_id = explode(GLUE_DATA, $data['paper_id']);
            $list_inventory_num = explode(GLUE_DATA, $data['inventory_num']);
            
            if(count($list_m_paper_id) != count($list_inventory_num)){
                $this -> log('Exception: paper_id and inventory_num not sync' , LOG_ERROR);
                $res['error'] = 'paper_id and inventory_num not sync';
                goto set;
            }
            // format data for PaperInventory and MPaper
            foreach ($list_m_paper_id as $index => $m_paper_id) {
                $cur_num = $this->MPaper->find('first', array('conditions' => array('MPaper.id' => $m_paper_id), 'fields' => array('MPaper.cur_num'), 'recursive' => -1, 'limit' => 1));
                
                // MPaper data
                $data_MP[$index]['MPaper']['id'] = $m_paper_id;
                $data_MP[$index]['MPaper']['cur_num'] = $cur_num['MPaper']['cur_num'] + $list_inventory_num[$index];
                
                //PaperInventory data
                $data_PI[$index]['PaperInventory']['m_paper_id'] = $m_paper_id;
                $data_PI[$index]['PaperInventory']['prev_num'] = $cur_num['MPaper']['cur_num'];
                $data_PI[$index]['PaperInventory']['inventory_num'] = $list_inventory_num[$index];
                $data_PI[$index]['PaperInventory']['inventory_date'] = $date;
                $data_PI[$index]['PaperInventory']['user_id'] = $data['user_id'];
            }
            $PI = $this -> PaperInventory -> getDataSource();
            $MP = $this -> MPaper -> getDataSource();
            $PI -> begin();
            $MP -> begin();
            if(empty($data_MP) || empty($data_PI)){
                $res['error'] = "Empty data of MPaper or PaperInventory";
                $flag = FALSE;
            }
           if($flag){
                if(!$this->MPaper->saveAll($data_MP)){
                    $res['validate'] = $this -> MPaper -> validationErrors;
                    goto rollback;
                }
                
                if(!$this->PaperInventory->saveAll($data_PI)){
                    $res['validate'] = $this -> PaperInventory -> validationErrors;
                    goto rollback;
                }
                $PI -> commit();
                $MP -> commit();
                $res['status'] = STS_SUCCESS;
           }else{
                rollback:
                $res['status'] = STS_DB_UPDATE_ERROR;
                $PI -> rollback();
                $MP -> rollback();
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
