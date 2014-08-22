<?php

App::uses('AppController', 'Controller');
//App::import('vendor', 'facebook/php-sdk/src/facebook');


class ByeBuysController extends AppController {

	//User,Gropuモデルを使えるようにするために宣言	//定義済み関数
	public $uses = array('User','Group','Selling_list','Watchlist');
	public $helpers = array('Facebook.Facebook');

    //サーチプラグインが提供しているPRgコンポーネントを使うためにセットしている。
    public $components = array('Search.Prg');
    public $paginate = array('Selling_list' => array('limit' => 9));

	//ログインしなくてもアクセスできるように許可する、なるべく上の方に書いておく。
	//どのファンクションでも、それが呼ばれる前に必ず挙動する。
    function beforeFilter() {
    	parent::beforeFilter();
    	
    	$this->Auth->allow();
	}

    public function index($id=null){//　/index/アドレスに飛んだタイミングで実行され、その結果が.ctpに返る

        $this->Prg->commonProcess();
        $conditions = $this->Selling_list->parseCriteria($this->passedArgs);
        $products = $this->paginate('Selling_list',$conditions);//モデル名、条件式
        //$products = $this->Selling_list->find('all');
       


        $conditions = array('User.id'=>$id,'del_flag !=' => 1); 
        $self = $this->User->find('first',array('conditions'=>$conditions));
        $this->set(compact('self','products'));

     
        //debug($this->request->data);

        $this->_favorite($id=null);


	}

    private function _favorite($id=null){

       if(isset($this->request->data['Watchlist']['user_id'])){


            if ($this->request->is('post')){//post送信されたら

                $this->Watchlist->create();//Wacthlistテーブルにデータを保存

                if($this->Watchlist->save($this->request->data)){//Watchlistテーブルにデータが入った  

                    $this->Session->setFlash(__('お気に入りに登録しました'));
                    return $this->redirect(array('action' => 'index'));
                }
                //saveが失敗したとき用
                $this->Session->setFlash(__('お気に入りに登録できませんでした'));

            }

        }   

    }

	public function login() {

    }

    public function logout() {

    }

}



?>