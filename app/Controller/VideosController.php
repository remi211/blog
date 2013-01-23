<?php

class VideosController extends AppController {
    	
	public $helpers = array('Html', 'Form', 'Paginator', 'Text');

	public $components = array('Session','RequestHandler');
	
	// list of permitted file types, this is only images but documents can be added
	//public	$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
		
	
	var $paginate = array(
        'limit' => 10,
        'order' => array(
        'video.id' => 'desc'
         )
    );
	
    public function index() 
	{
        /*
		$images = $this->Video->find('all', array(
					'order' => 'video.id DESC'
					)
				);    
        */
        $this->set('videos', $this->paginate('Video'));
    }
	
	
	public function view($id) 
	{
    	$video = $this->Video->find('first', array(
    		'conditions' => array(
				'Video.id' => $id, //for permalinks    			
    		)
    	));
    	$this->set(compact('video'));
    }
	
			
	public function add() 
	{
		$this->set('action', 'add');
		$this->autoRender = false ; //we set no use default view		
		$this->render('edit'); //we set the view to use
		
		
        if ($this->request->is('post')) {        	
			$result = $this->Video->save( $this->request->data );
			//echo print_r($result, true );
			
			if ($result ) {
				$this->Session->setFlash('Your Video has been saved.');
				$this->redirect(array('action' => 'index'));
			}
			
        }
        
        
    }
	
	
	public function edit($id = null) 
	{
		$this->Video->id = $id;
		$this->set('action', 'edit');
		
		
		if ($this->request->is('get')) 
		{								
			
			$this->request->data = $this->Video->read();
			//echo print_r($this->request->data['Video']['url'] , true);
			$this->set('url_video', $this->request->data['Video']['url'] );			
		}
		else 
		{		
			if( $this->Video->save($this->request->data ) )
			{
				$this->Session->setFlash('Your Video has been saved.');
             	$this->redirect(array('action' => 'index'));
			}
			else
			{
				$this->set('error', 'The video could\'t be saved');
        		return false;
			}			
		}
	}
	
	public function delete($id) 
	{
		if (!$this->request->is('post'))
		{
			throw new MethodNotAllowedException();
		}
		if ($this->Video->delete($id)) 
		{
			$this->Session->setFlash('The Video with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'index'));
		}
	}	
	
	public function gallery(){
		$this->layout = 'ajax';
		
		
		$this->paginate = array(
			'limit' => 6,
			'order' => array(
			'Video.created' => 'desc'
			 )
		);
    	$data = $this->paginate('Video');
        $this->set('videos', $data);
		
		
	}
	
	
	
}
?>