<?php $siteName = 'Remi211' ?>
<?php $postName = 'Blogs' ?>
<?php $this->set("title_for_layout", "$postName - $siteName"); ?>

<?php foreach ($images as $image): ?>

<?php 
$editlink = $this->Html->link('Edit', "../images/edit/".$image['Image']['id']);
//$editlink = $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); 

$deletelink = $this->Form->postLink(
		        "Delete",
		        array('action' => 'delete', $image['Image']['id']),
		        array('confirm' => 'Are you sure you want to delete this image?'));
				
$id = $image['Image']['id'];
$title = $image['Image']['title'];
$image = $this->Html->image( 'post_images/thumbs/'.$image['Image']['name'] , array())

?>
	
<?php 
	echo "
	<div class='image_container'>
		<div class=''>".$id."</div>
		<div class='image_c'>".$image."</div>
		<div>".$title."</div>
		<div class='actions'>".$editlink."</div>
		<div class='actions'>".$deletelink."</div>	
	</div>	
	
	";
?>

<?php endforeach; ?>


<div class='centered'>
<?php 
if ($this->Paginator->hasPage(2)) {
	echo $this->Paginator->prev();
	echo (" | ");
} ?> 
<?php echo $this->Paginator->numbers(); ?> 
<?php 
if ($this->Paginator->hasPage(2)) { 
	echo (" | ");
	echo $this->Paginator->next();
	echo ("<hr>");
} ?> 
</div>