<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class Selling_list extends AppModel {

    public $name = 'Selling_list';

    //サーチプラグインのサーチbehaviorを遣いますという宣言
    //定義済み変数 使用するbehabiorを設定するためだけのやつ
    public $actsAs = array('Search.Searchable');

    //指定したフィールドをlike演算子で検索する valueを指定すると完全一致検索
    //サーチプラグイン特有の定義済み変数
    public $filterArgs = array(
        'keyword' => array('type'=>'like','field'=>array('Selling_list.sellingproduct_name'))
        );

    public $belongsTo = array(
        //categoryにはモデル名を書く。
        'User' => array(
                'className' => 'User',
                'foreignKey' => 'user_id'
            ),
        );
    
    

    

}

?>