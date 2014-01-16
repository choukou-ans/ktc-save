<?php
/**
 * Init Controller
 *
 * 共通関数を定義
 *
 * - 認証されたクライアントからのアクセスかチェックする
 *
 */
require "BaseController.php";

class LoginController extends BaseController {
    public $name = 'Auth';

    public $uses = array('User', 'Token', 'MMenuRole');

    /*
     * パラメータ
     *   token			Authで認証後に渡されたトークン
     *   loginid				ユーザ名
     *   pwd			パスワード
     */
    public function index() {
        $this -> viewClass = 'Json';
        $res = array();
        $data = $this -> request -> data;
        if (isset($data['token'],$data['login'], $data['pwd'])) {
            $login = $data['login'];
            $password = $data['pwd'];
            if (empty($login) || empty($password)) {
                $res['status'] = STS_EMPTY_DATA_REQUEST;
            } else {
                $conditions = array('User.login' => $login, 'User.del_flag' => FALSE, 'not' => array('User.employee_num' => null));
                $model = $this -> User -> find('first', array('conditions' => $conditions));
                if (empty($model)) {
                    $res['status'] = STS_ERROR_AUTH;
                } else {
                    if ($model['User']['password'] != md5($password)) {
                        $res['status'] = STS_ERROR_PWD;
                    } else {
                        $res['status'] = STS_SUCCESS;
                        $res['id'] = $model['User']['id'];
                        $res['name'] = $model['User']['name'];
                        $res['employee_num'] = $model['User']['employee_num'];
                        $res['role_id'] = $model['User']['m_role_id'];
                        $res['LoginID'] = $model['User']['login'];
                    }
                }
            }
        } else {
            $res['status'] = STS_ERROR_MISSINGDATA;
        }
        $this -> set(compact('res'));
        $this -> set('_serialize', array('res'));
    }

}
?>
