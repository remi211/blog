<?php

class Posts_image extends AppModel {
        public $name = 'Posts_image';
		
		public $belongTo = array(			
			'Post'=> array(
				'className' => 'Post',
				'foreignKey' => 'post_id',
				'type'=>'left'
				
			) ,
			'Image'=> array(
				'className' => 'Image',
				'foreignKey' => 'image_id'
			) 
		);
}

?>