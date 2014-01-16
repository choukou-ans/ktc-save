<?php
App::uses('Component', 'Controller');
App::uses('Folder', 'Utility');

class CheckComponent extends Component {
    public function initialize(Controller $controller) {
        $this -> controller = $controller;
    }

    public function recursive_array_search($needle, $haystack) {
        foreach ($haystack as $key => $value) {
            $current_key = $key;
            if ($needle === $value OR (is_array($value) && $this -> recursive_array_search($needle, $value) !== false)) {
                return true;
            }
        }
        return false;
    }

    public function is_multiArrayEmpty($multiarray) {
        if (is_array($multiarray) and !empty($multiarray)) {
            $tmp = array_shift($multiarray);
            if (!$this -> is_multiArrayEmpty($multiarray) or !$this -> is_multiArrayEmpty($tmp)) {
                return false;
            }
            return true;
        }
        if (empty($multiarray)) {
            return true;
        }
        return false;
    }

    public function isset_model($nameModel = '') {
        try {
            $dir = new Folder(MODEL_DIR);
            $files = $dir -> find('.*\.php');
            if (array_search($nameModel . '.php', $files) == 0) {
                return TRUE;
            }
            return array_search($nameModel . '.php', $files);
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    public function in_fileds($fields = '', $nameModel = '') {
        try {
            $fields = explode(GLUE, $fields);
            if ($this -> isset_model($nameModel)) {
                $model = ClassRegistry::init($nameModel);
                $list_field = $model -> getColumnTypes();
                foreach ($fields as $key => $value) {
                    if (!array_key_exists($value, $list_field)) {
                        $this->log("Lost Field: ", LOG_DEBUG);
                        $this->log($value, LOG_DEBUG);
                        return FALSE;
                        break;
                    }
                }
                return TRUE;
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }

    }

    /**
     * get depth array
     *
     * @author GiangNT
     * @version 1.0
     * @copyright
     * @package default
     */
    public function array_depth($array = array()) {
        $max_indentation = 1;
        $array_str = print_r($array, true);
        $lines = explode("\n", $array_str);
        foreach ($lines as $line) {
            $indentation = (strlen($line) - strlen(ltrim($line))) / 4;
            if ($indentation > $max_indentation) {
                $max_indentation = $indentation;
            }
        }
        return ceil(($max_indentation - 1) / 2) + 1;
    }

}
