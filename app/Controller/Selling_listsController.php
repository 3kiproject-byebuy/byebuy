<?php

class Selling_listsController extends AppController {


    public $helpers = array('Html', 'Form');



    public $components = array('Search.Prg');
    public $uses = array('Byebuy', 'Selling_list', 'Selling_thread_list', 'Category', 'User');


    //ログインユーザーに関する宣言
    function beforeFilter() { 
           parent::beforefilter();
            $this->Auth->allow();
            $this->set('user', $this->Auth->user()); //ctpで$userを使えるようにする

         }





//index----------------------------------------------------------------------------------------------------------
    public function index(){


        //debug($_FILES);

    	//カテゴリーデータの取得
    	$categories = $this->Category->find('list', array('fields' => array('category_title')));
    	$this->set(compact('categories'));

        //debug($categories);


        if ($this->request->is('post') || $this->request->is('put')) {

            $file1 = $this->request->data['Selling_list']['img_file_name1']['tmp_name'];
            $file2 = $this->request->data['Selling_list']['img_file_name2']['tmp_name'];
            $file3 = $this->request->data['Selling_list']['img_file_name3']['tmp_name'];
            $tmp1 = $this->request->data['Selling_list']['img_file_name1']['name'];
            $tmp2 = $this->request->data['Selling_list']['img_file_name2']['name'];
            $tmp3 = $this->request->data['Selling_list']['img_file_name3']['name'];


            $uploaddir = APP. 'webroot/img/';
            $uploadfile = $uploaddir.basename($tmp1);
            move_uploaded_file($file1, $uploadfile);

            $uploaddir = APP. 'webroot/img/';
            $uploadfile = $uploaddir.basename($tmp2);
            move_uploaded_file($file2, $uploadfile);


            $uploaddir = APP. 'webroot/img/';
            $uploadfile = $uploaddir.basename($tmp3);
            move_uploaded_file($file3, $uploadfile);



            debug($uploaddir);
            debug($uploadfile);

            
        //コードの説明
            // $uploaddir = APP. 'アップロードしたいディレクトリ';
            // $uploadfile = $uploaddir . basename('アップロードするときのファイル名');
            // move_uploaded_file('一時保存されているアップロードしたいファイル名前', $uploadfile);


            $this->request->data['Selling_list']['img_file_name1'] = $tmp1;
            $this->request->data['Selling_list']['img_file_name2'] = $tmp2;
            $this->request->data['Selling_list']['img_file_name3'] = $tmp3;

            $this->Selling_list->save($this->request->data, array('validate' => false));

            //画像の保存
            if($this->Selling_list->save($this->request->data)){
                $this->log('save成功');
            }else{
                $this->log('save失敗');

            }
        }
    	
    }






//商品詳細
     public function productdetail($id = null) {

        //カテゴリーデータの取得
        $categories = $this->Category->find('list', array('fields' => array('category_title')));
        $this->set(compact('categories'));


    	if(!$id) {
			throw new NotFoundException(_('Invalid post'));
		}

        //del_flgが立っていれば取得データから除外する。 
        //$conditions = array("SellingList.del_flg" => 0); 
        $conditions = array("Selling_list.id" => $id,
                            "Selling_list.del_flg" => 0);

		//$sellinglists = $this->SellingList->findById($id
        $sellinglists = $this->Selling_list->find('all',
                                            //del_flagがたっているものを除外する
                                            array('conditions' => $conditions)
                                                );


    	$this->set(compact('sellinglists'));

        debug($sellinglists);

        //コメント用のデータをviewにおくる
        $sellingthreadlists = $this->Selling_thread_list->find('all');

        $this->set(compact('sellingthreadlists'));



    	if(!$sellinglists) {
			throw new NotFoundException(_('Invalid post'));
		}


    	//商品投稿内容編集用
    	if ($this->request->is(array('post', 'put'))) {
            $this->Selling_list->id = $id;


        //場合分け
        if(isset($this->request->data['Selling_list']['img_file_name1']))
        {
            //----------------------------------------------

            $file1 = $this->request->data['Selling_list']['img_file_name1']['tmp_name'];
            $file2 = $this->request->data['Selling_list']['img_file_name2']['tmp_name'];
            $file3 = $this->request->data['Selling_list']['img_file_name3']['tmp_name'];
            $tmp1 = $this->request->data['Selling_list']['img_file_name1']['name'];
            $tmp2 = $this->request->data['Selling_list']['img_file_name2']['name'];
            $tmp3 = $this->request->data['Selling_list']['img_file_name3']['name'];

            $uploaddir = APP. 'webroot/img/';
            $uploadfile = $uploaddir.basename($tmp1);
            move_uploaded_file($file, $uploadfile);

            $uploaddir = APP. 'webroot/img/';
            $uploadfile = $uploaddir.basename($tmp2);
            move_uploaded_file($file, $uploadfile);

            $uploaddir = APP. 'webroot/img/';
            $uploadfile = $uploaddir.basename($tmp3);
            move_uploaded_file($file, $uploadfile);

            debug($uploaddir);
            debug($uploadfile);

            $this->request->data['Selling_list']['img_file_name1'] = $tmp1;
            $this->request->data['Selling_list']['img_file_name2'] = $tmp2;
            $this->request->data['Selling_list']['img_file_name3'] = $tmp3;

            if($this->Selling_list->save($this->request->data, array('validate' => false)))
            {
                $this->Session->setFlash(__('編集が完了しました'));
                return $this->redirect($this->referer());
            }
            

            //-----------------------------------------------

    	   }

        }//場合分け終了

            //投稿されてないときに、フォームの中にデータを表示している。
            if (!$this->request->data) {
                $this->request->data = $sellinglists;
            }



        //場合分け
        if(isset($this->request->data['Selling_thread_list']['thread']))
        {

            //コメント内容反映
            if ($this->request->is('post')) {
                $this->Selling_thread_list->create();
            if ($this->Selling_thread_list->save($this->request->data)) {
                $this->Session->setFlash(__('<div class="alert alert-success" role="alert">コメントが投稿されました</div>'));
                // return $this->redirect(array('action' => 'productdetail'));
                //元のページへリダイレクト
                return $this->redirect($this->referer());
                }
                $this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Unable to add your post.</div>'));
            }


        } //場合分け終了


    }

//---------------------------------------------------








}





//参考
	// public function view($id = null){
	// 	if(!$id) {
	// 		throw new NotFoundException(_('Invalid post'));
	// 	}

	// 	$post = $this->Post->findById($id);
	// 	if(!$post) {
	// 		throw new NotFoundException(_('Invalid post'));
	// 	}

	// 	// $this ->set('post', $post);
	// 	$this ->set(compact('post'));

	// }


















