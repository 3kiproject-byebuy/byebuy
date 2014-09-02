<?php

App::uses('AppController', 'Controller');
//App::import('vendor', 'facebook/php-sdk/src/facebook');


class ManagementsController extends AppController {
    //public $helpers = array('Html', 'Form');//htmlヘルパーを使うよ！という宣言、使うヘルパーの名前を指定
    //今はappControllerでも同様の設定をしているのでコメントアウト

	//User,Gropuモデルを使えるようにするために宣言	//定義済み関数
	public $uses = array('User','Category','Selling_list','Selling_thread_list','Wanted_list','Wanted_thread_list');
	public $helpers = array('Facebook.Facebook','Html');

	//ログインしなくてもアクセスできるように許可する、なるべく上の方に書いておく。
	//どのファンクションでも、それが呼ばれる前に必ず挙動する。
    function beforeFilter() {
    	parent::beforeFilter();    	
    	$this->Auth->allow();
	}

    public function index(){//　/index/アドレスに飛んだタイミングで実行され、その結果が.ctpに返る

        if(isset($this->request->data['Search']['name'])){

            $name = $this->request->data['Search']['name'];
            $conditions = array('User.name LIKE' => "%$name%","User.status !=" => "3");
            $users = $this->User->find('all',array('conditions'=>$conditions));
        
        }else{
        
            $conditions = array("User.status !=" => 3);
            $users = $this->User->find('all',array('conditions'=>$conditions));
        
        }

        //ユーザ名から検索
        $this->set(compact('users'));

	}

    public function lock_unlock($id) {
        
        if ($this->request->is('post')) {//このpostはpost送信のpost。post送信されたら
            
            $conditions = array('User.id' => $id);
            $user = $this->User->find('first',array('conditions'=>$conditions));

            if(!$user['User']['block_flg']){
            // ロックする。
            $data = array('User' => array('id' => $id, 'block_flg' => 1));
            }else{
            // ロック解除する
            $data = array('User' => array('id' => $id, 'block_flg' => 0));
            }

            // 更新する項目（フィールド指定）
            $fields = array('block_flg');
            // 更新
            if ($this->User->save($data, false, $fields)) {
            
                $this->Session->setFlash(__('block_flg has been changed.'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    //強制退会処理
    public function withdrawal($id) {
        
        if ($this->request->is('post')) {//このpostはpost送信のpost。post送信されたら
            
            $conditions = array('User.id' => $id);
            $user = $this->User->find('first',array('conditions'=>$conditions));

            if(!$user['User']['del_flg']){
            // 強制退会させる。
            $data = array('User' => array('id' => $id, 'del_flg' => 1));
            }else{
            // 取り消しする。
            $data = array('User' => array('id' => $id, 'del_flg' => 0));
            }

            // 更新する項目（フィールド指定）
            $fields = array('del_flg');
            // 更新
            if ($this->User->save($data, false, $fields)) {
            
                $this->Session->setFlash(__('del_flg has been changed.'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    //権限付与
    public function give_authority($id,$authority) {
        
        if ($this->request->is('post')) {//このpostはpost送信のpost。post送信されたら
            
            $conditions = array('User.id' => $id);
            $user = $this->User->find('first',array('conditions'=>$conditions));

            $data = array('User' => array('id' => $id, 'group_id' => $authority));

            // 更新する項目（フィールド指定）
            $fields = array('group_id');
            // 更新
            if ($this->User->save($data, false, $fields)) {
            
                $this->Session->setFlash(__('authority has been changed.'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

  
        



        public function agreement() {

        $conditions = array('User.status' => "3");
        $users = $this->User->find('all',array('conditions'=>$conditions));
        //ユーザ名から検索
        $this->set(compact('users'));
        }

        //承認,非承認処理
        public function approval($id) {

        if ($this->request->is('post')) {//このpostはpost送信のpost。post送信されたら
            
            $conditions = array('User.id' => $id);
            $user = $this->User->find('first',array('conditions'=>$conditions));
            $data = array('User' => array('id' => $id, 'status' => '1'));
            

            // 更新する項目（フィールド指定）
            $fields = array('status');
            // 更新
            if ($this->User->save($data, false, $fields)) {
            
                $this->Session->setFlash(__('status has been changed.'));
                return $this->redirect(array('action' => 'agreement'));
            }
        }

        }

        //非承認処理
        public function unapproval($id) {
        if ($this->request->is('get')) {// get送信（リンク直打ち）で来た場合
            //post送信はサーバーにデータを暗号化して送ってくる
            //get送信はURLの後ろに文字をくっつけて直接データを送る

            throw new MethodNotAllowedException();
        }

        if ($this->User->delete($id)) {//デリート文の発行
            $this->Session->setFlash(__('The User with id: %s has been deleted.', h($id)));
            return $this->redirect(array('action' => 'agreement'));
        }

    }

        public function edit_categories() {

        //$conditions = array("status !=" => 3);
        $categories = $this->Category->find('all');
        $this->set(compact('categories'));

        }

        public function delete_categories($id) {

        if ($this->request->is('post')) {//このpostはpost送信のpost。post送信されたら
            
            $conditions = array('Category.id' => $id);
            $category = $this->Category->find('first',array('conditions'=>$conditions));

            if(!$category['Category']['del_flg']){
            // 強制退会させる。
            $data = array('Category' => array('id' => $id, 'del_flg' => 1));
            }else{
            // 取り消しする。
            $data = array('Category' => array('id' => $id, 'del_flg' => 0));
            }

            // 更新する項目（フィールド指定）
            $fields = array('del_flg');
            // 更新
            if ($this->Category->save($data, false, $fields)) {
            
                $this->Session->setFlash(__('del_flg has been changed.'));
                return $this->redirect(array('action' => 'edit_categories'));
            }
        }

        }

        public function edit_categories_mod($id) {


        $conditions = array('Category.id' => $id);
        $category = $this->Category->find('first',array('conditions'=>$conditions));
        $this->set(compact('category'));

        if ($this->request->is('post') && isset($this->request->data['Mod']['category_title'])){
            
            $name = $this->request->data['Mod']['category_title'];
            $data = array('Category' => array('id' => $id, 'category_title' => $name));
            // 更新する項目（フィールド指定）
            $fields = array('category_title');
            // 更新
            if ($this->Category->save($data, false, $fields)) {
            
                $this->Session->setFlash(__('category_title has been changed.'));
                return $this->redirect(array('action' => 'edit_categories'));
            }

        }
            
        }

        public function edit_categories_add() {
                    
        }

        public function edit_categories_add_submit() {
        
        if ($this->request->is('post')){//このpostはpost送信のpost。post送信されたら
            
            //$this->Category->create(); //データーを新たにインサートするときに必要なコード
            $data = array('category_title' => $this->request->data['managements']['category_title']);
            if ($this->Category->save($data)//成功したらtrueが返るので条件式に使える
                ) {
            
                $this->Session->setFlash(__('Your Category has been saved.'));
                return $this->redirect(array('action' => 'edit_categories'));
            }

            //saveが失敗したとき用
            $this->Session->setFlash(__('Unable to add your Category.'));
            
        }
            
        }

  
        public function selling_lists() {

        if(isset($this->request->data['Search']['name'])){
            
            $name = $this->request->data['Search']['name'];
            $conditions = array('Selling_list.sellingproduct_name LIKE' => "%$name%");
            $selling_lists = $this->Selling_list->find('all',array('conditions'=>$conditions));
            $this->set(compact('selling_lists'));
        
        }else{

            $selling_lists = $this->Selling_list->find('all');
            $this->set(compact('selling_lists'));

        }


        }

        public function selling_lists_threads($id) {

        $conditions = array('Selling_thread_list.sellinglist_id' => $id);
        $selling_thread_lists = $this->Selling_thread_list->find('all',array('conditions'=>$conditions));
        $this->set(compact('selling_thread_lists'));

        }

            //強制退会処理
        public function del_selling_lists($id) {
        
        if ($this->request->is('post')) {//このpostはpost送信のpost。post送信されたら
            
            
            $conditions = array('Selling_list.id' => $id);
            $selling_list = $this->Selling_list->find('first',array('conditions'=>$conditions));

            if(!$selling_list['Selling_list']['del_flg']){
            // 強制退会させる。
            $data = array('Selling_list' => array('id' => $id, 'del_flg' => 1));
            }else{
            // 取り消しする。
            $data = array('Selling_list' => array('id' => $id, 'del_flg' => 0));
            }

            // 更新する項目（フィールド指定）
            $fields = array('del_flg');
            // 更新
            if ($this->Selling_list->save($data, false, $fields)) {
            
                $this->Session->setFlash(__('del_flg has been changed.'));
                return $this->redirect(array('action' => 'selling_lists'));
            }
            
        }
        //return $this->redirect(array('action' => 'selling_lists'));

        }

        public function del_wanted_lists($id) {
        
        if ($this->request->is('post')) {//このpostはpost送信のpost。post送信されたら
            
            $conditions = array('Wanted_list.id' => $id);
            $wanted_list = $this->Wanted_list->find('first',array('conditions'=>$conditions));

            if(!$wanted_list['Wanted_list']['del_flg']){
            // 強制退会させる。
            $data = array('Wanted_list' => array('id' => $id, 'del_flg' => 1));
            }else{
            // 取り消しする。
            $data = array('Wanted_list' => array('id' => $id, 'del_flg' => 0));
            }

            // 更新する項目（フィールド指定）
            $fields = array('del_flg');
            // 更新
            if ($this->Wanted_list->save($data, false, $fields)) {
            
                $this->Session->setFlash(__('del_flg has been changed.'));
                return $this->redirect(array('action' => 'wanted_lists'));
            }
        }

        }



        public function wanted_lists() {

        if(isset($this->request->data['Search']['name'])){
            
            $name = $this->request->data['Search']['name'];
            $conditions = array('Wanted_list.wanteddetail LIKE' => "%$name%");
            $wanted_lists = $this->Wanted_list->find('all',array('conditions'=>$conditions));
            $this->set(compact('wanted_lists'));
        
        }else{

            $wanted_lists = $this->Wanted_list->find('all');
            $this->set(compact('wanted_lists'));

        }


        }

        public function wanted_lists_threads($id) {

        $conditions = array('wantedlist_id' => $id);
        $wanted_thread_lists = $this->Wanted_thread_list->find('all',array('conditions'=>$conditions));
        $this->set(compact('wanted_thread_lists'));
        
        }



        
    }
    



?>