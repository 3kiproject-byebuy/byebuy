<?php


//Postモデルを作るためにAppModelを継承している。
//AppModelはライブラリのModelを継承している。
//ModelはcakePHPのブレインのような、libフォルダに入ってる。



App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class WantedThreadList extends AppModel {

    public $name = 'WantedThreadList';
    
    public $belongsTo = array(
        //categoryにはモデル名を書く。
        'WantedList' => array(
                'className' => 'WantedList',
                'foreignKey' => 'wantedlist_id'
            ),
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            )

        );

}


?>