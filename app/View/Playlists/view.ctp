<?php $siteName = 'Remi211' ?>
<?php $name = ($playlist['Playlist']['title']); ?>
<?php $this->set("title_for_layout", "$name - $siteName"); ?>

<?php $date = strtotime($playlist['Playlist']['created']); ?>


<div class="centered">
<h3><?php echo $name ?></h3>
<p>
	<small>
		Published <?php echo date('l dS M Y' , $date) ?> 
	</small>
</p>
</div>

<?php 
$body = $playlist['Playlist']['body'];
$body = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $body);
//$body = htmlentities( $body , ENT_QUOTES);
$body = nl2br( $body , ENT_QUOTES);

if( !empty($playlist['Video'][0]['id']) ) 
{
	echo $this->element( 'video_elem', array('url_video'=>$playlist['Video'][0]['url'] ));
	
}

?>
<div class='blog_body'>

<?php echo $body; ?>
</div>



<p style="text-align: center; color: #999999;"><i class="icon-download-alt"></i> <?php echo $this->Html->link('Download PDF', array('action'=>'view', 'ext'=>'pdf', $playlist['Playlist']['id']), array('rel' => 'nofollow')); ?> - <a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4f8947e47c1964dd"><i class="icon-retweet"></i> Share</a></p>
<p>

<hr>
