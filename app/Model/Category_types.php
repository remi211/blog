<?php

class Category_type extends AppModel {
        public $name = 'Category_type';
		
		public $hasMany = array(
			'posts_categories' => array(
				'className' => 'posts_categories',
				'foreignKey' => 'category_type_id'
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