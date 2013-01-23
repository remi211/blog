<div class='element_video'>
<iframe
<?php
if( isset($video_size) && $video_size == VIDEO_SIZE_SMALL ) 
 
	echo "width='300' height='200'"; 

else
	echo "width='500' height='400' "; 
?>	  
	
src="http://www.youtube.com/embed/<?php echo $url_video ?>" frameborder="0" allowfullscreen></iframe>
</div>