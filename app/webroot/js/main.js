$(document).ready(function() {

/*	$('.ajax > a, a.ajax').live('click', function (){
			return false;
	});
	*/
		
});
/*
$(".ajax").live( $(this).attr('event') , function (){
	controller = $(this).attr('href');
	func = $(this).attr('func');
	
	callAjax( controller ,  );
} );
*/



/*
*controller string call the controller
*param string parameter by post
*fun string function declared previous, that process the data response
*noHideBtn boolean if is hide all the buttons ajax (to prevent double click) or not
*ajax_options array extra options for the ajax called
*/
function callAjax( controller, params,  content , func , ajax_options )
{
	//noHideBtn = noHideBtn || false;										
	func = func || '';	//if we call anoter function
	content = content || 'div_form_req';
	ajax_options = ajax_options || [];
	
	
	default_options =  {
				  url: controller, 	
				  type: 'POST',
				  async: true,
				  dataType: 'json',
				  data: params,
				  crossDomain: true,
				  beforeSend :setTypeAjaxCalling,
				  success: function(data, textStatus, jqXHR){															
					
					if( func == 'default' )
					{
						mAlert( data.res );
					}
					else if( func != '')
					{								
						return window[func].apply(null, arguments);
					}							
					else{
						$(content).html("");
						console.log(content);
						$(content).html(data);
					}																								
				},
				error: errorAjax	
	};

	//we merge the ajax options
	var total_options = $.extend({}, default_options, ajax_options);					
						
	$.ajax(total_options);	
}



//function that set the type of the request for ajax
function setTypeAjaxCalling(xhr) {
	xhr.setRequestHeader('type-calling', '700');								
}

function errorAjax(XMLHttpRequest, textStatus, errorThrown){
						//if the status was not logued
	 if(XMLHttpRequest.status == 700)
	 {
		
		redirectLogin(errorThrown);
	 }
	 else	//general error
	 {
		mAlert("Occurs an error from the server");
	 }			
	 
}

function mAlert( data ){
	alert(data);
}