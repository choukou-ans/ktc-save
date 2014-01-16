<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class EstimateController extends AppController {

    public $uses = array('Estimate');
    public $components = array('Format', 'Check', 'Common');

    /**
     * search method
     * Common
     * @throws Exception
     * @param token,user_id,customer_code,customer_name,goods_code,goods_name,price,E_user_id,date_from,date_to,flag_spec_id,lost_flag
     * @return json
     * @author GiangNT
     */
    public function search() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['token'], $data['user_id'], $data['customer_code'], $data['customer_name'], $data['goods_code'], $data['goods_name'], $data['price'], $data['E_user_id'], $data['date_from'], $data['date_to'], $data['flag_spec_id'], $data['lost_flag'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
			goto set;
        } 
		
		$conditons = array(
			'Estimate.del_flag' => FALSE,
			'ltrim(UPPER(Customer.code)) LIKE' => $this->Common->queryUpper($data['customer_code']) . "%", 
			'ltrim(UPPER(Customer.name)) LIKE' => $this->Common->queryUpper($data['customer_name']) . "%", 
			'ltrim(UPPER(Goods.code)) LIKE' => $this->Common->queryUpper($data['goods_code']) . "%", 
			'ltrim(UPPER(Goods.name)) LIKE' => $this->Common->queryUpper($data['goods_name']) . "%", 
			$data['date_from'] != '0001-01-01' ? 'date(coalesce(Estimate.created, \'0001-01-01\')) >=' : 'date(Estimate.created) >=' => empty($data['date_from']) ? '0001-01-01' : $data['date_from'],
			'date(coalesce(Estimate.created, \'0001-01-01\')) <=' => empty($data['date_to']) ? '9999-12-31' : $data['date_to'],
		);
		
        if(trim(strtolower($data['flag_spec_id'])) == 'false'){
            $conditons['Estimate.spec_id'] = null;
        }

        if(trim(strtolower($data['lost_flag'])) == 'false'){
            $conditons['Estimate.lost_flag'] = FALSE;
        }
        
        if(!empty($data['E_user_id'])){
            $conditons['Estimate.user_id'] = $data['E_user_id'];
        }
        
        if(!empty($data['E_user_id'])){
            $conditons['Estimate.price'] = $data['price'];
        }

		$fields = array(
			'Spec.id',
			'Customer.code',
			'Customer.name',
			'Goods.code',
			'Goods.name',
			'User.login',
			'User.name',
			'Estimate.price',
			'Estimate.unit_price',
			'Estimate.num',
			'Estimate.unit',
			'Estimate.estimate_date',
			'Estimate.lost_flag',
		);
		
		$order = array(
			'Customer.code',
			'Goods.code',
			'Estimate.estimate_date'
		);
		$data_find = $this->Estimate->find('all', array(
    		'conditions' => $conditons, 
    		'fields' => $fields, 
    		'order' => $order,
    		'recursive' => 0,
          ));
          
        if($this -> Check -> is_multiArrayEmpty($data_find)) {
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
     * del method
     * Common
     * @throws Exception
     * @param token,user_id,estimate_id
     * @return json
     * @author GiangNT
     */
    
    public function del() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['estimate_id'], $data['token'],  $data['user_id'])) {
            $listId = explode(GLUE_DATA, $data['estimate_id']);
            $conditions = array('Estimate.id' => $listId);
            if ($this -> Estimate -> updateAll(array('Estimate.del_flag' => TRUE), $conditions)) {
               
                $id_true = $this -> Estimate -> find('list', array(
                    'order' => array('Estimate.id'), 
                    'conditions' => array(
                        'Estimate.del_flag' => TRUE, 
                        'Estimate.id' => $listId
                    ), 
                    'fields' => array('Estimate.id')
                ));
                
                if (count($listId) == count($id_true)) {
                    $res['status'] = STS_SUCCESS;
                } else {
                    $res['status'] = STS_DB_DELETE;
                }
                
                $res['data_res'] = implode(GLUE_DATA, $id_true);
                
            } else {
                $res['status'] = STS_DB_DELETE;
                $res['data_res'] = $data['estimate_id'];
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * order_recieved method
     * Common
     * @throws Exception
     * @param token,user_id,estimate_id
     * @return json
     * @author GiangNT
     */
     
     public function order_recieved() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['estimate_id'], $data['token'], $data['user_id'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        
        debug($data['estimate_id']);die;
        
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
     }
     
    /**
     * order_lost method
     * Common
     * @throws Exception
     * @param token,user_id,estimate_id
     * @return json
     * @author GiangNT
     */
     
     public function order_lost() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (!isset($data['estimate_id'], $data['token'],  $data['user_id'])) {
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        
        $listId = explode(GLUE_DATA, $data['estimate_id']);
        $conditions = array('Estimate.id' => $listId);
        if ($this -> Estimate -> updateAll(array('Estimate.lost_flag' => TRUE), $conditions)) {
           
            $id_true = $this -> Estimate -> find('list', array(
                'order' => array('Estimate.id'), 
                'conditions' => array(
                    'Estimate.lost_flag' => TRUE, 
                    'Estimate.id' => $listId
                ), 
                'fields' => array('Estimate.id')
            ));
            
            if (count($listId) == count($id_true)) {
                $res['status'] = STS_SUCCESS;
            } else {
                $res['status'] = STS_DB_UPDATE_ERROR;
            }
            
            $res['data_res'] = implode(GLUE_DATA, $id_true);
            
        } else {
            $res['status'] = STS_DB_UPDATE_ERROR;
            $res['data_res'] = $data['estimate_id'];
        }
        
        set:
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
     }
}
