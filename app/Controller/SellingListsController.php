<?php

class SellingListsController extends AppController {


    public $helpers = array('Html', 'Form');

    public $components = array('Search.Prg');
    public $uses = array('Selling_list', 'Selling_thread_list', 'Category', 'User');


  //未ログインユーザーも商品詳細が見れるようにする
 function beforeFilter() { 
   parent::beforefilter();
   $this->Auth->allow('productdetail');
}



//index----------------------------------------------------------------------------------------------------------
    public function index(){
    
        //ログインユーザー情報を送る
        $self = $this->Auth->user();
        $this->set(compact('self'));

        //debug($_FILES);

    	//カテゴリーデータの取得
    	$categories = $this->Category->find('list', array('fields' => array('category_title')));
    	$this->set(compact('categories'));

        //debug($categories);

        if ($this->request->is('post') || $this->request->is('put')) {

        $this->Selling_list->create();

        if ($this->request->data['Selling_list']['img_file_name1'] != NULL
         // isset($this->request->data['Selling_list']['img_file_name1'])
         //|| !empty($this->request->data['Selling_list']['img_file_name1']) || $this->request->data['Selling_list']['img_file_name1'] != '' || $this->request->data['Selling_list']['img_file_name1'] != NULL
          )
        {

            $file1 = $this->request->data['Selling_list']['img_file_name1']['tmp_name'];
            $tmp1 = $this->request->data['Selling_list']['img_file_name1']['name'];


            $uploaddir = APP. 'webroot/img/';
            list($file_name,$file_type) = explode(".",$tmp1);
            $dateformat= date("Ymdhis");
            $uploadfile1 = $uploaddir."01"."$dateformat.$file_type"; 
            move_uploaded_file($file1, $uploadfile1);

            $this->request->data['Selling_list']['img_file_name1'] = "01$dateformat.$file_type";

          }


        if ($this->request->data['Selling_list']['img_file_name2'] != NULL
         // isset($this->request->data['Selling_list']['img_file_name2'])
         //|| !empty($this->request->data['Selling_list']['img_file_name2']) || $this->request->data['Selling_list']['img_file_name2'] != '' || $this->request->data['Selling_list']['img_file_name2'] != NULL
          )
        {

            $file2 = $this->request->data['Selling_list']['img_file_name2']['tmp_name'];
            $tmp2 = $this->request->data['Selling_list']['img_file_name2']['name'];

            $uploaddir = APP. 'webroot/img/';
            // list($file_name,$file_type) = explode(".",$tmp2);
            // $dateformat=date("Ymdhis");
            $uploadfile2 = $uploaddir."02"."$dateformat.$file_type"; 
            move_uploaded_file($file2, $uploadfile2);

            $this->request->data['Selling_list']['img_file_name2'] = "02$dateformat.$file_type";

          }


        if ($this->request->data['Selling_list']['img_file_name3'] != NULL
         // isset($this->request->data['Selling_list']['img_file_name3'])
         //|| !empty($this->request->data['Selling_list']['img_file_name3']) || $this->request->data['Selling_list']['img_file_name3'] != '' || $this->request->data['Selling_list']['img_file_name3'] != NULL
         )
        {

            $file3 = $this->request->data['Selling_list']['img_file_name3']['tmp_name'];
            $tmp3 = $this->request->data['Selling_list']['img_file_name3']['name'];

            $uploaddir = APP. 'webroot/img/';
            // list($file_name,$file_type) = explode(".",$tmp3);
            // $dateformat=date("Ymdhis");
            $uploadfile3 = $uploaddir."03"."$dateformat.$file_type"; 
            move_uploaded_file($file3, $uploadfile3);

            $this->request->data['Selling_list']['img_file_name3'] = "03$dateformat.$file_type";

          }

            //debug($this->request->data);


            if($this->Selling_list->save($this->request->data, array('validate' => false))) {
            $this->Session->setFlash(__('<div class="alert alert-success" role="alert">商品を投稿しました</div>'));
            return $this->redirect(array('controller' => 'byebuys','action' => 'index'));

            //debug($this->request->data);
          }
          else{
            $this->Session->setFlash(__('<div class="alert alert-success" role="alert">商品の投稿に失敗しました</div>'));

          }

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

        //ログインユーザー情報を送る
        $self = $this->Auth->user();
        $this->set(compact('self'));

        //debug($self['id']);

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
        //編集ようにフォームに既存のデータを表示させる
        $this->request->data = $sellinglists[0];

    	$this->set(compact('sellinglists'));

        //debug($sellinglists);

        //コメント用のデータをviewにおくる
        $sellingthreadlists = $this->Selling_thread_list->find('all');

        $this->set(compact('sellingthreadlists'));



    	if(!$sellinglists) {
			throw new NotFoundException(_('Invalid post'));
		}

}

//---------------------------------------------------


    public function decide(){

        //isset()で変数が存在しているか（index.ctpから取得できているか）を確認
        if (isset($this->request->data['Selling_list']['trade_person_use_id'])) {
        //if ($this->request->is('post') || $this->request->is('put')) {

            //debug($this->request->data);
            //createメソッドの作成
            $this->Selling_list->create();

            if ($this->Selling_list->save($this->data, array('validate' => false))){
                $this->Session->setFlash(__('<div class="alert alert-success" role="alert">取引相手を決定しました</div>'));
                return $this->redirect($this->referer());
            }

            //saveが失敗した場合の処理
            $this->Session->setFlash(__('エラーが発生しました。再度やりなおしてください'));
      }

    }





    //---------------------------------------------------------


  public function putcomment() {

        //isset()で変数が存在しているか（index.ctpから取得できているか）を確認
        // if (isset($this->request->data['Selling_thread_list']['id'])) {
     if ($this->request->is('post') || $this->request->is('put')) {

            //debug($this->request->data);
            //createメソッドの作成
            $this->Selling_thread_list->create();

            // $this->Wanted_list->create();
            // $this->Wanted_list->$wantedList['Wanted_list']['id'];//指定したidのカラムを更新


            if ($this->Selling_thread_list->save($this->data)) { 
                $this->Session->setFlash(__('<div class="alert alert-success" role="alert">コメントを投稿しました</div>'));
                return $this->redirect($this->referer());
            }

            //saveが失敗した場合の処理
            $this->Session->setFlash(__('コメント投稿に失敗しました'));
        }

    }













    public function edit(){


            //商品投稿内容編集用
        if ($this->request->is(array('post', 'put'))) {
            // $this->Selling_list->id = $id;

        $this->Selling_list->create();


        //場合分け
        if(isset($this->request->data['Selling_list']))
        {
            //----------------------------------------------

        if (
        //  isset($this->request->data['Selling_list']['img_file_name1'])
          !empty($this->request->data['Selling_list']['img_file_name1']) || $this->request->data['Selling_list']['img_file_name1'] != '' || $this->request->data['Selling_list']['img_file_name1'] != NULL
          )
         
          {
            // $file1 = $this->request->data['Selling_list']['img_file_name1']['tmp_name'];
            // $tmp1 = $this->request->data['Selling_list']['img_file_name1']['name'];

            // $uploaddir = APP. 'webroot/img/';
            // $uploadfile = $uploaddir.basename($tmp1);
            // move_uploaded_file($file1, $uploadfile);

            // $this->request->data['Selling_list']['img_file_name1'] = $tmp1;

            $file1 = $this->request->data['Selling_list']['img_file_name1']['tmp_name'];
            $tmp1 = $this->request->data['Selling_list']['img_file_name1']['name'];


            $uploaddir = APP. 'webroot/img/';
            list($file_name,$file_type) = explode(".",$tmp1);
            $dateformat= date("Ymdhis");
            $uploadfile1 = $uploaddir."01"."$dateformat.$file_type"; 
            move_uploaded_file($file1, $uploadfile1);

            $this->request->data['Selling_list']['img_file_name1'] = "01$dateformat.$file_type";


        }

        //debug($this->request->data['Selling_list']['img_file_name1']);

        if(isset($this->request->data['Selling_list']['img_file_name2']) || !empty($this->request->data['Selling_list']['img_file_name2']) || $this->request->data['Selling_list']['img_file_name2'] != '' || $this->request->data['Selling_list']['img_file_name2'] != NULL)
          {
            // $file2 = $this->request->data['Selling_list']['img_file_name2']['tmp_name'];
            // $tmp2 = $this->request->data['Selling_list']['img_file_name2']['name'];

            // $uploaddir = APP. 'webroot/img/';
            // $uploadfile = $uploaddir.basename($tmp2);
            // move_uploaded_file($file2, $uploadfile);

            // $this->request->data['Selling_list']['img_file_name2'] = $tmp2;

            $file2 = $this->request->data['Selling_list']['img_file_name2']['tmp_name'];
            $tmp2 = $this->request->data['Selling_list']['img_file_name2']['name'];

            $uploaddir = APP. 'webroot/img/';
            // list($file_name,$file_type) = explode(".",$tmp2);
            // $dateformat=date("Ymdhis");
            $uploadfile2 = $uploaddir."02"."$dateformat.$file_type"; 
            move_uploaded_file($file2, $uploadfile2);

            $this->request->data['Selling_list']['img_file_name2'] = "02$dateformat.$file_type";


        }

        if(!empty($this->request->data['Selling_list']['img_file_name3']) || $this->request->data['Selling_list']['img_file_name3'] != '' || $this->request->data['Selling_list']['img_file_name3'] != NULL)
          {
            // $file3 = $this->request->data['Selling_list']['img_file_name3']['tmp_name'];
            // $tmp3 = $this->request->data['Selling_list']['img_file_name3']['name'];

            // $uploaddir = APP. 'webroot/img/';
            // $uploadfile = $uploaddir.basename($tmp3);
            // move_uploaded_file($file3, $uploadfile);

            // $this->request->data['Selling_list']['img_file_name3'] = $tmp3;

            $file3 = $this->request->data['Selling_list']['img_file_name3']['tmp_name'];
            $tmp3 = $this->request->data['Selling_list']['img_file_name3']['name'];

            $uploaddir = APP. 'webroot/img/';
            // list($file_name,$file_type) = explode(".",$tmp3);
            // $dateformat=date("Ymdhis");
            $uploadfile3 = $uploaddir."03"."$dateformat.$file_type"; 
            move_uploaded_file($file3, $uploadfile3);

            $this->request->data['Selling_list']['img_file_name3'] = "03$dateformat.$file_type";
        }
                    
            //debug($uploaddir);
            //debug($uploadfile);

            if ($this->Selling_list->save($this->data, array('validate' => false)))
            //if($this->Selling_list->save($this->request->data, array('validate' => false)))
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


}

















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



















