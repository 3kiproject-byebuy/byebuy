<?php


 class Wishlist extends AppModel {

 	// public $name = 'Wishlist';
 	// public $belongsTo = array(
 	// 	'User' => array(
		// 	'className' => 'Wishlist',
		// 	'foreignKey' => 'user_id')
 	// 		//外部キー
 	// 	);

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