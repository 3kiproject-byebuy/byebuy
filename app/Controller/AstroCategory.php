<?php
class AstroCategory extends AppModel {

	public $validate = array(
        'category_name' => array(
            'rule' => 'notEmpty'
        ),
);
	
}
?>