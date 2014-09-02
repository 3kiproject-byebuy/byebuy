<?php


//Postモデルを作るためにAppModelを継承している。
//AppModelはライブラリのModelを継承している。
//ModelはcakePHPのブレインのような、libフォルダに入ってる。



App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class SellingThreadList extends AppModel {

    public $name = 'SellingThreadList';
    
    public $belongsTo = array(
        //categoryにはモデル名を書く。
        'SellingList' => array(
                'className' => 'SellingList',
                'foreignKey' => 'sellinglist_id'
            ),
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            )

        );


}


?>