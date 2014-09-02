<?php
class Article extends AppModel {


	//behaviorを追加
	public $actsAs=array('Search.Searchable');

	//検索方法を指定（タイトルを曖昧検索（like）を指定）
	//typeにvalue：完全一致検索
	public $filterArgs=array(
						//タイトルかボディに対してキーワード検索を実行する
						//type：検索方法、field：検索対象
						'keyword'=>array('type'=>'like','field'=>array('Article.title','Article.body'))
						);

    //アソシエーション
    public $belongsTo = array(
    	'AstroCategory' => array(
    		'className' => 'AstroCategory', //クラスの名前
    		'foreignKey' => 'category_id'
    	)
    );
}
?>