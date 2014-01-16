<?php
App::uses('Component', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class FormatComponent extends Component {
    public $components = array('Check');
    public function initialize(Controller $controller) {
        $this -> controller = $controller;
    }

    public function formatSaveData($model = '', $columns = '', $data = '') {
        try {
            if (!$this -> Check -> in_fileds($columns, $model)) {
                throw new NotFoundException($model . ': Not found field');
            }
            $columns = explode(GLUE, $columns);
            $count_col = count($columns);
            $datas = explode(GLUE, $data);
            if ((count($datas) % $count_col) != 0) {
                $e = $count_col - (count($datas) % $count_col);
                throw new Exception($model . ": " . "Column and data not synchronous(" . $e . "/" . $count_col . ")", 1);
            }
            $j = 0;
            foreach ($datas as $key => $val) {
                if ($val == NULL) {
                    $val = null;
                }
                $i = $key % $count_col;
                $dataf[$j][$model][$columns[$i]] = $val;
                if ($i == ($count_col - 1)) {
                    if (!$this -> _checkEmptyArray($dataf[$j][$model])) {
                        $j++;
                    } else {
                        unset($dataf[$j]);
                    }
                }
            }
            if (isset($dataf)) {
                return $dataf;
            } else {
                return array();
            }
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    public function getCSVMaster($str = '', $flag = TRUE, $glue = ',', $glue_start = '(', $glue_end = ')') {
        try {
            $flag = (boolean)$flag;
            $count_str = strlen($str);
            $tmp = array();
            $j = 0;
            for ($i = 0; $i < $count_str; $i++) {
                if ($flag) {
                    $strict = true;
                } else {
                    $strict = ($str[$i] != $glue_start) && ($str[$i] != $glue_end);
                }
                if (!isset($tmp[$j])) { $tmp[$j] = '';
                }
                if ($str[$i] == $glue_start) {
                    $start = $i;
                }
                if ($str[$i] == $glue_end) {
                    unset($start);
                }
                if (isset($start) && ($i > $start)) {
                    $tmp[$j] = $tmp[$j] . $str[$i];
                } else {
                    if ($str[$i] != $glue && $strict) {
                        $tmp[$j] = $tmp[$j] . $str[$i];
                    } elseif ($str[$i] == $glue) {
                        $j++;
                    }
                }
            }
            return $tmp;
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    protected function _checkEmptyArray($array = array()) {
        foreach ($array as $key => $value) {
            if (!empty($value)) {
                return FALSE;
            }
        }
        return TRUE;
    }

    public function formatDataAssociate($titles = '', $value = '', $recursive = 0) {
        $result = array();
        if (empty($titles) || empty($value)) {
            goto set;
        }
        try {
            $titles_array = explode(GLUE, $titles);
            $count_titles = count($titles_array);
            $value_splip = explode(GLUE, $value);
            $value_array_chuck = array_chunk($value_splip, $count_titles);
            if((count($value_splip) % $count_titles) != 0){
                throw new Exception("value vs title not sync: " . count($value_splip) . ":"  .$count_titles, 1);
            }
            foreach ($value_array_chuck as $key => $value) {
                switch($recursive) {
                    case 0 :
                        foreach ($titles_array as $key_title => $title) {
                            $title_tmp = explode(GLUE_MODEL, $title);
                            $result[$key][$title_tmp[0]][$title_tmp[1]] = $value[$key_title];
                        }
                        break;
                    case 1 :
                        foreach ($titles_array as $key_title => $title) {
                            $title_tmp = explode(GLUE_MODEL, $title);
                            if ($key_title == 0) {
                                $tmp = $title_tmp[0];
                            }
                            if ($title_tmp[0] == $tmp) {
                                $result[$key][$tmp][$title_tmp[1]] = $value[$key_title];
                            } else {
                                $result[$key][$tmp][$title_tmp[0]][$title_tmp[1]] = $value[$key_title];
                            }
                        }
                        break;
                    case 2 :
                        foreach ($titles_array as $key_title => $title) {
                            $title_tmp = explode(GLUE_MODEL, $title);
                            if ($key_title == 0) {
                                $tmp = $title_tmp[0];
                            }
                            if ($title_tmp[0] == $tmp) {
                                $result[$tmp][$key][$title_tmp[1]] = $value[$key_title];
                            } else {
                                $result[$tmp][$key][$title_tmp[0]][$title_tmp[1]] = $value[$key_title];
                            }
                        }
                        break;
                }
            }
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
            exit;
        }
        set:
        return $result;
    }

}
