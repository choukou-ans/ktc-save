<?php
App::uses('AppController', 'Controller');

class CommonsController extends AppController {

    public $uses = array('Token');
    public $components = array('FormatRespon');

    /**
     * delete common method
     * Common
     * @throws Exception
     * @param model, id, token
     * @return 200, 401, 602
     * @author GiangNT
     */
    public function delete() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['model'], $data['id'], $data['token'])) {
            if ($this -> Check -> isset_model($data['model'])) {
                $model = ClassRegistry::init($data['model']);
                $listId = explode(GLUE_DATA, $data['id']);
                $conditions = array($data['model'] . '.id' => $listId);
                if (array_key_exists('del_flag', $model -> getColumnTypes())) {
                    if ($model -> updateAll(array($data['model'] . '.del_flag' => TRUE), $conditions)) {
                        $res['status'] = STS_SUCCESS;
                    } else {
                        $res['status'] = STS_DB_DELETE;
                    }
                } else {
                    if ($model -> deleteAll($conditions, false)) {
                        $res['status'] = STS_SUCCESS;
                    } else {
                        $res['status'] = STS_DB_DELETE;
                    }
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

}
