<?php

class Categorys extends AppModel {
        public $name = 'Categorys';
		
		public $hasMany = array(
			'posts_categorys' => array(
				'className' => 'posts_categorys',
				'foreignKey' => 'categorys_id'
			)
		);
		
		public $validate = array(
			'title' => array(
				'rule' => 'notEmpty'
			),
			'body' => array(
				'rule' => 'notEmpty'
			),
			'body' => array(
				'rule' => 'notEmpty'
			)
		);
}

?>