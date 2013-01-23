<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		Remi211's Blog
	</title>
	<?php
		//echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap_x');
		echo $this->Html->css('jquery-ui-1.8.16.custom');

		echo $this->Html->script('jquery-1.8.2.min.js'); 
		echo $this->Html->script('jquery-ui-1.9.2.custom.min.js');
		echo $this->Html->script('jquery.tmpl.min.js'); 
		echo $this->Html->script('main.js'); 
		echo $this->Html->css('styles.css');		
		echo $this->Html->css('gallery.css');		
	?>
	<script>
		urlAbsolute = "";
	</script>
	
</head>
<body>
<!--nocache-->
	<nav>
    <?php 
    if ('admin' == $this->Session->read('Auth.User.role')) {
    	echo $this->element('navbar_admin');
    } elseif ($this->Session->check('Auth.User.id')) {
    	echo $this->element('navbar_author');
    } else {
    	echo('<body>');
    } ?>
	</nav>
	
	<header>
		<?php echo $this->element('header'); ?>
		
	</header>
	<section >

		<?php echo $this->Session->flash(); ?>

		<?php echo $this->fetch('content'); ?>
	</section>
	
	<footer>
		<?php echo $this->element('footer'); ?>
	</footer>

	
</body>
</html>