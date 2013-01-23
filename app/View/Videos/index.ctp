<?php $siteName = 'Remi211' ?>
<?php $postName = 'Videos' ?>
<?php $this->set("title_for_layout", "$postName - $siteName"); ?>

<?php echo "<div>".$this->Html->link('Add', array('action' => 'add' ) , array('class'=>'btn btn-mini btn-success') )."</div><br>"; ?>

<?php foreach ($videos as $video): ?>

<?php 
$editlink = $this->Html->link('Edit', "../videos/edit/".$video['Video']['id']);
 

$deletelink = $this->Form->postLink(
		        "Delete",
		        array('action' => 'delete', $video['Video']['id']),
		        array('confirm' => 'Are you sure you want to delete this image?'));
				
$id = $video['Video']['id'];
$title = $video['Video']['title'];


?>
	
<?php 
	
	echo "
	<div class='image_container'>
		<div>
			".$this->element('video_thumb_elem', array('url_video'=>$video['Video']['url']))."
		</div>
		<div>
			<div class=''>".$id."</div>
			<div>".$title."</div>
			<div>
				<span>".$editlink."</span>
				<span>".$deletelink."</span>
			</div>
		</div>			
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