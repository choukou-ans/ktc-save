<?php
App::uses('AppController', 'Controller');
/**
 * Master Controller
 *
 * @Auth: GiangNT
 *
 */
class MasterController extends AppController {

    public $uses = array('User', 'Token', 'Customer', 'MEditMasters', 'MEditMasterRole', 'MSelectMaster');
    public $components = array('Format', 'Check', 'FormatRespon', 'Common');

    /**
     * list_edit_master method
     * WS120100
     * @throws Exception
     * @param token,user_id
     * @return json
     * @author GiangNT
     * @package default
     */
    public function list_edit_master() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['user_id'], $data['token'])) {
            $conditions = array('User.id' => $data['user_id'], 'not' => array('User.employee_num' => null));
            $model = $this -> User -> find('first', array('conditions' => $conditions));
            $listMater = $this -> MEditMasterRole -> find('all', array('order' => array('MEditMaster.sort_no'), 'fields' => array('MEditMaster.id', 'MEditMaster.master_name', 'MEditMaster.edit_type'), 'conditions' => array('not' => array('MEditMaster.id' => null), 'MEditMasterRole.m_role_id' => $model['User']['m_role_id'])));
            $count = $this -> MEditMasterRole -> find('count', array('fields' => array('MEditMaster.id', 'MEditMaster.master_name', 'MEditMaster.edit_type'), 'conditions' => array('not' => array('MEditMaster.id' => null), 'MEditMasterRole.m_role_id' => $model['User']['m_role_id'])));

            $res['status'] = STS_SUCCESS;
            $res['data_res'] = $listMater;
        } else {
            $res['status'] = STS_ERROR_AUTH;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    /**
     * list_data method
     * WS120101
     *
     * @author  GiangNT
     * @package default
     */
    public function list_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['user_id'], $data['token'], $data['masterID'])) {
            try {
                if (!$this -> MEditMasters -> exists($data['masterID'])) {
                    throw new NotFoundException(__('Invalid masterID'));
                }
                $fields = array('MEditMasters.columns', 'MEditMasters.titles', 'MEditMasters.title_width', 'MEditMasters.model_name', 'MEditMasters.input_types', 'MEditMasters.select_masters', 'MEditMasters.condition', 'MEditMasters.sorts');
                $conditions = array('MEditMasters.id' => $data['masterID']);
                $mater = $this -> MEditMasters -> find('first', array('fields' => $fields, 'conditions' => $conditions));
                $list_data_res = array();
                $nameModel = $mater['MEditMasters']['model_name'];
                $fields_name_model = explode(GLUE_DATA, $mater['MEditMasters']['columns']);
                // debug($mater['MEditMasters']['select_masters']);
                $select_masters = array_filter($this -> Format -> getCSVMaster($mater['MEditMasters']['select_masters'], true));
                // debug($select_masters);die;
                $input_types = explode(GLUE_DATA, $mater['MEditMasters']['input_types']);
                $model = ClassRegistry::init($nameModel);
                $tmp_schema = $model -> schema();
                $conditions_model = $mater['MEditMasters']['condition'];
                $list_data = $model -> find('all', array('order' => $mater['MEditMasters']['sorts'], 'conditions' => $conditions_model, 'fields' => $fields_name_model, 'recursive' => 0));
                $col = $this -> FormatRespon -> formatType($tmp_schema, $nameModel);
                foreach ($select_masters as $key_select_master => $select_master) {
                    if ($input_types[$key_select_master] == "p") {
                        $p_tmp = $this -> getFieldsFromSelectMaster($select_masters[$key_select_master]);
                        $model_p = ClassRegistry::init($p_tmp['model']);
                        $p_list_data = $model_p -> find('all', array('fields' => $p_tmp['fields'], 'recursive' => -1));
                        $res['p'][] = $this -> FormatRespon -> responCSVByColFromAnyModel($p_list_data);
                    } elseif ($input_types[$key_select_master] == "t") {
                        $model_t = ClassRegistry::init($select_master);
                        $t_data = $model_t -> find('all', array('fields' => array($select_master . '.id', $fields_name_model[$key_select_master]), 'recursive' => -1));
                        $res['t'][] = $this -> FormatRespon -> responCSVByColFromAnyModel($t_data);
                        $model_t_schema = $model_t -> schema();
                        $col_model_t = explode(GLUE_MODEL, $fields_name_model[$key_select_master]);
                        if (empty($col['title'])) {
                            $col['title'] = $select_master . GLUE_MODEL . $col_model_t[1];
                        } else {
                            $col['title'] = $col['title'] . GLUE_DATA . $select_master . GLUE_MODEL . $col_model_t[1];
                        }
                        if (empty($col['data'])) {
                            $col['data'] = $model_t_schema[$col_model_t[1]]['length'];
                        } else {
                            $col['data'] = $col['data'] . GLUE_DATA . $model_t_schema[$col_model_t[1]]['length'];
                        }
                    } elseif ($input_types[$key_select_master] == "f") {
                        $model_t = ClassRegistry::init($select_master);
                        $model_t_schema = $model_t -> schema();
                        $col_model_t = explode(GLUE_MODEL, $fields_name_model[$key_select_master]);
                        if (empty($col['title'])) {
                            $col['title'] = $select_master . GLUE_MODEL . $col_model_t[1];
                        } else {
                            $col['title'] = $col['title'] . GLUE_DATA . $select_master . GLUE_MODEL . $col_model_t[1];
                        }
                        if (empty($col['data'])) {
                            $col['data'] = 1;
                        } else {
                            $col['data'] = $col['data'] . GLUE_DATA . 1;
                        }
                    }
                }
                $res['status'] = STS_SUCCESS;
                $res['data_res'] = $list_data;
                $res['MEditMasters'] = $mater['MEditMasters'];
                $res['maxlength'] = $col;

            } catch(Exception $e) {
                echo 'Exception: ', $e -> getMessage(), "\n";
                $this -> log("Exception : " . $e -> getMessage(), LOG_ERROR);
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));

    }

    /**
     * edit_data method
     * WS120101
     *
     * @author  GiangNT
     * @package default
     */

    public function edit_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'], $data['user_id'], $data['fields_in'], $data['value'], $data['model'], $data['fields_out'])) {
            $nameModel = $data['model'];
            if ($this -> Check -> isset_model($nameModel)) {
                try {
                    //================
                    $new_data = $this -> Format -> formatSaveData($data['model'], $data['fields_in'], $data['value']);
                    $model = ClassRegistry::init($data['model']);
                    if (!empty($new_data)) {
                        if ($model -> saveAll($new_data)) {
                            $res['status'] = STS_SUCCESS;
                            // $res['id'] = $model -> getInsertID();
                            $res['id'] = $model -> id;
                        } else {
                            $res['status'] = STS_DB_UPDATE_ERROR;
							$res['error'] =  $model -> validationErrors;
                        }
                    } else {
                        $res['status'] = STS_EMPTY_DATA_REQUEST;
                    }
                    //=============================
                } catch(Exception $e) {
                    echo 'Exception: ', $e -> getMessage(), "\n";
                    $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
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

    /**
     * del_data method
     * WS120101
     *
     * @author  GiangNT
     * @package default
     */
    public function del_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['model'], $data['id'], $data['token'], $data['user_id'])) {
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

    /**
     * reFormatCSV method
     * WS120101
     *
     * @author  GiangNT
     * @package default
     */
    protected function reFormatCSV($str = '') {
        try {
            $select = str_split($str);
            foreach ($select as $key => $letter) {
                if ($letter == "(") {
                    $tmp_open = $key;
                    $select[$key] = GLUE_TMP;
                }
                if ($letter == ")") {
                    $tmp_clsoe = $key;
                    $select[$key] = '';
                }
                if (isset($tmp_open) && ($key > $tmp_open)) {
                    if (isset($tmp_clsoe)) {
                        if (($key > $tmp_open) && ($tmp_open > $tmp_clsoe)) {
                            if ($letter == ",") {
                                $select[$key] = GLUE_TMP;
                            }
                        }
                    } else {
                        if ($letter == ",") {
                            $select[$key] = GLUE_TMP;
                        }
                    }
                }
            }
            return implode('', $select);
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    /**
     * getFieldsFromGLUE_TMP method
     * WS120101
     *
     * @author  GiangNT
     * @package default
     */
    protected function getFieldsFromGLUE_TMP($str = '') {
        try {
            $tmp = explode(GLUE_TMP, $str);
            $tmp_length = count($tmp);
            $data['model'] = $tmp[0];
            $data['fields'] = array();
            for ($i = 0; $i < $tmp_length - 1; $i++) {
                array_push($data['fields'], $tmp[0] . GLUE_MODEL . $tmp[$i + 1]);
            }
            return $data;
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    /**
     * getFieldsFromSelectMaster method
     * WS120101
     *
     * @author  GiangNT
     * @package default
     */
    protected function getFieldsFromSelectMaster($str = '') {
        try {
            $tmp = preg_split('/[(,)]/', $str);
            $data['model'] = $tmp[0];
            $data['fields'] = array();
            foreach ($tmp as $key => $value) {
                if(!empty($value) && $key != 0){
                    array_push($data['fields'], $data['model'] . GLUE_MODEL . $value);
                }
            }
            return $data;
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    /**
     * Masters selected method
     * @tutorial WSCC0100
     * @throws NotFoundException
     * @param MasterID, Token, UserId
     * @return columns, titles, title_with, record Master
     * @author Tu Vu
     */

    public function list_select_data() {
        $this -> viewClass = 'Json';
        $res = array();
        $options = array();
        $data = $this -> request -> data;

        if (isset($data['user_id'], $data['token'], $data['masterID'], $data['param2'])) {
        	$optionsMselecMaster = array();
        	$optionsMselecMaster['fields'] = array('MSelectMaster.columns', 'MSelectMaster.titles', 'MSelectMaster.title_width', 'MSelectMaster.model_name'
        											, 'MSelectMaster.master_name', 'MSelectMaster.condition', 'MSelectMaster.sorts');
        	$optionsMselecMaster['conditions'] = array('MSelectMaster.id' => $data['masterID']);
            $mater = $this -> MSelectMaster -> find('first', $optionsMselecMaster);
            if ($this -> Check -> recursive_array_search(null, $mater)) {
                $res['status'] = '501';
                $this -> set(compact('res'));
                $this -> set('_serialize', array('res'));
            } else {
                $tmp1 = explode(GLUE_DATA, $mater['MSelectMaster']['title_width']);
                $mater['MSelectMaster']['countWith'] = count($tmp1);
                $tmp = explode(GLUE_DATA, $mater['MSelectMaster']['titles']);
                $mater['MSelectMaster']['count'] = count($tmp);

                $nameModel = $mater['MSelectMaster']['model_name'];
                $model = ClassRegistry::init($nameModel);
                $fields = explode(GLUE_DATA, $mater['MSelectMaster']['columns']);
                foreach ($fields as $key => $value) {

                    $fields[$key + 1] = $nameModel . GLUE_MODEL . $value;
                }
                $fields[0] = $nameModel . '.id';

                $options['fields'] = $fields;
                $options['recursive'] = -1;
                $options['order'] = array($mater['MSelectMaster']['sorts'].' ASC');
                $options['conditions'] = '';
                if (!empty($data['param2'])) {
                    $options['conditions'] = str_replace("?", $data['param2'], $mater['MSelectMaster']['condition']);
                } else {
                    if (strpos($mater['MSelectMaster']['condition'], '?') !== false) {
                    	if (strpos($mater['MSelectMaster']['condition'], GLUE_DATA) !== false) {
                    		$tmpConditions = explode(GLUE_DATA, $mater['MSelectMaster']['condition']);
                    	} else {
                    		$tmpConditions = array($mater['MSelectMaster']['condition']);
                    	}
                    	foreach ($tmpConditions as $key => $val) {
                    		if(strpos($val, '?') === false) {
                    			if(empty($options['conditions'])) {
                    				$options['conditions'] .= $val;
                    			} else {
                    				$options['conditions'] .= ','.$val;
                    			}
                    		}
                    	}
                    } else {
                        $options['conditions'] = $mater['MSelectMaster']['condition'];
                    }
                }         
            	if (strpos($options['conditions'], GLUE_DATA) !== false) {
                	$options['conditions'] = explode(GLUE_DATA, $options['conditions']);
                }
                
                $datat = $model -> find('all', $options);

                $res['status'] = STS_SUCCESS;
                $res['colums'] = 'id, ' . $mater['MSelectMaster']['columns'];
                $res['title'] = $mater['MSelectMaster']['titles'];
                $res['title_width'] = $mater['MSelectMaster']['title_width'];
                $res['master_name'] = $mater['MSelectMaster']['master_name'];
                if(empty($datat)) {
                	$datat = null;
                }
                $res['data_res'] = $datat;
                $this -> set(compact('res'));
                $this -> set('_serialize', array('res'));
            }
        } else {
            $res['status'] = STS_ERROR_AUTH;
            $this -> set(compact('res'));
            $this -> set('_serialize', array('res'));
        }
    }

}
