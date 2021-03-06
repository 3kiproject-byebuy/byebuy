<?php


//Postモデルを作るためにAppModelを継承している。
//AppModelはライブラリのModelを継承している。
//ModelはcakePHPのブレインのような、libフォルダに入ってる。



App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class User extends AppModel {

    public $name = 'User';
    
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    public $actsAs = array('Acl' => array('type' => 'requester'));

    //暗号化された値を返す
    public function beforeSave() {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }

    

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }

    
    public function bindNode($user) {
        return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    }

    

}


?>