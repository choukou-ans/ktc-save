<?php
App::uses('Component', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class FormatResponComponent extends Component {
    public $components = array('Check');
    public function initialize(Controller $controller) {
        $this -> controller = $controller;
    }

    public function formatType($tmp = array(), $name = '') {
        try {
            foreach ($tmp as $key => $value) {
                if (empty($data['title'])) {
                    $data['title'] = $name . '.' . $key;
                } else {
                    $data['title'] = $data['title'] . GLUE_DATA . $name . '.' . $key;
                }
                if (empty($data['data'])) {
                    if ($value['type'] == 'integer') {
                        $data['data'] = -1;
                    } elseif ($value['type'] == 'string') {
                        $data['data'] = $value['length'];
                    } else {
                        $data['data'] = $value['length'];
                    }
                } else {
                    if ($value['type'] == 'integer') {
                        $data['data'] = $data['data'] . GLUE_DATA . -1;
                    } elseif ($value['type'] == 'string') {
                        $data['data'] = $data['data'] . GLUE_DATA . $value['length'];
                    } else {
                        $data['data'] = $data['data'] . GLUE_DATA . $value['length'];
                    }
                }
                $data['null'][] = (int)$value['null'];
            }
            if (isset($data['null'])) {
                $data['null'] = implode(GLUE_DATA, $data['null']);
            }
            return $data;
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    public function responCSVByColFromAnyModel($datas = array()) {
        $title_tmp = array();
        $list_data = array();
        // $hasmany = array();
        try {
            if (isset($datas[0]) && is_array($datas[0])) {
                foreach ($datas[0] as $name_model => $data_model) {
                    if ($this -> Check -> array_depth($data_model) == 1 && !empty($data_model)) {
                        $title_tmp[] = $this -> getTitle($data_model, $name_model);
                    }
                }
                foreach ($datas as $key => $data) {
                    $tmp = $this -> getData($data);
                    $list_data[$key] = $tmp['data'];
                    // $hasmany[$key] = $tmp['hasMany'];
                }
                $data_res['title'] = implode(GLUE_DATA, $title_tmp);
                $data_res['data'] = $list_data;
                // $data_res['hasmany'] = $hasmany;
                return $data_res;
            } else {
                return array();
            }
        } catch (Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    /**
     * For hasmany function
     *
     * @return array
     * @author  GiangNT
     */

    public function responCSVForHasMany($datas = array(), $model = '') {
        try {
            $result['title'] = $this -> getTitle($datas[0], $model);
            $result['data'] = array();
            foreach ($datas as $key => $data) {
                if ($this -> Check -> array_depth($data) == 1) {
                    $result['data'][] = implode(GLUE_DATA, array_replace($data, array_fill_keys(array_keys($data, false, true), '0')));
                }
            }
            return $result;
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    public function getTitle($data = array(), $model = '') {
        try {
            $titles = array_keys($data);
            array_walk($titles, function(&$item, $key, $prefix) { $item = $prefix . '.' . $item;
            }, $model);
            return implode(GLUE_DATA, $titles);
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    public function getData($datas = array()) {
        $tmp['data'] = array();
        // $tmp['hasMany'] = array();
        try {
            foreach ($datas as $model => $value) {
                if (!empty($value)) {
                    if ($this -> Check -> array_depth($value) == 1) {
                        $tmp['data'][] = implode(GLUE_DATA, array_replace($value, array_fill_keys(array_keys($value, false, true), '0')));
                    }
                    // if ($this -> Check -> array_depth($value) == 2) {
                    // $tmp['hasMany'][] = $this -> responCSVForHasMany($value, $model);
                    // }
                }
            }
            $result['data'] = implode(GLUE_DATA, $tmp['data']);
            // $result['hasMany'] = $tmp['hasMany'];
            return $result;
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

}
