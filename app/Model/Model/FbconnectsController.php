<?php
 
//【1】facebook認証
App::import('Vendor','facebook',array('file' => 'facebook'.DS.'src'.DS.'facebook.php'));



?>


<?php 

class FbconnectsController extends AppController {

    public $name = 'Fbconnects';
    public $uses = array('User','Profile','List');


    private function createFacebook() {        //【8】appID, secretを記述
        return new Facebook(array(
            'appId' => '683046568436496',
            'secret' => '458b2dc67189dbf4ab1791e9d2ec17e9',
            'cookie' => true
        ));
    }

    public function facebook(){

        $this->autoRender = false;
        $this->facebook = $this->createFacebook();
        $user = $this->facebook->getUser();       //【4】ユーザ情報取得

        if($user){  //ログインしてたら 

            $conditions = array('facebook_id'=>$user); //DBにユーザーのfacebook_idがあるかどうか。
            $self = $this->User->find('first',array('conditions'=>$conditions));//Userテーブルからconditionsを元に取得したデータ
            
            if(isset($self['User'])){//DBにfacebook_idがあったら
                debug('データベースにfacebook_idがある！');
                //debug($self);
                $self['User']['password'] = $self['User']['facebook_id'];//ハッシュ化されてるpassを元に戻す
                $id = $self['User']['id'];

                if($this->Auth->login($self)){//オースでログイン

                    //debug('$User>fbidあり>オースログイン');
                    $conditions = array('Profile.user_id'=>$id); //DBにユーザーのfacebook_idがあるかどうか。
                    $profile = $this->Profile->find('first',array('conditions'=>$conditions));//Profileテーブルからconditionsを元に取得したデータ
            
                    if($profile){//profileテーブルにデータがあったら

                        //debug($profile);
                        //debug('profileあり');
                        $this->redirect('showdata');

                    }else{//なかったら
                        //debug($profile);
                        //debug('profileなし');
                        $this->redirect(array('action' => 'first_config', $id));
                    }
                    

                }else{

                    debug('$User>fbidあり>オースログイン不可');
                    //$this->redirect('index');
                }

            }else{//DBにデータがなかったら
                debug('データベースにfacebook_idがない！');
                //-------------ログインしたユーザーのデータをUserに保存。------------------------//

                $me = $this->facebook->api('/me','GET',array('locale'=>'ja_JP'));  //【5】ユーザ情報を日本語で取得
                $this->Session->write('mydata',$me);      //【6】ユーザ情報をセッションに保存
                $myFbData = $this->Session->read('mydata');       //【3】facebookのデータ

                //$myFbDataをsaveファンクションに適した形にする。親配列にモデル名をつけてネスト。
                $fbData['User'] = $myFbData;
                $fbData['User']['facebook_id'] = $myFbData['id'];
                $fbData['User']['id'] = null;
                $fbData['User']['password'] = $myFbData['id'];
                $fbData['User']['group_id'] = 8;
                $this->set('fbData', $fbData); 

                //データーベースに保存
                $this->User->create(); 

                if ($this->User->save($fbData)) { //データがDBに保存できたら

                    debug('$User>fbidない>保存');
                    $fbData['User']['id'] = $this->User->getLastInsertID();//セーブした最新のidが取れる

                    if($this->Auth->login($fbData['User'])){//オースでログインできたら

                        //$this->redirect('first_config');
                         debug('$User>fbidない>保存>オースでログイン');

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
                         'redirect_uri' => 'http://geechscamp.lovepop.jp/wannadoList/fbconnects/facebook/'
                    );
            $loginUrl = $this->facebook->getLoginUrl($params); 
            $this->redirect($loginUrl);
        
        }
    }


    function index(){
 
    }
 
    function showdata(){//トップページ


        debug($this->User->find('all'));
        $params = array(
            'fields' => array('Profile.user_id','Profile.username','Profile.occupation','Profile.generation','Profile.gender','User.facebook_id'));
        $profiles = $this->User->find('all',$params);

        $current_user =$this->Auth->user();//現在ログインしているユーザidを取得
        debug($current_user);
        //$conditions = array('User.id' => $current_user['User']['id']);
        //$self = $this->User->find('first',array('conditions'=>$conditions));//Userから現在ログインしているユーザーのデータを取得
        $id = $current_user['User']['id'];
        debug($id);
        $this->set(compact('profiles','id'));
    }


    public function first_config($id=null){

        if (!$id) {

            throw new NotFoundException(__('Invalid post'));
        }
        
        $current_user =$this->Auth->user();//現在ログインしているユーザidを取得
        debug($current_user);
        $conditions = array('User.id' => $current_user['User']['id']);
        $self = $this->User->find('first',array('conditions'=>$conditions));//Userから現在ログインしているユーザーのデータを取得
        $this->set(compact('self')); 
        debug($self);

        if ($this->request->is('post')){//post送信されたら

            $this->Profile->create();//Profileテーブルにデータを保存

            if($this->Profile->save($this->request->data)){//Profileテーブルにデータが入った  

                $this->Session->setFlash(__('Your post has been saved.'));
                //return $this->redirect(array('action' => 'index'));
            }
        //saveが失敗したとき用
            $this->Session->setFlash(__('Unable to add your post.'));

            }
    }

    public function mypage($id=null){

        $this->set(compact('id'));

        if (!$id) {

            throw new NotFoundException(__('Invalid post'));
        }



        if ($this->request->is('post')){//post送信されたら

            $this->W_list->create();//Profileテーブルにデータを保存

            if($this->W_list->save($this->request->data)){//Profileテーブルにデータが入った  

                $this->Session->setFlash(__('Your post has been saved.'));
                //return $this->redirect(array('action' => 'index'));
            }
        //saveが失敗したとき用
            $this->Session->setFlash(__('Unable to add your post.'));

            }

    }

    public function logout(){

        $facebook = new Facebook(array(
        'appid'  => Configure::read("facebook.appid"),
        'secret' => Configure::read("facebook.appsecret"),
        ));
        $params = array( 'redirect_uri' => 'http://geechscamp.lolipop.jp/wannadoList/');
        $logoutUrl = $facebook->getLogoutUrl($params);
        $facebook->destroySession();
        $this->Auth->logout();
            $this->Session->destroy(); //セッションを完全削除
            //$this->Session->setFlash(__('ログアウトしました'));
        //debug($logoutUrl);
        $this->redirect($logoutUrl);

    } 


}
