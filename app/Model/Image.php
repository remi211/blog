<?php

class Image extends AppModel {
        public $name = 'Image';
        
        /*
	    var $validate = array(
		    'name' => array(
			    //'rule' => 'is_permited',
			    //'message' => 'Please supply a valid image.'
			    )
	    );
*/
        
        // list of permitted file types, this is only images but documents can be added
		public	$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
		
		/*
		public $hasMany = array(			
			'posts_image'=> array(
				'className' => 'posts_image',
				'foreignKey' => 'post_id'
			) 
		);
		*/
		
		
		var $hasAndBelongsToMany = array(
				'Post' =>            array(
					'className'              => 'Post',
					'joinTable'              => 'posts_images',
					'foreignKey'             => 'post_id',
					'associationForeignKey'  => 'image_id'									
				)
		 );
		
		function is_permited( $file ){

				$permited = false;
				// check filetype is ok
				foreach($this->permitted as $type) {
					if($type == $file['name']['type'] ) {
						$permited = true;						
						break;
					}
				}
				
				return $permited;
		}		
		
}

?>