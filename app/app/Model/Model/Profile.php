<?php


 class Profile extends AppModel {

 	public $name = 'Profile';
 	public $belongsTo = array(
 		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id')
 			//外部キー
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