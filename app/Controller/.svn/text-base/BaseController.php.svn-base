<?php
/**
 * Base Controller
 *
 * 共通関数を定義
 *
 * - 認証されたクライアントからのアクセスかチェックする
 *
 */
class BaseController extends AppController {
	public $name = 'Base';
	var $components = array('DebugKit.Toolbar');

	function _get_param_data($key) {
		if ( isset($this->params['form'][$key]) ) {
			return $this->params['form'][$key];
		} else if ( isset($this->params['url'][$key]) ) {
			return $this->params['url'][$key];
		}
		return null;
	}

	/*
	 * 認証されたクライアントからのアクセスかチェックする
	 */
	function _check_token() {

		$token = $this->_get_param_data('token');

		if ( $mobilekey == null ) {
			throw new Exception('Tokenがありません');
		}

		/*
		 * TokenがDBに登録されているかどうかをチェック
		 */
		$model = $this->Token->find('first', array('conditions' => array('Token.token' => $token,)));
		if ( $model == null ) {
			throw new Exception('Tokenが登録されていません');
		}
		return true;
	}

}

