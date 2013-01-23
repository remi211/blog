<!-- File: /app/View/Posts/edit.ctp -->
<?php 

echo $this->Html->script('ckeditor/ckeditor'); 


?>

<?php 
	if( $action == 'edit')		
	{
		echo "<h1>Edit Post</h1>
			<div class='title_3'>Created ".date($this->data['Post']['created'] )."</div>
			<div class='title_3'>Updated ".date($this->data['Post']['modified'])."</div>
		";
			
	}	
	else
		echo "<h1>Add Post</h1>";
	
	$imageName = '';
	
	if( !empty($this->data['Image'][0]) )
	{
		$imageName = $this->data['Image'][0]['name'];
	}
		
?>

<?php
		
    echo $this->Form->create('Post', array('action' => $action));
    echo $this->Form->input('title');
    echo $this->Form->input('slug');    
    echo $this->Form->input('publish', array( 'type'=> 'select' , 'options'=> $options_publish,'label'=>'Published' ) );
    echo $this->Form->input('resume' , array('type' => 'textarea', 'cols'=> 50 , 'rows' => 8 ) );
	echo "<br><div><label>Edit your post</label></div><br><br>";
    echo $this->Form->input('body', array('class'=>'ckeditor','type'=>'textarea','label'=>false));    
    echo $this->Form->input('id', array('type' => 'hidden'));	
	echo "<br><div>";
		
	echo $this->Form->input('Image.0.PostsImage.image_id',array('type' => 'hidden','label'=>'false','id'=>'imgPost' ));
	
	echo $this->element('gallery', array('imgName'=> $imageName , 'returnInp'=>'imgPost' ));
	
	echo "<div class='clear'></div>";
	
    echo $this->Form->submit('Save', array('class'=>'btn primary'));

	
?>

<div id="body_ajax"></div>


<script>
CKEDITOR.config.width = 600;

CKEDITOR.config.toolbar = (
		[
			{ name: 'document', items : [ 'Preview','Source' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'editing', items : [ 'Find','Replace','SelectAll' ] },
			{ name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'] },
					'/',
			{ name: 'styles', items : [ 'Styles','Format' ] },
			{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent' ] },
			{ name: 'links', items : [ 'Link','Unlink'] },

		]);

</script>