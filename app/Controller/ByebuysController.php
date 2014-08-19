<?php

App::uses('AppController', 'Controller');
//App::import('vendor', 'facebook/php-sdk/src/facebook');


class ByebuysController extends AppController {
    //public $helpers = array('Html', 'Form');//htmlヘルパーを使うよ！という宣言、使うヘルパーの名前を指定
    //今はappControllerでも同様の設定をしているのでコメントアウト

	//User,Gropuモデルを使えるようにするために宣言	//定義済み関数
	public $uses = array('User','Group');
	public $helpers = array('Facebook.Facebook');

	//ログインしなくてもアクセスできるように許可する、なるべく上の方に書いておく。
	//どのファンクションでも、それが呼ばれる前に必ず挙動する。
    function beforeFilter() {
    	parent::beforeFilter();
    	
    	$this->Auth->allow();
	}

    public function index(){//　/index/アドレスに飛んだタイミングで実行され、その結果が.ctpに返る

	}

	public function login() {

    }

    public function logout() {

    }

}



?>