<?php


 class Selling_list extends AppModel {


	//サーチプラグインのサーチbehaviorを遣いますという宣言
	//定義済み変数 使用するbehabiorを設定するためだけのやつ
    public $actsAs = array('Search.Searchable');

	//指定したフィールドをlike演算子で検索する valueを指定すると完全一致検索
	//サーチプラグイン特有の定義済み変数
    public $filterArgs = array(
    	'keyword' => array('type'=>'like','field'=>array('Selling_list.sellingproduct_name'))
    	);


	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'),
        'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id')

        );

	public $validate = array(
	        'title' => array(
	            'rule' => 'notEmpty'
	        ),
	        'body' => array(
	            'rule' => 'notEmpty'
	        )
	    );

}

?>