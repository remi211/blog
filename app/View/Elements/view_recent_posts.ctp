<!-- File: /app/View/Posts/view.ctp -->
<?php 
$posts = $this->requestAction('/posts/view_recent');
?>

<?php foreach ($posts as $post): ?>
<h3><?php echo $post['Post']['title']?></h3>

<p><small>Created: <?php echo $post['Post']['created']?></small></p>

<p><?php echo substr($post['Post']['body'] , 0 , 30 ) ?></p>
<?php endforeach; ?>

