<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class WithdrawalController extends AppController {

    public $name = 'Withdrawal';
    public $components = array('Check');
    public $uses = array('MWithdrawal');

    /**
     * search method
     * WS120302
     * @throws Exception
     * @param
     * @return json
     * @author GiangNT
     */

    public function search() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['code'])) {
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


}
