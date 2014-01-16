<?php
App::uses('Component', 'Controller');
/**
 *
 * @Auth: GiangNT
 *
 */
class CommonComponent extends Component {
    public $components = array('Check');
    public function initialize(Controller $controller) {
        $this -> controller = $controller;
    }

    public function addModeltoFileds($define = '', $str = '') {
        try {
            if(!empty($str)){
                $list = explode(GLUE, $str);
                foreach ($list as $key => $value) {
                    $list[$key] = $define . GLUE_MODEL . $value;
                }
                return $list;
            }else{
                return array();
            }
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }

    public function mapTwoArray($str = '', $data = array()) {
        try {
            $list = explode(GLUE, $str);
            function map($n, $m) {
                return ( array($n => $m));
            }

            return array_map("map", $data, $list);
        } catch(Exception $e) {
            echo 'Exception: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }
    
    /**
     * getExceptFields function
     * not check isset_model, modelvs list_fields not null, list_fields is fomart CSV, not check infields
     * @return Array
     * @author  GiangNT
     */
     
    public function getExceptFields($model = '', $list_fileds = '') {
        try{
            if(!empty($model) && !empty($list_fileds)){
                $schema_model = ClassRegistry::init($model);
                $list_all = array_keys($schema_model-> getColumnTypes());
                $list_excetp = explode(',', $list_fileds);
                $result = array_diff($list_all, $list_excetp);
                $model_list = array_fill(0, count($result), $model);
                return array_map(function($model, $field){return $model . '.' . $field;}, $model_list, $result);
            }else{
                return array();
            }
        } catch(Exception $e) {
            echo 'Exception of ExceptFields: ', $e -> getMessage(), "\n";
            $this -> log('Exception: ' . $e -> getMessage(), LOG_ERROR);
        }
    }
    
    public function queryUpper($value = '') {
        return strtoupper(rtrim(ltrim($value)));
    }
    
    public function queryLower($value = '') {
        return strtolower(rtrim(ltrim($value)));
    }

}
