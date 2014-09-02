<?php


//Postモデルを作るためにAppModelを継承している。
//AppModelはライブラリのModelを継承している。
//ModelはcakePHPのブレインのような、libフォルダに入ってる。



App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class Wanted_list extends AppModel {

    public $name = 'Wanted_list';

    public $belongsTo = array(
        //categoryにはモデル名を書く。
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            )

    );

    public $hasMany = array(
        'Wanted_thread_list' => array(
            'className' => 'Wanted_thread_list', //クラスの名前
            'foreignKey' => 'wantedlist_id',
            'conditions' => array('del_flg' => 0)
            )
    );


}


?>