<?php
App::uses('AppController', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class AddController extends AppController {

    public $uses = array('Token');
    public $components = array('Format', 'Check', 'FormatRespon');

    /**
     * addByfieldAndModel method
     * Common
     * @throws Exception
     * @param
     * @return json
     * @author GiangNT
     */
    public function addByfieldAndModel() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['fields_in'], $data['value'], $data['model'], $data['fields_out'])) {

            if ($this -> Check -> isset_model($data['model'])) {
                $this -> loadModel($data['model']);
                //================
                $new_data = $this -> Format -> formatSaveData($data['model'], $data['fields_in'], $data['value']);

                $model = ClassRegistry::init($data['model']);
                if (!empty($new_data)) {
                    if ($model -> saveAll($new_data)) {
                        $res['status'] = STS_SUCCESS;
                        $res['id'] = $model -> getInsertID();
                    } else {
                        $error = $model -> validationErrors;
                        $res['status'] = STS_DB_UPDATE_ERROR;
                    }
                } else {
                    $res['status'] = STS_ERROR_AUTH;
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

}
