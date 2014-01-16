<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class MenuController extends AppController {

    public $name = 'Menu';
    public $uses = array('User', 'MMenuRole');
    public $components = array('Check');
    /**
     * get_menu method
     * WS000300
     * @throws Exception
     * @param
     * @return json
     * @author GiangNT
     */

    public function get_menu() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        try {
            if (isset($data['token'], $data['user_id'])) {
                $conditions = array('User.id' => $data['user_id'], 'User.del_flag' => FALSE, 'not' => array('User.employee_num' => null));
                $model = $this -> User -> find('first', array('conditions' => $conditions));
                $res['status'] = STS_SUCCESS;
                $res['data_res'] = $this -> MMenuRole -> find('all', array('fields' => array('MMenuRole.m_menu_id'), 'conditions' => array('MMenuRole.m_role_id' => $model['User']['m_role_id'])));
            } else {
                $res['status'] = STS_ERROR_MISSINGDATA;
            }
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }

        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

}
