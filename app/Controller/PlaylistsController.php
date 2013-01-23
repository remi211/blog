<?php

class PlaylistsController extends AppController {
    	
	public $helpers = array('Html', 'Form', 'Paginator', 'Text');

	public $components = array('Session','RequestHandler');
	
	
	var $paginate = array(
        'limit' => 5,
        'order' => array(
			'Playlist.created' => 'desc',
         ),
		 'conditions' => array(
						
							'Playlist.publish' => 1
						
					)	
    );
	
    public $options_publish = array(
    	'0' => 'Off',
    	'1' => 'On'
    );
	
    public function index() {
        /*
		$posts = $this->Post->find('all', array(
					'order' => 'Post.created DESC'
					,
					'conditions' => array(
						
							'Post.publish' => 1
						
					)	
        		));
		*/		
       // $this->set('posts', $posts );
        
        $this->set('plays', $this->paginate('Playlist'));
    }
	
	
	
	public function view($id) {
    	$playlist = $this->Playlist->find('first', array(
    		'conditions' => array(
    			"or" => array(
    				'Playlist.id' => $id, //for permalinks
    				'Playlist.slug' => $id, //for SEO urls
    			)
    		),
    	));
    	
		$this->set(compact('playlist'));
    }
	
	
	public function view_recent() {
		
		$posts = $this->Playlist->find("all", array(
			 'order' => 'playlist.modified', 
			 'limit' => 3
			)
		);
		//echo print_r($post, true );
		if (empty($posts)) {
			throw new NotFoundException("Post doesn't exist");
		}
		
		//$this->set('posts',$posts);
		return $posts;
	}
	
	public function add() {
		$this->set('action', 'add');
		$this->set('options_publish', $this->options_publish );
		
	
		$this->autoRender = false ; //we set no use default view		
		$this->render('edit'); //we set the view to use
		
		
        if ($this->request->is('post')) {
			$this->request->data['Playlist']['slug'] = $this->stringToSlug($this->request->data['Playlist']['title']);

            if ($this->Playlist->save($this->request->data)) {
                $this->Session->setFlash('Your playlist has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
		
		//$log = $this->Model->getDataSource()->getLog(false, false);
		//debug($log);
    }
	
	
	function edit($id = null) {
		$this->Playlist->id = $id;
		
		//$this->Playlist->recursive = 1; 
		
		$this->set('action', 'edit');				
		$this->set('options_publish', $this->options_publish );
		
		if ($this->request->is('get')) {
			$this->request->data = $this->Playlist->read();			
		} else {
		//Debugger::dump($this->request->data);
			$this->request->data['Playlist']['slug'] = $this->stringToSlug($this->request->data['Playlist']['title']);
						
			if ($this->Playlist->save($this->request->data)) {
				$this->Session->setFlash('Your playlist has been updated.');
				$this->redirect(array('action' => 'archives'));
			}
			
		}
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Playlist->delete($id)) {
			$this->Session->setFlash('The playlist with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'archives'));
		}
	}
	
	
	public function archives() {
    	$this->paginate = array(
    	        'limit' => 15,
    	        'order' => array(
    	        'Playlist.created' => 'desc'
    	         )
    	    );
    	$data = $this->paginate('Playlist');
        $this->set('playlist', $data);
    }
	
	
}
?>