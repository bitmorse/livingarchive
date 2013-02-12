<?php
class Visualisation extends AppModel {
    public $name = 'Visualisation';
    public $useDbConfig = 'mongodb_dev';


    public $validate = array(
        'link' => array('rule'=> array('url', true)),
        'title' =>  array(
	        'rule'    => array('maxLength', 100),
	        'message' => 'Titles must be no larger than 100 characters long.'
	    ),
        'description'  =>  array(
	        'rule'    => array('maxLength', 600),
	        'message' => 'Descriptions must be no larger than 600 characters long.'
	    )
    );

}