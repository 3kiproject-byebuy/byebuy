<?php

App::uses('AppController', 'Controller');
//App::import('vendor', 'facebook/php-sdk/src/facebook');


class WantedListsController extends AppController {
    //public $helpers = array('Html', 'Form');//htmlヘルパーを使うよ！という宣言、使うヘルパーの名前を指定
    //今はappControllerでも同様の設定をしているのでコメントアウト

	//モデルを使えるようにするために宣言	//定義済み関数
	public $uses = array('Wanted_list','Wanted_thread_list','User');
	//public $helpers = array('Facebook.Facebook');

	//ログインしなくてもアクセスできるように許可する、なるべく上の方に書いておく。
	//どのファンクションでも、それが呼ばれる前に必ず挙動する。
    function beforeFilter() {
    	parent::beforeFilter();
    	
    	$this->Auth->allow();
	}



	public function index(){//　/index/アドレスに飛んだタイミングで実行され、その結果が.ctpに返る

        $Wanted_lists = $this->Wanted_list->find('all',array(
        											     //'fields' => array('user_id', 'wanteddetail', 'created'),
                                                        'conditions' => array('Wanted_list.del_flg' => 0),
                                                        //'order' => array('created' => 'desc'),
                                                        //'limit' => 1,
                                                        //'group' => array('Model.field'),
                                                        //'page' => n,
                                                        //'offset' => n,
                                                        //'callbacks' => true,
                                                        'recursive' => 2,
                                                        )
                                        );

        
        //'この人に決める'ボタン押下後、スレッドに取引成立相手の名前を表示するためデータを取得
        $Users = $this->User->find('all',array(
                                            'fields' => array('id', 'facebook_id', 'name'),
                                            //'conditions' => array('User.id' => $decide_user_id),
                                            //'order' => array('created' => 'desc'),
                                            //'limit' => 1,
                                            //'group' => array('Model.field'),
                                            //'page' => n,
                                            //'offset' => n,
                                            //'callbacks' => true,
                                            //'recursive' => 0,
                                            )
                                        );

        $this->set(compact('Wanted_lists','Users'));

	}




	public function addWantedList(){

		//isset()で変数が存在しているか（index.ctpから取得できているか）を確認
        if (isset($this->request->data['Wanted_list']['wanteddetail'],$this->request->data['Wanted_list']['user_id'])) {

            debug($this->request->data);
            //createメソッドの作成(データをinsertする際に必要)
            $this->Wanted_list->create();

            //"$this->request->data"の連想配列の保存が成功した場合(save()メソッドは保存が成功するとtrueを返す)
            //if ($this->WantedList->save($this->request->data['WantedList']['wanteddetail'])) {
            if ($this->Wanted_list->save($this->data)) { 
                
                return $this->redirect(array('action' => 'index'));
            }

            //saveが失敗した場合の処理
            $this->Session->setFlash(__('Miss!'));
        }

	}




	public function addComment(){

		//isset()で変数が存在しているか（index.ctpから取得できているか）を確認
        if (isset($this->request->data['Wanted_thread_list']['thread'],$this->request->data['Wanted_thread_list']['user_id'],$this->request->data['Wanted_thread_list']['wantedlist_id'])) {

            debug($this->request->data);
            //createメソッドの作成(データをinsertする際に必要)
            $this->Wanted_thread_list->create();

            //"$this->request->data"の連想配列の保存が成功した場合(save()メソッドは保存が成功するとtrueを返す)
            //if ($this->WantedList->save($this->request->data['WantedList']['wanteddetail'])) {
            if ($this->Wanted_thread_list->save($this->data)) { 
                
                return $this->redirect(array('action' => 'index'));
            }

            //saveが失敗した場合の処理
            $this->Session->setFlash(__('Miss!'));
        }

	}
    




    public function decide(){

        //isset()で変数が存在しているか（index.ctpから取得できているか）を確認
        if (isset($this->request->data['Wanted_list']['tradedate'],$this->request->data['Wanted_list']['status'])) {

            debug($this->request->data);
            //createメソッドの作成(データをinsertする際に必要)
            $this->Wanted_list->create();
            $this->Wanted_list->$wantedList['Wanted_list']['id'];//指定したidのカラムを更新

            //"$this->request->data"の連想配列の保存が成功した場合(save()メソッドは保存が成功するとtrueを返す)
            //if ($this->WantedList->save($this->request->data['WantedList']['wanteddetail'])) {
            if ($this->Wanted_list->save($this->data)) { 
                
                return $this->redirect(array('action' => 'index'));
            }

            //saveが失敗した場合の処理
            $this->Session->setFlash(__('Miss!'));
        }

    }

	




}
?>