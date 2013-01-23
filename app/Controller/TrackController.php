<?php

class PostsController extends AppController {
    	
	public $helpers = array('Html', 'Form', 'Paginator', 'Text');

	public $components = array('Session','RequestHandler');
	
	
	var $paginate = array(
        'limit' => 5,
        'order' => array(
			'Post.created' => 'desc',
         ),
		 'conditions' => array(
						
							'Post.publish' => 1
						
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
        
        $this->set('posts', $this->paginate('Post'));
    }
	
	
	
	public function view($id) {
    	$post = $this->Post->find('first', array(
    		'conditions' => array(
    			"or" => array(
    				'Post.id' => $id, //for permalinks
    				'Post.slug' => $id, //for SEO urls
    			)
    		),
    	));
    	
		$this->set(compact('post'));
    }
	
	/*
	function view($slug = null) {
	   if (!$slug) {
		  $this->Session->setFlash(__('Invalid book', true));
		  $this->redirect(array('action' => ‘index’));
	   }
	   
	   $this->set('post', $this->Post->findBySlug($slug));	   
	   
	}
	*/
	public function view_recent() {
		
		$posts = $this->Post->find("all", array(
			 'order' => 'post.modified', 
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
			$this->request->data['Post']['slug'] = $this->stringToSlug($this->request->data['Post']['title']);

            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            }
        }
		
		//$log = $this->Model->getDataSource()->getLog(false, false);
		//debug($log);
    }
	
	
	function edit($id = null) {
		$this->Post->id = $id;
		$this->set('action', 'edit');				
		$this->set('options_publish', $this->options_publish );
		
		if ($this->request->is('get')) {
			$this->request->data = $this->Post->read();			
		} else {
			$this->request->data['Post']['slug'] = $this->stringToSlug($this->request->data['Post']['title']);
						
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Your post has been updated.');
				$this->redirect(array('action' => 'archives'));
			}
			
		}
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Post->delete($id)) {
			$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
			$this->redirect(array('action' => 'archives'));
		}
	}
	
	
	public function archives() {
    	$this->paginate = array(
    	        'limit' => 15,
    	        'order' => array(
    	        'Post.created' => 'desc'
    	         )
    	    );
    	$data = $this->paginate('Post');
        $this->set('posts', $data);
    }
}
?>