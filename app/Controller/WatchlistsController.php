<?php

class WatchlistsController extends AppController {
    public $helpers = array('Html', 'Form');

    public $components = array('Search.Prg');

    public $uses = array('Watchlist','Byebuy', 'Selling_list', 'Selling_thread_list', 'Category', 'User');
    public $paginate = array('Watchlist' => array(
                                                'limit' => 20,
                                                'recursive' => 2,
                                                'order' => array('id' => 'desc')
                                                )
                                            ); //limitは取得データ数のリミット


    //ログインユーザーに関する宣言
    function beforeFilter() { 
           parent::beforefilter();
            $this->Auth->allow();
            $this->set('user', $this->Auth->user()); //ctpで$userを使えるようにする

         }


	public function index(){

        //カテゴリーデータの取得
        $categories = $this->Category->find('all');


//↓カテゴリー件数表示処理↓ -----------------------------------------------------------------------------------------
        // $index = 0;

        // //それぞれのカテゴリーの数を表示する指定(count関数)
        // foreach ($categories as $category):

        //     $categorycount = $this->Watchlist->find('count', 
        //                                                 array(
        //                                                     'conditions'=>
        //                                                         array('category_id'=>$category['Category']['id'])));
        // $categories[$index]['category']['count'] = $categorycount;

        // $index++;

        // endforeach;

//↑カテゴリー件数表示処理↑ -----------------------------------------------------------------------------------------


        $this->set(compact('categories'));

        //debug($categories);


        //サーチプラグインの設定（Modelでの曖昧検索の設定）
        $this->Prg->commonProcess();

		//recursiveの設定
		//$this->User->recursive = 2;
        $this->Watchlist->parseCriteria($this->passedArgs); //サーチプラグインの条件

        //現在ログインしているユーザー
        $self = $this->Auth->user();        
        $conditions = array(
                        'Watchlist.user_id' =>$self['id'], //今はAuthがきいてないので1に限定している
                        
                        //'recursive' => 2,
                            );

        $watchlists = $this->paginate('Watchlist',$conditions);
        //$user = $this->paginate('User', array('conditions' => $conditions));

        $this->set(compact('watchlists'));

        debug('watchlists');

         }




         //引数としてcategoryidが渡されるファンクション
         public function category_index($category_id=null) {

            //categoriesデータの取得
            $categories = $this->Category->find('all');

            //現在ログインしているユーザー
            $self = $this->Auth->user();     
            $conditions = array(
                                'category_id' => $category_id,
                                'Watchlist.user_id' => $self['id'],
                                );

            $watchlists = $this->paginate('Watchlist', $conditions);

            $this->set(compact('watchlists', 'categories'));

            // debug ($watchlists);
            // debug ($categories);


         }














}

