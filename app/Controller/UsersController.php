<?php

App::uses('AppController', 'Controller');
//App::import('vendor', 'facebook/php-sdk/src/facebook');


class UsersController extends AppController {
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
        
    	$users = $this->User->find('all',array('conditions'=>$conditions));

		//cakePHPの定義済み関数findメソッド:指定したデータを取得する
        //$posts = $this->Post->find('all',array('conditions'=>array('title'=>'タイトル')));


        //$this->('posts'),$posts); //これでviewファイル　同じ名前じゃなくてもできちゃう。
	    $this->set(compact('users'));//view用の変数としてセット。

	}

	public function login() {

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Your username or password was incorrect.');
            }
        }
    }

    public function logout() {
        $this->Auth->logout();
    }

}



?>