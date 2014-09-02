<?php


//Postモデルを作るためにAppModelを継承している。
//AppModelはライブラリのModelを継承している。
//ModelはcakePHPのブレインのような、libフォルダに入ってる。



App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class Wanted_thread_list extends AppModel {

    public $name = 'Wanted_thread_list';
    
    public $belongsTo = array(
        //categoryにはモデル名を書く。
        'Wanted_list' => array(
                'className' => 'Wanted_list',
                'foreignKey' => 'wantedlist_id'
            ),
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            )

        );

}


?>