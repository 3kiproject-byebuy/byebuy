<?php


//Postモデルを作るためにAppModelを継承している。
//AppModelはライブラリのModelを継承している。
//ModelはcakePHPのブレインのような、libフォルダに入ってる。



App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class WantedList extends AppModel {

    public $name = 'Wantedist';

    public $belongsTo = array(
        //categoryにはモデル名を書く。
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            )

    );

    public $hasMany = array(
        'WantedThreadList' => array(
            'className' => 'WantedThreadList', //クラスの名前
            'foreignKey' => 'wantedlist_id',
            'conditions' => array('del_flg' => 0)
            )
    );


}


?>