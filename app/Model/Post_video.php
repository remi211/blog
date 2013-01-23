<?php

class Post_video extends AppModel {
        public $name = 'Post_video';
		
		public $belongTo = array(			
			'Post'=> array(
				'className' => 'Post',
				'foreignKey' => 'post_id',
				'type'=>'left'
				
			) ,
			'Video'=> array(
				'className' => 'Video',
				'foreignKey' => 'video_id'
			) 
		);
}

?>