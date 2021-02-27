<?php 

require_once '../config.php';

$action = strip_tags($_POST['action']); 

switch ($action) {
	

	case 'device_register':
		device_store();
		break;

   case 'wish_store':
         wish_store();
         break;

         case 'allwishes_approved':
            allwishes_approved();
            break;

    case 'getrandom_wishes':
         getrandom_wishes();
         break;


}

function device_store(){

    $data = $_POST;

    $device_token=$data['token'];

    $token = new Token();
    $token_data= $token->getByDeviceId( $device_token);
    if ( $token_data) {
        $data_set[0]['resp'] =300;
    }else{
        $insert= $token->store($data);
        
//check whethe  data is properly inserted or not
        if($insert)
        {
            $data_set[0]['resp'] =200;
        }else{
            $data_set[0]['resp'] =400;
        }
    }

    // $data_set_user = $app_user->getByIdForfblogin($user_fb_id);

    //  $token_data[0]['resp'] =200;

    print json_encode( $data_set) ;



   

	
}

function wish_store(){

	$data = $_POST;


    // print_r($data);
	
    $date = date("Y-m-d H:i:s");
	$data['created_at'] = $date;

	$wish=new Wishess();
	$insert= $wish->store($data);


	if($insert)
	{
		$data_set[0]['resp'] =200;
	}else{
		$data_set[0]['resp'] =400;
	}

	print json_encode( $data_set);
	// print json_encode( $data) ;

    // print($data);
}



function allwishes_approved(){

    // print_r($_POST);die();

	$wishes = new Wishess();
	$data_set = $wishes->getApprovedAll();


	// print_r($data_set);



    if(count($data_set)>0 && !empty($data_set)){
		    
	
         $data_set[0]['resp'] =200; 


         print json_encode($data_set);


    }else if(empty($data_set)){

        $data_set[0]['resp'] =300; 
        print json_encode($data_set);

    }else{


         $data_set[0]['resp'] = 400;

         print json_encode($data_set);

    }

	

	


    echo json_encode(array('out'=>$out));
}

?>