<?php 

if ($this->Paginator->hasPage(2)) {
	$data['paginator']['prev'] = $this->Paginator->prev('<<',array('class'=>'btn lnkPag')) ;
	$data['paginator']['next'] = $this->Paginator->next('>>',array('class'=>'btn lnkPag')) ;
	
} 
$data['paginator']['numbers'] = $this->Paginator->numbers(array('class'=>'btn lnkPag','separator'=> false)); 

/*
foreach($videos as $key => $video)
{
	$videos_t[] = $video['Video'];
}
$data['videos'] = $videos_t;
*/
$data['videos'] = $videos;
//$data['videos'] = array();


//echo print_r($data, true);

echo json_encode($data );

?>