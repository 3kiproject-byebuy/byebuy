<?php
 
//【1】facebook認証
App::import('Vendor','facebook',array('file' => 'facebook'.DS.'src'.DS.'facebook.php'));



?>


<?php 

class FbconnectsController extends AppController {

    public $name = 'Fbconnects';
    public $uses = array('User');
    public $components = array('Search.Prg');


    private function createFacebook() {        //【8】appID, secretを記述
        return new Facebook(array(
            'appId' => '279683735571945',
            'secret' => '97c9737e7de0176fe6c7737ac4535ddc',
            'cookie' => true
        ));
    }

    public function facebook(){

        $this->autoRender = false;
        $this->facebook = $this->createFacebook();
        $user = $this->facebook->getUser();       //【4】ユーザ情報取得
        debug($user);

        if($user){  //ログインしてたら 
            
            $conditions = array('facebook_id'=>$user); //DBにユーザーのfacebook_idがあるかどうか。
            $self = $this->User->find('first',array('conditions'=>$conditions));//Userテーブルからconditionsを元に取得したデータ

            debug($self);
            
            
            if(isset($self['User'])){//DBにfacebook_idがあったら
                debug('データベースにfacebook_idがある！');
                debug($self);
                $self['User']['password'] = $self['User']['facebook_id'];//ハッシュ化されてるpassを元に戻す
                $id = $self['User']['id'];


                if($this->Auth->login($self['User'])){//オースでログイン

                    debug('$User>fbidあり>オースログイン');
               
                        $this->redirect(array('controller'=>'Byebuys','action'=>'index',$id));


                }else{

                    debug('$User>fbidあり>オースログイン不可');
                    //$this->redirect(array('controller'=>'Byebuys','action'=>'index'));

                }

            }else{//DBにデータがなかったら
                debug('データベースにfacebook_idがない！');
                //-------------ログインしたユーザーのデータをUserに保存。------------------------//
                
                $me = $this->facebook->api('/me','GET',array('locale'=>'ja_JP'));  //【5】ユーザ情報を日本語で取得
                $this->Session->write('mydata',$me);      //【6】ユーザ情報をセッションに保存
                $myFbData = $this->Session->read('mydata');       //【3】facebookのデータ
                debug($myFbData);

                //$myFbDataをsaveファンクションに適した形にする。親配列にモデル名をつけてネスト。
                $self['User'] = $myFbData;
                $self['User']['facebook_id'] = $myFbData['id'];
                $self['User']['id'] = null;
                $self['User']['password'] = $myFbData['id'];
                $self['User']['group_id'] = 2;
                $self['User']['status'] = 3;

                $this->Session->write('self',$self);      //【6】ユーザ情報をセッションに保存
                
                //$this->set('fbData', $fbData); 

                //データーベースに保存
                $this->User->create(); 

                if ($this->User->save($self)) { //データがDBに保存できたら

                    //debug('$User>fbidない>保存');
                    $self['User']['id'] = $this->User->getLastInsertID();//セーブした最新のidが取れる
                    $id=$self['User']['id'];

                    if($this->Auth->login($self['User'])){//オースでログインできたら

                        $this->redirect(array('controller'=>'byebuys','action' => 'index',$id));
                         //debug('$User>fbidない>保存>オースでログイン');

                    }else{//オースでログインできなかったら

                         debug('$User>fbidない>保存>オースでログイン不可');
                    }

                }else{  //データがDBに保存できなかったら  

                    debug('$User>fbidない>保存できない');
                }
                
            
            }



        }else{//初回の認証、もしくは認証失敗 

            debug('$userない');
            $params = array(
                         'scope' => 'public_profile',
                         'redirect_uri' => 'http://dev.byebuy.com/ByeBuy/fbconnects/facebook'
                    );
            $loginUrl = $this->facebook->getLoginUrl($params); 
            $this->redirect($loginUrl);
        
        
        }


    }


    function index(){
 
    }
 
    function showdata(){//トップページ


        $params = array(
            'fields' => array('Profile.user_id','Profile.username','Profile.occupation','Profile.generation','Profile.gender','User.facebook_id','User.name'));
        $profiles = $this->User->find('all',$params);

        $current_user =$this->Auth->user();//現在ログインしているユーザidを取得
        //debug($current_user);
        //$conditions = array('User.id' => $current_user['User']['id']);
        //$self = $this->User->find('first',array('conditions'=>$conditions));//Userから現在ログインしているユーザーのデータを取得
        $id = $current_user['id'];
        // debug($id);
        $conditions = array('User.id'=>$id);
        $self = $this->User->find('first',array('conditions' => $conditions));

        debug($self);

        $this->set(compact('profiles','id','self'));
    }


    public function first_config($id=null){

        if (!$id) {

            throw new NotFoundException(__('Invalid post'));
        }

        $current_user =$this->Auth->user();//現在ログインしているユーザidを取得
        debug($current_user);
        $conditions = array('User.id' => $current_user['id']);
        $self = $this->User->find('first',array('conditions'=>$conditions));//Userから現在ログインしているユーザーのデータを取得
        $this->set(compact('self')); 
        debug($self);

        if ($this->request->is('post')){//post送信されたら

                $this->Profile->create();//Profileテーブルにデータを保存

                if($this->Profile->save($this->request->data)){//Profileテーブルにデータが入った  

                    //$this->Session->setFlash(__('Your post has been saved.'));
                    return $this->redirect(array('action' => 'showdata'));
            }
                //saveが失敗したとき用
                //$this->Session->setFlash(__('Unable to add your post.'));

            }
       
       //$this->redirect(array('action' => 'config',$user_id));
    }
        
    

    public function config($id=null){

        $conditions = array('Profile.user_id'=>$id);
        $profile = $this->Profile->find('first',array('conditions'=>$conditions));
        $this->set(compact('profile'));


        if ($this->request->is(array('post', 'put'))) {

            $this->Profile->id = $profile['Profile']['id']; 

            if ($this->Profile->save($this->request->data)) {
                //$this->Session->setFlash(__('Your post has been updated.'));
                //return $this->redirect(array('action' => 'showdata'));
            }
       
            //$this->Session->setFlash(__('Unable to update your post.'));
        }

    
        if (!$this->request->data) {//postで送られて来たデータがなんにも無い場合
                $this->request->data = $profile;
        }


    }

    public function mypage($id=null){

        $this->set(compact('id'));

        if (!$id) {

            throw new NotFoundException(__('Invalid Accsess'));
        }


        if ($this->request->is('post')){//post送信されたら

            $this->Wishlist->create();//Profileテーブルにデータを保存

            if($this->Wishlist->save($this->request->data)){//Profileテーブルにデータが入った  

                //$this->Session->setFlash(__('Your post has been saved.'));
                //return $this->redirect(array('action' => 'index'));
            }
        //saveが失敗したとき用
            //$this->Session->setFlash(__('Unable to add your post.'));

            }

        $conditions = array('Wishlist.user_id'=>$id);
        $mylists = $this->Wishlist->find('all',array('conditions'=>$conditions));
        $conditions = array('Profile.user_id'=>$id);
        $profile = $this->Profile->find('first',array('conditions'=>$conditions));

        $listcount = $this->_get_categories_append_count();

        $this->set(compact('mylists','profile','listcount'));

   

    }

    public function view($id=null){

        if (!$id) {

            throw new NotFoundException(__('Invalid Accsess'));
        }


        $conditions = array('Wishlist.user_id'=>$id);
        $mylists = $this->Wishlist->find('all',array('conditions'=>$conditions));
        $conditions = array('Profile.user_id'=>$id);
        $profile = $this->Profile->find('first',array('conditions'=>$conditions));

        $this->set(compact('mylists','profile'));

    }

    public function delete($id) {
        if ($this->request->is('get')) {

            throw new MethodNotAllowedException();
        }

        $current_user = $this->Auth->user();
        $user_id = $current_user['id'];


        if ($this->Wishlist->delete($id)) {//デリート文の発行
         $this->redirect(array('action' => 'mypage',$user_id));
        }
    }

    public function delete_user($id) {
    if ($this->request->is('get')) {

        throw new MethodNotAllowedException();
        }

    $conditions = array('Profile.user_id'=>$id);
    $current_user = $this->User->find('first',array('conditions'=>$conditions));
    $profile_id = $current_user['Profile']['id'];
    // debug($profile_id);
    // debug($current_user);

    $this->User->delete($id);
    $this->Profile->delete($profile_id);
    $this->redirect(array('controller'=>'users','action' => 'login'));
        

    }   

    public function logout(){

    $facebook = new Facebook(array(
    // 'appid'  => Configure::read("facebook.appid"),
    // 'secret' => Configure::read("facebook.appsecret"),
    'appId' => '279683735571945',
    'secret' => '97c9737e7de0176fe6c7737ac4535ddc',

    ));
    //$params = array( 'next' => 'http://geechscamp.lolipop.jp/wannadoList/');
    $logoutUrl = $facebook->getLogoutUrl();
    $facebook->destroySession();

    if($this->Auth->logout()){
        debug('オースログアウト');

        if($this->Session->delete('User')===true){
        $this->Session->setFlash(__('セッションの破棄'));
        }else{ 
            debug('破棄できない');
        }
        
    $this->Session->setFlash(__('ログアウトしました'));

    }

  
    //debug($logoutUrl);
    $this->redirect('/byebuys/index/');

    } 

    private function _get_categories_append_count() {

   
        $lists = $this->Wishlist->find('all');
        $ids = $this->Auth->user();
        $id = $ids['id'];

        $index = 0;
        foreach ($lists as $list) {
            //countのSQL文を発行し、その実行結果がpostcountに返る。第二引数に条件が入る。
            $listcount = $this->Wishlist->find('count',array('conditions'=>array('user_id'=>$id)));
            //$categoriesの連想配列にもう一つカウント用のカラム（？）値を持たせてあげる。
            $lists[$index]['Wishlist']['count'] = $listcount;
            $index ++;

        }

        return $listcount;
      
    }



}
