<?php

class ImagesController extends AppController {
    	
	public $helpers = array('Html', 'Form', 'Paginator', 'Text');

	public $components = array('Session','RequestHandler');
	
	// list of permitted file types, this is only images but documents can be added
	public	$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
		
	
	var $paginate = array(
        'limit' => 5,
        'order' => array(
        'Image.id' => 'desc'
         )
    );
	
    public function index() {
        
		$images = $this->Image->find('all', array(
        		'order' => 'image.id DESC'
        		));    
        
        $this->set('images', $this->paginate('Image'));
    }
	
	/*
	public function view($id) {
    	$post = $this->Post->find('first', array(
    		'conditions' => array(
    			"or" => array(
    				'Post.id' => $id, //for permalinks
    				'Post.slug' => $id //for SEO urls
    			)
    		),
    	));
    	$this->set(compact('post'));
    }
	*/
	
	
	function get_images(){
		$_view = ROOT . DS . APP_DIR . DS . "views" . DS . "common" . DS . "json.ctp";
		Configure::write("debug",0);
		$this->autoRender=false;	
		$this->render(null,"default",$_view);		
		
		$images = $this->Image->find('all', array(
        		'order' => 'image.id DESC'
        ));  
		$this->set('images', $this->paginate('Image'));
		
	}
	
	public function gallery() {
		
		$images = $this->Image->find('all', array(
        		'order' => 'image.id DESC'
        ));    
        
        $this->set('images', $this->paginate('Image'));
		
		$this->layout = 'ajax';
	}
	
	public function add() {
		
        if ($this->request->is('post')) {

        	if( $this->is_permited( $this->request->data['Image']['name']['type'] ) )
        	{
	        	$file = $this->request->data['Image']['name'];
	        	unset($this->request->data['Image']['name']);
	        	
	            if ($this->Image->save($this->request->data)) {
	            	$this->Image->id = $this->Image->getInsertId();
					$f_name = $this->uploadFiles( $this->Image->id , $file );
					
					if( isset($f_name['filename'] ) )
					{
						
		            	$this->request->data['Image']['name'] = $f_name['filename'];
		            	$result = $this->Image->save($this->request->data);
						echo print_r($result, true );
		            	if ($result ) {
		                	$this->Session->setFlash('Your Image has been saved.');
		               		$this->redirect(array('action' => 'index'));
		            	}
					}
	            }
        	}
        	else{
        		$this->set('error', 'The file has not a valid format');
        		return false;
        		
        	}    
        }
        
    }
	
	
	function edit($id = null) {
		$this->Image->id = $id;
		if ($this->request->is('get')) {
								
			$this->request->data = $this->Image->read();			
		} else {
			if( $this->is_permited( $this->request->data['Image']['name']['type'] ) )
        	{							
	        	$file = $this->request->data['Image']['name'];
				unset($this->request->data['Image']['name']);
				if ($this->Image->save($this->request->data)) {
					
					$f_name = $this->uploadFiles( $this->Image->id , $file );
										
					if( isset($f_name['filename'] ) )
					{
						
		            	$this->request->data['Image']['name'] = $f_name['filename'];
		            	$result = $this->Image->save($this->request->data);
						//echo print_r($result, true );
		            	if ($result ) {
		                	$this->Session->setFlash('Your Image has been saved.');
		               		$this->redirect(array('action' => 'index'));
		            	}
					}					
					
					$this->Session->setFlash('The image has been updated.');
					//$this->redirect(array('action' => 'index'));
				}
        	}
        	else{
        		$this->set('error', 'The file has not a valid format');
        		return false;
        	}	
		}
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Image->delete($id)) {
			$this->Session->setFlash('The image with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}
	

	
	function is_permited( $f_type ){
		$permited = false;
		// check filetype is ok
		foreach($this->permitted as $type) {
			if($type == $f_type ) {
				$permited = true;
				echo "asjdahkdsjh";
				break;
			}
		}
		
		return $permited;
	}
	
	/**
	 * uploads files to the server
	 * @params:
	 *		$folder 	= the folder to upload the files e.g. 'img/files'
	 *		$formdata 	= the array containing the form files
	 *		$itemId 	= id of the item (optional) will create a new sub folder
	 * @return:
	 *		will return an array with the success of each file upload
	 */
	function uploadFiles($id, $file) {
		$folder = 'images/post_images';
		// setup dir names absolute and relative
		$folder_url = WWW_ROOT.'img/post_images';
		$rel_url = $folder;
		
		// create the folder if it does not exist
		if(!is_dir($folder_url)) {
			return false;
		}
						
		// loop through and deal with the files
		//foreach($formdata as $file) {
			// replace spaces with underscores
			//$filename = str_replace(' ', '_', $file['name']);
			$filename = $id;
			// assume filetype is false
			$typeOK = false;
			
			
			$path_file = $folder_url.'/'.$filename;
			/*
			//we remove the file
			if(file_exists($folder_url.'/'.$filename)) {
					unlink( $path_file );
			}
			*/
			// if file type ok upload the file
			
			// switch based on error code
			switch($file['error']) {
				case 0:
					// check filename already exists
					//if(!file_exists($folder_url.'/'.$filename)) {
						// create full filename
						
						$ext = explode('/', $file['type'] );
						
						$filename .= '.'.$ext[1];
						$full_url = $folder_url.'/'.$filename;							
						$url = $rel_url.'/'.$filename;
						// upload the file
						$success = move_uploaded_file( $file['tmp_name'], $full_url);
					//} 
					// if upload was successful
					if($success) {
						$thumb_p = $folder_url.'/thumbs/'.$filename;	
						//$this->make_thumb( $full_url , $thumb_p , 200 );
						$this->make_thumb2( $full_url , $thumb_p  );
						// save the url of the file
						$result['filename'] = $filename;
						$result['urls'] = $url;
					} else {
						$result['errors'] = "Error uploaded $filename. Please try again.";
					}
					break;
				case 3:
					// an error occured
					$result['errors'] = "Error uploading $filename. Please try again.";
					break;
				default:
					// an error occured
					$result['errors'] = "System error uploading $filename. Contact webmaster.";
					break;
			}
			
		//}
		return $result;
	}
	
	
	function make_thumb2( $source , $dest )
	{
		$nw = 150;
        $nh = 100;
        
        $stype = explode(".", $source);
        $stype = $stype[count($stype)-1];
        
 
        $size = getimagesize($source);
        $w = $size[0];
        $h = $size[1];
 
        switch($stype) {
            case 'gif':
                $simg = imagecreatefromgif($source);
                break;
            case 'jpg':
                $simg = imagecreatefromjpeg($source);
                break;
			case 'jpeg':
                $simg = imagecreatefromjpeg($source);
                break;	
            case 'png':
                $simg = imagecreatefrompng($source);
                break;
        }
 
        $dimg = imagecreatetruecolor($nw, $nh);
        $wm = $w/$nw;
        $hm = $h/$nh;
        $h_height = $nh/2;
        $w_height = $nw/2;
 
        if($w> $h) {
            $adjusted_width = $w / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;
            imagecopyresampled($dimg,$simg,-$int_width,0,0,0,$adjusted_width,$nh,$w,$h);
        } elseif(($w <$h) || ($w == $h)) {
            $adjusted_height = $h / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
 
            imagecopyresampled($dimg,$simg,0,-$int_height,0,0,$nw,$adjusted_height,$w,$h);
        } else {
            imagecopyresampled($dimg,$simg,0,0,0,0,$nw,$nh,$w,$h);
        }
        
        imagejpeg($dimg,$dest,100);
        
	}
	
}
?>