<!-- File: /app/View/Posts/edit.ctp -->
<?php 

echo $this->Html->script('ckeditor/ckeditor'); 

?>

<?php 
	$url_video = '';	

	if( $action == 'edit')		
	{
		echo "<h1>Edit Playlist</h1>
			<div class='title_3'>Created ".date($this->data['Playlist']['created'] )."</div>
			<div class='title_3'>Updated ".date($this->data['Playlist']['modified'])."</div>
		";
		//Debugger::dump( $this->request->data );
		if( isset($this->request->data['Video'][0]['url'])  )
		{
			$url_video = $this->request->data['Video'][0]['url'];	
		}
		
	}	
	else
	{
		echo "<h1>Add Playlist</h1>";			
	}	
?>

<?php
		
    echo $this->Form->create('Playlist', array('action' => $action));
    echo $this->Form->input('title');
    echo $this->Form->input('slug');    
    echo $this->Form->input('publish', array( 'type'=> 'select' , 'options'=> $options_publish,'label'=>'Published' ) );
    echo $this->Form->input('resume' , array('type' => 'textarea', 'cols'=> 50 , 'rows' => 8 ) );	
    echo $this->Form->input('body', array('type' => 'textarea', 'cols'=> 50 , 'rows' => 8 ) );
    echo $this->Form->input('id', array('type' => 'hidden'));
	
	
	echo $this->Form->input('Video.0.PlaylistsVideo.video_id',array('type' => 'hidden','label'=>'false','id'=>'videoPlay' ));
	
	echo $this->element('gallery_video', array(	'url_video'=> $url_video, 'returnInp'=>'videoPlay' ));
    
	if( !empty($this->data['Videos']) )
	{
		echo "<br><div class='contVideos'>";
		foreach ( $this->data['Videos'] as $key => $video): 
			echo "<div class='clear'>";
			
			echo $this->Form->input('Video.'.$key.'.Playlistsvideo.image_id',array('type' => 'hidden','label'=>'false','id'=>'videoPlay' ));	
			echo "<label>".$video['url']." - ".$video['title']."</label>";		
			echo "</div>";
			
			
		endforeach; 
		echo "</div>";
	}
	
	echo $this->Form->submit('Save', array('class'=>'btn primary'));
?>

<div id="body_ajax"></div>