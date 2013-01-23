<?php foreach ($images as $image): ?>
<?php 
//$editlink = $this->Html->link('Edit', "../images/edit/".$image['Image']['id']);
			
$id = $image['Image']['id'];
$title = $image['Image']['title'];
$image = $this->Html->image('post_images/thumbs/'.$image['Image']['name'] , array())

?>
	<?php 
		echo "
		<div class='boxImage' imageId='".$id."' >		
			<div class='cntImage' style='background: '>".$image."</div>		
			<div class='cntImageTitle'>".$title."</div>		
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

<script>
	$('.lnkPag').each(function( i , row ){
		
		node = $(this).find('a').eq(0);
		console.log( node.attr('href') );
		//if( $.isEmptyObject(node) == false )
		if( node.attr('href') )
		{
			ahref = node.attr('href');
			$(this).text( node.text() );								
			$(this).attr({href:ahref ,content:'.gallery' });		
			node.remove();
		}	
	});

	$('.lnkPag').click(function (){								
		if( $(this).attr('href') )
			callAjax( $(this).attr('href') , false, '.gallery' ); 						
	});
	
</script>