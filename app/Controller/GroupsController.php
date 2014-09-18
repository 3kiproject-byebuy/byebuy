<?php


class GroupsController extends AppController {

    function beforeFilter() {
    parent::beforeFilter();
    //$this->Auth->allow();
	}

    public function index(){//権限グループの一覧
       
    	$groups = $this->Group->find('all');
        debug($groups);

	    $this->set(compact('groups'));//view用の変数としてセット。

	}

     public function add() {//権限グループの追加

        if ($this->request->is('post')) {//このpostはpost送信のpost。post送信されたら
            
            $this->Group->create(); //データーを新たにインサートするときに必要なコード

            if ($this->Group->save($this->request->data)) {
            
                $this->Session->setFlash(__('Your group has been saved.'));
                
                return $this->redirect(array('action' => 'index'));

            }

            //saveが失敗したとき用
            $this->Session->setFlash(__('Unable to add your group.'));   
        }
        
    }

 }


?>