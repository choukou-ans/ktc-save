<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class BillController extends AppController {

    public $uses = array('DeliveryNote', 'CustomerDept');
    public $components = array('Check');

    /**
     * list_data_bml method
     * WS1300100
     * 
     * @throws Exception
     * @param token,user_id,month,year
     * @return json
     * @author GiangNT
     */
    public function list_data_bml() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        
        if(!isset($data['token'], $data['user_id'], $data['month'], $data['year'])){
            $res['status'] = STS_ERROR_MISSINGDATA;
            goto set;
        }
        
		$data['month'] = sprintf('%02d', $data['month']);
		
        $conditions_bill = array(
            'DeliveryNote.del_flag' => FALSE,
            'to_char(date(DeliveryNote.delivery_date), \'YYYYMM\') =' => $data['year'].$data['month'],
            'Customer.deliver_flag' => TRUE,
            'Customer.del_flag' => FALSE,
        );
        
       // $this -> DeliveryNote -> Behaviors->load('Containable');
        $data_finds = $this -> DeliveryNote -> find('all', array(
            'conditions' => $conditions_bill,
            'recursive' => -1,
            'fields' => array(
                'DeliveryNote.id',
                'DeliveryNote.customer_id',
                'DeliveryNote.delivery_date',
                'DeliveryNote.tax_rate',
                'Goods.code',
                'Goods.name',
                'DeliveryNoteDetail.num',
                'DeliveryNoteDetail.unit_price',
                'DeliveryNoteDetail.price',
                'Spec.block_copy_total',
                'Spec.plate_makeing_total',
                'Spec.printing_total',
                'Spec.shipping_total',
            ),
            'order' => array('DeliveryNote.delivery_date'),
            'joins' => array(
                array(
                    'table'=> 'customers',
                    'alias' => 'Customer',
                    'type' => 'inner',
                    'conditions' => array('Customer.id = DeliveryNote.customer_id'),
                ),
                array(
                    'table'=> 'delivery_note_details',
                    'alias' => 'DeliveryNoteDetail',
                    'type' => 'inner',
                    'conditions' => array('DeliveryNoteDetail.delivery_note_id = DeliveryNote.id'),
                ),
                array(
                    'table'=> 'goods',
                    'alias' => 'Goods',
                    'type' => 'inner',
                    'conditions' => array('Goods.id = DeliveryNoteDetail.goods_id'),
                ),
                array(
                    'table'=> 'specs',
                    'alias' => 'Spec',
                    'type' => 'inner',
                    'conditions' => array('Spec.id = DeliveryNoteDetail.spec_id'),
                ),
            ),
        ));
      
        foreach ($data_finds as $index => &$data_find) {
             $dept = $this->CustomerDept->find('first', array(
                'conditions' => array(
                     'CustomerDept.customer_id' => $data_find['DeliveryNote']['customer_id'],
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
