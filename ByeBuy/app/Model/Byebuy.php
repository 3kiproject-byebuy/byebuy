<?php


 class ByeBuy extends AppModel {


    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

//サーチプラグインのサーチbehaviorを遣いますという宣言
//定義済み変数 使用するbehabiorを設定するためだけのやつ
    public $actsAs = array('Search.Searchable');

//指定したフィールドをlike演算子で検索する valueを指定すると完全一致検索
//サーチプラグイン特有の定義済み変数
    public $filterArgs = array(
    	'keyword' => array('type'=>'like','field'=>array('Fbconnect.id','Fbconnect.user_name'))
    	);

}

?>