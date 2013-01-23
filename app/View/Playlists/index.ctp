<?php $siteName = 'Remi211' ?>
<?php $postName = 'Playlists' ?>
<?php $this->set("title_for_layout", "$postName - $siteName"); ?>

<?php foreach ($plays as $play): ?>
<?php 
$title = $this->Html->link($play['Playlist']['title'], "../playlists/view/".$play['Playlist']['id']);
$titleNoLink = $play['Playlist']['title'];
$articleLink = $this->Html->url("../playlists/".$play['Playlist']['slug']);
$created = strtotime($play['Playlist']['created']);

//$body = Markdown($post['Post']['body']);
$resume = $play['Playlist']['resume'];
$resume = strip_tags($resume);
?>
	
<?php 
	echo "
	<div class='blog_container'>";
	
	if( !empty($play['Video'][0]['name']) ) 
	{
		
		//video
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

