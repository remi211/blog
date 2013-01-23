<div class="input select">
	
		<label>Images</label>
	
	<div>
<?php
if( isset($imgName) && strlen( $imgName) > 0 )
{	
	echo "<div class='' >";
	echo $this->Html->image( 'post_images/thumbs/'.$imgName, array('id'=>'galleryImg','class'=>'imgCommon'));
	echo "</div>";
}
else{
	echo "<div class='clear' >";
	echo "<img src='' id='galleryImg' class='imgCommon hide' />";
	echo "</div>";
}
?>	
	<div class='clear'>
		<input type='button' value='Gallery' class='btn btnImages' ajax='' content='.gallery'  href='images/gallery' > </div><br>
	</div>
</div>	

<div class="dlgGallery">
	<div class="gallery"></div>	
</div>
<?php //echo $this->Html->url( null, true ); ?>
<?php echo $_SERVER['SERVER_NAME'] ?>
<script>

$(".btnImages").live("click", function(){
	node = $(".btnImages");
	$(".dlgGallery" ).dialog({ 
		autoOpen: true, 
		width: 700  ,
		title: 'Gallery',		
		buttons: {
                Ok: function() {
					returnInp = "<?php echo $returnInp; ?>";
					
					if( $(".imgSelected").length > 0 )
					{
						img = $(".imgSelected").eq(0).attr('imageId');	
						imgname = $(".imgSelected").eq(0).find('img').attr('src');
						
						$("#"+returnInp).val( img );							
						$("#"+returnInp).removeClass('hide');						
						$("#galleryImg").attr( 'src' , imgname );	
						$("#galleryImg").show();	
					}
					
					$( this ).dialog( "close" );
                }
        },
		
		close: function(){
			$(this).dialog('destroy');
		},
		open: function (){ 
			callAjax("/blog/images/gallery" , false, '.gallery'); 
		}
	});	
});

		



$('.boxImage').live('click' , function (){
	if( $(this).hasClass('imgSelected') )
	{
		$(this).removeClass('imgSelected');
		$("#hddImage").val();	
	}	
	else
	{
		$('.boxImage').removeClass('imgSelected');
		$(this).addClass('imgSelected');
	}		
});
</script>