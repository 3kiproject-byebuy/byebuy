<?php


//Postモデルを作るためにAppModelを継承している。
//AppModelはライブラリのModelを継承している。
//ModelはcakePHPのブレインのような、libフォルダに入ってる。



App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class Selling_thread_list extends AppModel {

    public $name = 'Selling_thread_list';
    
    public $belongsTo = array(
        //categoryにはモデル名を書く。
        'Selling_list' => array(
                'className' => 'Selling_list',
                'foreignKey' => 'sellinglist_id'
            ),
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            )

        );


}


?>