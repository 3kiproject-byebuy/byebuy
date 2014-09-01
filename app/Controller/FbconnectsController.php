<?php

//【1】facebook認証
App::import('Vendor','facebook',array('file' => 'facebook'.DS.'src'.DS.'facebook.php'));

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

    function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow();
    
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

                    //debug('$User>fbidあり>オースログイン');
               
                        $this->redirect(array('controller'=>'Byebuys','action'=>'login',$id));


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

                        $this->redirect(array('controller'=>'byebuys','action' => 'login',$id));
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

    public function logout(){

        $facebook = new Facebook(array(
        'appId' => '279683735571945',
        'secret' => '97c9737e7de0176fe6c7737ac4535ddc',
        ));

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

        $this->redirect(array('controller' => 'Byebuys', 'action' => 'index'));
    } 

}
