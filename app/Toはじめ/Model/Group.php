<?php


//Postモデルを作るためにAppModelを継承している。
//AppModelはライブラリのModelを継承している。
//ModelはcakePHPのブレインのような、libフォルダに入ってる。




//バリデーション（検証、チェック機能）
class Group extends AppModel {
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

//グループを画面から登録したときに、groupテーブルのデータをUsersとArosと紐づける。
public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        return null;
    }

}

?>