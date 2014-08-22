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

     //ブログ記事の追加
     public function add() {

        
        if ($this->request->is('post')) {//このpostはpost送信のpost。post送信されたら
            


            
            $this->Group->create(); //データーを新たにインサートするときに必要なコード

            if ($this->Group->save($this->request->data)//成功したらtrueが返るので条件式に使える
                ) {
            
            //createとsaveの組み合わせでインサート文が発行される。
            /*
            debug($this->request->data);
            この中身は以下
            array(
                    'Post' => array(
                                    'title' => 'aaa',
                                    'body' => 'hhh'
                              )
            )
            */
                //setFlush 画面に文字を表示させるためのメソッド自分のページだけでなく遷移先にも表示させる。
                //sessionヘルパー　appコントローラーにいる
                $this->Session->setFlash(__('Your group has been saved.'));
                
                //(array('action' => 'index')同じモデルのindexファンクションへ飛ぶ
                return $this->redirect(array('action' => 'index'));

            }

            //saveが失敗したとき用
            $this->Session->setFlash(__('Unable to add your group.'));
            
        }
        
    }

 }



?>