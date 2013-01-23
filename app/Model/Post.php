<?php

class Post extends AppModel {
        public $name = 'Post';
		
		var $display_field = 'title';
		
		 var $hasAndBelongsToMany = array(
				'Image' =>            array(
					'className'              => 'Image',
					'joinTable'              => 'posts_images',
					'foreignKey'             => 'post_id',
					'associationForeignKey'  => 'image_id'									
				)
		 );
		
		public $validate = array(
			'title' => array(
				'rule' => 'notEmpty'
			),
			'body' => array(
				'rule' => 'notEmpty'
			),
			'status' => array(
				'rule' => array('boolean'),
			)
		);
		
		
		/*
		function beforeSave(){
			$this->data['Event']['start'] = $this->_getDate('Event', 'start');

			return true;
		}
		*/
		
}

?>