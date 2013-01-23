<?php $siteName = 'Remi211' ?>
<?php $postName = 'Blogs' ?>
<?php $this->set("title_for_layout", "$postName - $siteName"); ?>

<?php foreach ($posts as $post): ?>
<?php 
$title = $this->Html->link($post['Post']['title'], "../posts/view/".$post['Post']['id']);
$titleNoLink = $post['Post']['title'];
$articleLink = $this->Html->url("../post/".$post['Post']['slug']);
$created = strtotime($post['Post']['created']);

//$body = Markdown($post['Post']['body']);
$resume = $post['Post']['resume'];
$resume = strip_tags($resume);
?>
	
<?php 
	echo "
	<div class='blog_container'>";
	
	if( !empty($post['Image'][0]['name']) ) 
	{
		
		$f = pathinfo( $post['Image'][0]['name'] );
		
		$f_name = preg_replace('/^(.*)\.([^.]+)$/D', '$1', $f['basename'] ).'_thumb.'.$f['extension'];
		  				
		$f_div = "<div class='blog_image'>".$this->Html->image( 'post_images/'.$f_name
						, array()). "</div>";
	}
	
	echo "
		<div>";
	if( isset($f_name) )
	{
		echo $f_div;
	}
	
	echo "	
			<div class='centered'><h2>$title</h2></div>
			<div>
				Published ".date('l dS M Y' , $created)."
			</div>
			<div>
				$resume
			</div>
		</div>	
	</div>
	
	";
?>

<?php endforeach; ?>

<div class="clear"></div>
<div class='centered cntPaginator'>
	<?php 
	if ($this->Paginator->hasPage(2)) {
		echo $this->Paginator->prev('<<',array('class'=>'btn lnkPag'));
		
	} ?> 
	<?php echo $this->Paginator->numbers(array('class'=>'btn lnkPag','separator'=> false)); ?> 
	<?php 
	if ($this->Paginator->hasPage(2)) { 
		
		echo $this->Paginator->next('>>',array('class'=>'btn lnkPag'));
		echo ("<hr>");
	} ?> 
</div>

