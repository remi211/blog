<!-- File: /app/View/Posts/add.ctp -->

<h1>Edit Image</h1>
<?php
if(isset($error))
{
		echo $this->element('form_error'); 
} 
?>
<?php
echo $this->Form->create('Image', array('enctype' => 'multipart/form-data'));
?>
 	
<?php

echo $this->Html->image( 'post_images/thumbs/'.$this->Image->data['Image']['name'] , array());
echo $this->Form->input('name', array('between'=>'<br />','type'=>'file') );
echo $this->Form->input('title');
echo $this->Form->input('comment');

echo $this->Form->end('Save Image');
?>