<?php


App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
//バリデーション（検証、チェック機能）



class Watchlist extends AppModel {

    public $name = 'Watchlist';

    public $actsAs = array('Search.Searchable');

    public $filterArgs = array(
                            'keyword'=>array(
                                'type'=>'like', 
                                'field'=>array(
                                    'sellingproduct_price',
                                    'sellingproduct_name',
                                    'sellingproduct_detail')
                                )
                            );

    //アソシエーション     
    public $belongsTo= array(
        'SellingList' => array(
             'className' => 'SellingList',
             'foreignKey' => 'sellinglist_id'),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'id')
        );

    public $hasMany= array(
        'SellingList' => array(
             'className' => 'SellingList',
             'foreignKey' => 'id')
        );
    
}


?>