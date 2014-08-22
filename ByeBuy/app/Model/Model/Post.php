<?php


//Postモデルを作るためにAppModelを継承している。
//AppModelはライブラリのModelを継承している。
//ModelはcakePHPのブレインのような、libフォルダに入ってる。




//バリデーション（検証、チェック機能）
class Post extends AppModel {
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
    	'keyword' => array('type'=>'like','field'=>array('Post.title','Post.body'))
    	);


//カテゴリーモデルとのアソシエーション
//postモデルはカテゴリーモデルに属しているといえる。 
    public $belongsTo = array(
            'Category' => array(
                'className' => 'Category',
                'foreignKey' => 'category_id')
                //外部キー
            );

}

?>