<?php

App::uses('AppController', 'Controller');
//App::import('vendor', 'facebook/php-sdk/src/facebook');


class PostmanagementsController extends AppController {
    //public $helpers = array('Html', 'Form');//htmlヘルパーを使うよ！という宣言、使うヘルパーの名前を指定
    //今はappControllerでも同様の設定をしているのでコメントアウト

	//User,Gropuモデルを使えるようにするために宣言	//定義済み関数
	public $uses = array('User','Category','Selling_list','Selling_thread_list','Wanted_list','Wanted_thread_list','Userpost');
	public $helpers = array('Facebook.Facebook','Html');

	//ログインしなくてもアクセスできるように許可する、なるべく上の方に書いておく。
	//どのファンクションでも、それが呼ばれる前に必ず挙動する。
    function beforeFilter() {
    	parent::beforeFilter();
    	//$this->Auth->allow();
	}

    public function index($id){
    if ($this->request->is('post')){

        $conditions = array("User.status !=" => 3,"User.id" => $id);
        $user = $this->User->find('first',array('conditions'=>$conditions));
        $test = "OK";
        //ユーザ名から検索
        $this->set(compact('user'));
        $this->set(compact('test'));
    }else{
        $conditions = array("User.status !=" => 3,"User.id" => $id);
        $user = $this->User->find('first',array('conditions'=>$conditions));
        
        //ユーザ名から検索
        $this->set(compact('user'));
		}	
	}
     
    }
    



?>