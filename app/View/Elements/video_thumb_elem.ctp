<?php
if( isset($url_video) ) 
{
?>
<div>
	<img width="224" alt="Miniatura" src="//i2.ytimg.com/vi/<?php echo $url_video?>/mqdefault.jpg">
</div>
<?php
}
else
{ 
?>
<div>
	<img width="224" alt="Miniatura" src="//i2.ytimg.com/vi/is_a_test/mqdefault.jpg">
</div>
<?php
}
?>