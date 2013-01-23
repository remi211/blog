<?php $siteName = 'Remi211' ?>
<?php $postName = ($post['Post']['title']); ?>
<?php $this->set("title_for_layout", "$postName - $siteName"); ?>

<?php $postDate = strtotime($post['Post']['created']); ?>


<div class="centered">
<h3><?php echo $postName ?></h3>
<p>
	<small>
		Published <?php echo date('l dS M Y' , $postDate) ?> 
	</small>
</p>
</div>

<?php 
$body = $post['Post']['body'];
$body = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $body);

if( !empty($post['Image'][0]['name']) ) 
{
	echo "<div class='blog_image'>".$this->Html->image( 'post_images/'.$post['Image'][0]['name']
					, array());
	echo "</div>";
}

?>
<div class='blog_body'>

<?php echo $body; ?>
</div>



<p style="text-align: center; color: #999999;"><i class="icon-download-alt"></i> <?php echo $this->Html->link('Download PDF', array('action'=>'view', 'ext'=>'pdf', $post['Post']['id']), array('rel' => 'nofollow')); ?> - <a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=xa-4f8947e47c1964dd"><i class="icon-retweet"></i> Share</a></p>
<p>

<hr>
