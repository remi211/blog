<!-- File: /app/View/Posts/add.ctp -->
<?php
if( $action == 'add' )
{
	echo '<h1>Add Video</h1>'; 
} 
else
{
	echo '<h1>Edit Video</h1>';
}
?>

<?php
if(isset($error))
{
		echo $this->element('form_error'); 
} 
?>
<?php
echo $this->Form->create('Video', array('enctype' => 'multipart/form-data'));
?>
 	
<?php
if( isset($url_video))
{
	echo $this->element('video_elem');	
}

echo $this->Form->input('url', array('type'=>'text') );
echo $this->Form->input('title');
echo $this->Form->input('comment' ,array('size'=>'50'));

echo $this->Form->submit('Save', array('class'=>'btn primary'));
?>