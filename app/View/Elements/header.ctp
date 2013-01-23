<header>
	<a href="<?php echo $this->Html->url('/'); ?>" >
		<div class="title">Remi211</div>
	</a>

	<div style="padding: 5px; background: #FBFBFB; border-top: 1px solid #EAEAEA; border-bottom: 1px solid #EAEAEA; text-align: center; margin-bottom: 5px; margin-top: 20px; color: #999999;">
	<h4 style="text-transform:uppercase; font-weight: 300;">
	<a href="<?php echo $this->Html->url('/playlists/'); ?>">Playlist</a> • 
	<a href="<?php echo $this->Html->url('/posts/'); ?>">Blogs</a> • 
	<a href="<?php echo $this->Html->url('/page/track/'); ?>">Tracks</a> • 
	<a href="<?php echo $this->Html->url('/page/about/'); ?>">About</a> • 
	</h4>
	</div>

	<div class="centered">
	<p style="font-size: 1.15em; color: #999999; margin-top: 30px; margin-bottom: 30px; font-weight: 300;">
	<?php echo(Configure::read('Site.description')); ?>
	</p>
	</div>

	<hr>
</header>