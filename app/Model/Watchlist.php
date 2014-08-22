<?php


App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class Watchlist extends AppModel {

    public $name = 'Watchlist';
    


    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id')
        );


    public $hasAndBelongsToMany = array(
        'Selling_list' => array(
            'className'=>'Selling_list',
            'foreignKey'=>'sellinglist_id'));

 

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    //public $actsAs = array('Acl' => array('type' => 'requester'));

    // //暗号化された値を返す
    // public function beforeSave() {
    //     $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    //     return true;
    // }

    

    // public function parentNode() {
    //     if (!$this->id && empty($this->data)) {
    //         return null;
    //     }
    //     if (isset($this->data['User']['group_id'])) {
    //         $groupId = $this->data['User']['group_id'];
    //     } else {
    //         $groupId = $this->field('group_id');
    //     }
    //     if (!$groupId) {
    //         return null;
    //     } else {
    //         return array('Group' => array('id' => $groupId));
    //     }
    // }

    
    // public function bindNode($user) {
    //     return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
    // }

    

}


?>