<?php

class Posts_categorys extends AppModel {
        public $name = 'Posts_categorys';
		
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