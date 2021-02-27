<?php 

require_once '../config.php';

$action = strip_tags($_GET['action']); 

switch ($action) {
	case 'allwishes_approved':
		allwishes_approved();
		break;

	case 'getrandom_wishes':
		getrandom_wishes();
		break;

}




function allwishes_approved(){

	$wishes = new Wishess();
	$data = $wishes->getApprovedAll();
	// print_r($data);

	$out = '';
	

	foreach ($data  as $value) {
		
	
		$out .= '<td>'.$value['sender_name'].'</td>';	
		$out .= '<td>'.$value['sender_mobnum'].'</td>';	
		$out .= '<td>'.$value['receiver_name'].'</td>';	
		$out .= '<td>'.$value['receiver_mobnum'].'</td>';	
		$out .= '<td>'.$value['body'].'</td>';	
			
		// $out.='<p>.$value['sender_name'].'  '.$value['sender_mobnum'].'  '.$value['receiver_name'].'
		//  '.$value['receiver_mobnum'].' '.$value['body'].';
	}


    echo json_encode(array('out'=>$out));
}


function  getrandom_wishes(){
	
}



?>