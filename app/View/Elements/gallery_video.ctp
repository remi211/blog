<div class="input select">
	
		<label>Videos</label>
	
	<div>
		<div id='videoThumb'>
<?php
if( isset($url_video) && strlen( $url_video) > 0 )
{	
	echo $this->element( 'video_thumb_elem', array('url_video'=>$url_video ));
}
else{
	echo $this->element( 'video_thumb_elem', array( ));
}
?>	
			</div>
		<div class='clear'></div>
		<div>
			<input type='button' value='Gallery' class='btn btnVideo' ajax='' content='.gallery'  href='images/gallery' > 
		</div><br>
		
	</div>	

<div id="dlgGallery">
	
</div>

<script id="boxVideo" type="text/x-jquery-tmpl">    						
				<div class='boxImage' boxId='${Video.id}' url='${Video.url}'>
					<img width='125' alt='Miniatura' src='//i2.ytimg.com/vi/${Video.url}/mqdefault.jpg'>
					<div class='cntImageTitle'>${Video.title}</div>
				</div>			
</script>


<script id="cntGallery" type="text/x-jquery-tmpl">    
			<div id='cntVideos'> {{tmpl(videos) '#boxVideo'}} </div>
			<div class='clear'></div>
			<div id='paginator'> {{tmpl(paginator) '#boxPaginator'}} </div>
</script>

<script id="videoElem_1" type="text/x-jquery-tmpl">    
	<div class='element_video'>
		<iframe width='300' height='200' src="http://www.youtube.com/embed/${url_video}" frameborder="0" allowfullscreen></iframe>
	</div>
</script>


<script id="boxPaginator" type="text/x-jquery-tmpl">   
	
	{{if prev}}
		{{html preparePag(prev)}}
	{{/if}}	
	{{if numbers}}
		{{html preparePag(numbers)}}
	{{/if}}	
	{{if next}}
		{{html preparePag(next) }}
	{{/if}}	
	
</script>
	
<script>

function preparePag(json) {  
  json = json.replace("<a","<span"); 
  json = json.replace("/a>","/span>"); 
  return json;
}
/*
templates = {
	thumbnail : "<img width='125' alt='Miniatura' src='//i2.ytimg.com/vi/${url}/mqdefault.jpg'>", 	
	/*
	boxVideo : "{{each Video}}"+	
				"<div class='boxImage' imageId='${id}'>"+
					"<img width='125' alt='Miniatura' src='//i2.ytimg.com/vi/${url}/mqdefault.jpg'>"+
					"<div class='cntImageTitle'>${title}</div>"+	
				"</div>"+
				"{{/each}}"
				,
				
	paginator : "{{if prev}}"+
					"	prev"+
					"{{/if}}	"+					
					"{{if numbers}}"+
					"	numbers"+
					"{{/if}}	"+
					"{{if next}}"+
					"	next"+
					"{{/if}}	"
					,			
						
	gallery : "<div id='gallery'> {{tmpl(data.videos) '#boxVideo'}} </div>"+
			  "<div id='paginator'> {{tmpl(data.paginator) '#paginator'}} </div>"
	
};	
*/

$(document).ready(function()
{
	
/*
$.template( "boxVideo", templates.boxVideo );
$.template( "paginator", templates.paginator );
$.template( "gallery", templates.gallery );
*/
});

var inputVideoId = "videoPlay";

$(".btnVideo").live("click", function(){
	node = $(".btnImages");
	$("#dlgGallery" ).dialog({ 
		position: { my: "top", at: "top", of: window },
		autoOpen: true, 
		width: 600  ,
		title: 'Gallery',		
		buttons: {
                Ok: function() {
					returnInp = inputVideoId;
					
					if( $(".boxSelected").length > 0 )
					{
						console.log($(".boxSelected"),'xas');
						img = $(".boxSelected").eq(0).attr('boxId');	
						url = $(".boxSelected").eq(0).attr('url');
						$('#videoThumb').html('');
						$('#videoElem_1').tmpl({url_video : url}).appendTo('#videoThumb');
						
						$("#"+returnInp).val( img );							
							
					}
					
					$( this ).dialog( "close" );
                }
        },
		
		close: function(){
			$(this).dialog('destroy');
		},
		open: function (){ 
			callAjax("/blog/videos/gallery" , false, '.gallery' , 'showGalleryVideo' ); 
		}
	});	
});


		
function showGalleryVideo( data ){			
	$('#dlgGallery').html('');
			
	//$.tmpl("#cntGallery", {data: data }   ).appendTo("#dlgGallery");	
	//$.tmpl("boxVideo", {Video: data.videos , tmpl :  }   ).appendTo("#gallery");	
	//$.tmpl("paginator", {paginator: data.paginator}).appendTo("#paginator");
	
	// $("#gallery").tmpl(data).appendTo("#dlgGallery");
	$('#cntGallery').tmpl(data).appendTo('#dlgGallery');
	$('#dlgGallery').fadeIn();
	$('.lnkPag').click(function(){
		url = $(this).children('span').eq(0).attr('href');
		if( url && url.length > 0 )
		{
			$('#dlgGallery').fadeOut();
			callAjax(url , false, '.gallery' , 'showGalleryVideo' ); 
		}	
	});
}


$('.boxImage').live('click' , function (){
	if( $(this).hasClass('boxSelected') )
	{
		$(this).removeClass('boxSelected');		
	}	
	else
	{
		$('.boxImage').removeClass('boxSelected');
		$(this).addClass('boxSelected');
	}		
});




</script>