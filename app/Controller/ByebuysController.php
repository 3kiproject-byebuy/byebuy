<?php

App::uses('AppController', 'Controller');
App::import('Vendor','facebook',array('file' => 'facebook'.DS.'src'.DS.'facebook.php'));
//App::import('vendor', 'facebook/php-sdk/src/facebook');


class ByebuysController extends AppController {

	public $uses = array('Selling_list','User','Group','Watchlist','Category');
	public $helpers = array('Facebook.Facebook');
    public $components = array('Search.Prg');
    public $paginate = array('Selling_list' => array('limit' => 9,
                                                     'order' => array('id' => 'desc'))
                             );


    function beforeFilter() {

    	parent::beforeFilter();
    	$this->Auth->allow();
	}


    public function index($id=null){

    //$this->log('君のためだけのログ', LOG_FOR_YOU);

    //サーチプラグイン
    $this->Prg->commonProcess();

    //商品
    $conditions1 = $this->Selling_list->parseCriteria($this->passedArgs);
    $conditions2 =  array('Selling_list.del_flg' => 0);
    $conditions = array($conditions1,$conditions2);
    $products = $this->paginate('Selling_list',$conditions);

    //ログイン中のユーザーのウォッチリストを取得
    $self = $this->Session->read('Auth.User');
    if(is_null($self)){
    
    }else{

    $conditions3 = array('Watchlist.user_id' => $self['id']);
    $myListItems = $this->Watchlist->find('all',array('conditions' => $conditions3));

    }
    //debug($myListItems);
    

    //カテゴリー
    $categories = $this->Category->find('all');

    //View用の変数としてセット
    $this->set(compact('products','self','categories','myListItems'));

    }


    public function favorite($id=null){
        
       if(isset($this->request->data['Watchlist']['user_id'])){
        
            $this->Watchlist->create();//Wacthlistテーブルにデータを保存

            if($this->Watchlist->save($this->data)){//Watchlistテーブルにデータが入った  

                $this->Session->setFlash(__('お気に入りに登録しました'));
                return $this->redirect(array('controller'=>'watchlists', 'action' => 'index'));

            }

            $this->Session->setFlash(__('お気に入りに登録できませんでした'));
        }

    }


    public function category($category_id=null){

         //サーチプラグイン
        $this->Prg->commonProcess();

        //カテゴリーを取得
        $categories = $this->Category->find('all');

        //現在ログインしているユーザー
        $self = $this->Auth->user();

        $conditions1 = $this->Selling_list->parseCriteria($this->passedArgs);
        debug($conditions1);
        $conditions2 = array('Selling_list.category_id'=>$category_id);
        $conditions3 =  array('Selling_list.del_flg' => 0);
        $conditions = array($conditions1,$conditions2,$conditions3);

        //出品中商品の取得
        $products = $this->paginate('Selling_list',$conditions);

        //ログイン中のユーザーのウォッチリストを取得
        $conditions3 = array('Watchlist.user_id' => $self['id']);
        $myListItems = $this->Watchlist->find('all',array('conditions' => $conditions3));

        $this->set(compact('products','categories','self','myListItems'));

    }


	public function login($id=null) {

        
        /*
        ////////////////////////////////////////////////////////////////////////////
        ログインしてないユーザー self=null  -> index
        ログインしてる承認済みユーザー　self!=null、del_flg==０で、status==1 ->index
        未承認ユーザー　self!=null、del_flg==0、status==３ ->　ログアウト ->　未承認ページ
        ////////////////////////////////////////////////////////////////////////////
        */


        //現在ログインしているユーザー
        //$self = $this->Auth->user();
        $self = $this->Session->read('Auth.User');

        // $this->log('selfはなんだ。', LOG_FOR_YOU);
        // $this->log($self,LOG_FOR_YOU);
        // $this->log('id', LOG_FOR_YOU);
        // $this->log($id,LOG_FOR_YOU);

        //ログインしていないユーザーの場合
        if(is_null($self)){
            
            return $this->redirect($this->referer());


        }else{//ログインしているユーザーの場合

            if($self['del_flg']==0){

                if($self['block_flg']==0){
            
                    if($self['status']==1){//承認済みユーザーの場合

                        return $this->redirect($this->referer());

                    }
                }

                //$this->redirect(array('action'=>'logout'));    
            }

            //$this->redirect(array('action'=>'logout'));    
        }

    }

}



?>