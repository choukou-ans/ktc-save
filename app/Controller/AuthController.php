<?php
/**
 * Auth Controller
 *
 * Windowsアプリケーションの認証
 *  *
 * - 認証されたクライアントからのアクセスかチェックする
 *
 */
require "BaseController.php";

class AuthController extends BaseController {
    public $name = 'Auth';

    public $uses = array('User', 'Token');

    /*
     * パラメータ
     *   PMI_SECRET_KEY		Windowsクライアントにハードコードされている認証キー
     */
    public function index() {
        $this -> viewClass = 'Json';

        $res = array();

        if (!isset($this -> request -> data['PMI_SECRET_KEY'])) {
            $res['status'] = STS_ERROR_AUTH;
        } else if ($this -> request -> data['PMI_SECRET_KEY'] != PMI_SECRET_KEY) {
            $res['status'] = STS_ERROR_AUTH;
        } else {
            $key = $this -> request -> data['PMI_SECRET_KEY'];
            $this -> log("key = " . $key, LOG_DEBUG);
            /*
             * Tokenの生成
             */
            $now = (string)ceil(microtime(true) * 1000);
            $token = md5($now);

            $model = array();
            $model['Token']['token'] = $token;
            $this -> Token -> create();
            $this -> Token -> save($model);

            $res['status'] = STS_SUCCESS;
            $res['token'] = $token;
            $this -> log("Add token : " . $token, LOG_DEBUG);
        }

        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

    public function deny() {
        $this -> viewClass = 'Json';
        $res['status'] = STS_ERROR_AUTH;
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }
	
    public function notFoundUserId() {
        $this -> viewClass = 'Json';
        $res['status'] = STS_USER_ID_NOT_FOUND;
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

}
?>
