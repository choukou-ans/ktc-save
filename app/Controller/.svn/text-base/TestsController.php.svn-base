<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');

class TestsController extends AppController {
    public $uses = array('Spec', 'Goods', 'PaperInventory', 'MPaperSize', 'MPaper', 'Customer', 'User', 'MEditMasterRole', 'MEditMasters');
    public $components = array('Format', 'Check', 'FormatRespon', 'Common');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->layout = false;
        $domain = Router::url('/', true);
		$title = 'Test - ' . $domain;
        $apis = array(
        	$domain."Spec/update" => 'token,user_id,Spec_title,Spec_value,Spec_Detail_title,Spec_Detail_value,Spec_Outsource_title,Spec_Outsource_value',
            $domain."Spec/get_data" => 'id,token,user_id',
            $domain."Spec/update_all_process" => 'token,user_id,process_id,spec_code',
            $domain."Spec/print_estimate" => 'token,user_id,spec_id',
            $domain."Spec/update_process" => 'token,user_id,spec_id,process_code',
            $domain."Spec/get_latest_data" => 'token,user_id,customerID,goodsID',
            $domain."Spec/get_nodelivery_data" => 'token,user_id,customerID,goodscode',
            $domain."Spec/check_order_num" => 'token,user_id,customer_id,goods_code,order_num',
            $domain."Spec/add_only" => 'token,user_id,fields_in,value,model,fields_out',
            $domain."Spec/get_delivery_data" => 'specID,token,user_id',
            $domain."Spec/list_data_bml" => 'token,user_id,p_code_start,p_code_finish,date_start,date_finish',
            $domain."BookbindDay/search" => 'code',
            $domain."Bookbinding/search" => 'code',
            $domain."Classify/search" => 'code,no',
            $domain."Customer/search" => 'code',
            $domain."Customer/update" => 'token,user_id,fields_in,value,model,fields_out',
            $domain."Customer/get_data" => 'token,user_id,code,custId',
            $domain."Customer/del" => 'id,token,user_id',
            $domain."Customer/list_data" => 'user_id,token,user_id,CusCode,CusNam',
            $domain."CutoffType/search" => 'code',
            $domain."DealType/list_data" => '',
            $domain."DeliveryNote/list_data" => 'user_id,token,flag,CustomerCode,CustomerName,GoodsCode,DeliveryFrom,DeliveryTo',
            $domain."DeliveryNote/list_menoy_by_delivery_date" => 'token,user_id,extract_date',
            $domain."DeliveryNote/list_by_delivery_date" => 'token,user_id,extract_date',
            $domain."DeliveryNote/list_delivery_fax" => 'token,user_id,extract_date',
            $domain."DeliveryNote/list_menony_summary" => 'token,user_id,extract_date_from,extract_date_to',
            $domain."FeeCharge/list_data" => '',
            $domain."Fold/search" => 'code',
            $domain."Fraction/list_data" => '',
            $domain."Goods/add" => 'token,user_id,fields_in,value,model,fields_out',
            $domain."Goods/search" => 'fields_in,value,fields_out',
            $domain."HoleType/search" => 'fields_in,value,model,fields_out',
            $domain."Information/index" => '',
            $domain."InventoryType/search" => 'code,flag',
            $domain."Login/index" => 'token,login,pwd',
            $domain."Master/list_edit_master" => 'token,user_id',
            $domain."Master/list_data" => "user_id,token,masterID",
            $domain."Master/edit_data" => 'token,user_id,fields_in,value,model,fields_out',
            $domain."Master/del_data" => 'model,id,token',
            $domain."Menu/get_menu" => 'user_id,token',
            $domain."Outsource/search" => 'code,model',
            $domain."Paper/search" => 'fields_in,value,model,fields_out',
            $domain."Part/search" => 'code',
            $domain."TaxImputation/list_data" => '',
            $domain."WithdrawalCycle/list_data" => '',
            $domain."Withdrawal/search" => 'code',
            $domain."Paper/get_inventory" => 'token, user_id, m_paper_id',
            $domain."Master/list_select_data" => 'user_id, token, masterID, param2',
            $domain."User/list_data" => 'token, user_id, userFlag',
            $domain."User/update" => 'model, columns, values, token, user_id, userFlag, customer_id',
            $domain."User/delete" => 'token,user_id,id',
            $domain."User/search" => 'code',
            $domain."DeliveryNote/get_next_order_num" => 'token,user_id,customer_id',
            $domain."DeliveryNote/add" => 'token,user_id,flag,delivery_note_details_title,delivery_note_details_data,delivery_notes_title,delivery_notes_data',
        	$domain."PaperSize/search" => 'code',
        	$domain."Paper/list_inventory_history" => 'token,user_id,code,from,to',
        	$domain."Paper/list_inventory" => 'token,user_id,code,size,flag',
        	$domain."Paper/inventory" => 'token,user_id,paper_id,inventory_num',
        	$domain."Spec/search" => 'token,user_id,customer_code,customer_name,S_user_id,delivery_date_from,delivery_date_to,goods_name,process_code_from,process_code_to,sheet_num,paper_size_id,part_name,outsource_id',
        	$domain."ProductPaperSize/search" => 'code',
        	$domain."Bill/list_data_bml" => 'token,user_id,month,year', 
        	$domain."Process/list_data" => 'token,user_id', 
        	$domain."Estimate/search" => 'token,user_id,customer_code,customer_name,goods_code,goods_name,price,E_user_id,date_from,date_to,flag_spec_id,lost_flag', 
        	$domain."Estimate/del" => 'token,user_id,estimate_id', 
        	$domain."Estimate/order_lost" => 'token,user_id,estimate_id', 
        	$domain."Estimate/order_recieved" => 'token,user_id,estimate_id', 
        );
        
        ksort($apis);
        $this -> set(compact('apis', 'domain', 'title'));
    }

   public function test() {
        $this -> viewClass = 'Json';
        $data = $this->request->data;
        $tmp = $this->Common->getExceptFields('User', 'id,login');
        debug($tmp);die;
        $this -> set(compact('data'));
        $this -> set('_serialize', array('data'));
    }

   public function debug_test() {
    $this->layout = false;
    $data = $this->request->data;
    debug($data);die;
    $this -> set(compact('data'));

   }
   
   public function getData() {
        //$this -> viewClass = 'Json';
        $data = $this->request->data;
        debug($data);die;
        $this -> set(compact('data'));
        $this -> set('_serialize', array('data'));
   }
}
