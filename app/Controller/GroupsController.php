<?php

class GroupsController extends AppController {
    //public $helpers = array('Html', 'Form');//htmlヘルパーを使うよ！という宣言、使うヘルパーの名前を指定
    //今はappControllerでも同様の設定をしているのでコメントアウト

	
	//ログインしなくてもアクセスできるように許可する、なるべく上の方に書いておく。
	//どのファンクションでも、それが呼ばれる前に必ず挙動する。
    function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow();
	
	}

    public function index(){//　/index/アドレスに飛んだタイミングで実行され、その結果が.ctpに返る
        
       
    	$groups = $this->Group->find('all',array('conditions'=>$conditions));

		//cakePHPの定義済み関数findメソッド:指定したデータを取得する
        //$posts = $this->Post->find('all',array('conditions'=>array('title'=>'タイトル')));


        //$this->('posts'),$posts); //これでviewファイル　同じ名前じゃなくてもできちゃう。
	    $this->set(compact('groups'));//view用の変数としてセット。

	}

 }



?>