<?php 

require_once '../config.php';

$action = strip_tags($_POST['action']); 

switch ($action) {
	case 'index':
		index();
		break;

	case 'store':
		store();
		break;

	case 'edit':
		edit();
		break;

	case 'update':
		update();
		break;

	case 'destroy':
		destroy();
		break;

	case 'setstatus':
		setstatus();
		break;

	case 'indexapproval':
		indexapproval();
		break;

	case 'getwishes':
		getwishes();
		break;

	case 'day1winners':
		day1winners();
		break;

	case 'day2winners':
		day2winners();
		break;
    

    case 'day3winners':
		day3winners();
		break;

	case 'mywish':
		mywish();
		break;
    
    

}


function index(){ 

	$domains = new Wishes();
	$page = strip_tags($_POST['page']);
	$limit = 10000;
	$link = SITE_URL.'wish/?page=';
	$class = 'pagination';

	$Pager = new Pager();
	$query = $domains->selectAllQuery();
	$Buttons = array('&laquo;', '&raquo;');

	$all = $domains->selectAll();


	$pagination = '';

	$data = $Pager->pager($query, $page, $limit); //print_r($data);
	if(count($all)>$limit){
		$Pager->getPager();
		$pagination .= $Pager->getPagerStyle($Buttons, $class, $link);
	}
	
	//$data = $domainsains->selectAll();

	$out = '';
	$modal = '';
	// print_r($all);die();
	$district = new Districts();

	foreach ($data as $row) {

		$district_data = $district->getById($row['did']);

		if($row['aproval_status']==1){
			$class = "info";
			
		}else if($row['aproval_status']==0){
			$class = "danger";
		}else{
			$class = "warning";
		}

		$out .= '<tr id="row'.$row['id'].'" class="'.$class.'">';
		$out .= '<td>'.$row['id'].'</td>';
		$out .= '<td>'.$row['facebook_id'].'</td>';
		
		$out .= '<td>'.$row['first_name'].' '.$row['last_name'].'</td>';

		$out .= '<td>'.$district_data[0]['dname'].'</td>';

		$out .= '<td>'.$row['wish'].'</td>';

		$out .= '<td><img src="//graph.facebook.com/'.$row['facebook_id']. '/picture?"></td>';

			$out.= '<td><select id="status" name="status" class="form-control" onchange="setstatus(' . $row['id'] . ',this.value)">';
      

		    $out.= '<option ';
			$out.= ($row['aproval_status'] == 0) ? 'selected="selected"' : '';
			$out.= ' value="0">Pending</option>';

		    $out.= '<option ';
			$out.= ($row['aproval_status'] == 1) ? 'selected="selected"' : '';
			$out.= ' value="1">Approved</option>';

			$out.= '<option ';
			$out.= ($row['aproval_status'] == 2) ? 'selected="selected"' : '';
			$out.= ' value="2">Rejected</option>';
		 

		    $out.= '</select>';
			$out.= '<div id="' . $row['id'] . 'status_msg"><div></td>';
			
		
		$out .= '</td>';
		$out .= '</tr>';


	}

	foreach ($data as $row) {
		$modal .= '<div id="delete_'.$row['id'].'" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Delete Domain</h4>
				      </div>
				      <div class="modal-body">
				        <p>Are you sure you want to delete this domain.</p>
				      </div>
				      <div class="modal-footer">
				      <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
				        <button type="button" class="btn btn-danger" onclick="deleteDomain('.$row['id'].')">Yes</button>
				      </div>
				    </div>

				  </div>
				</div>';
	}

	
	echo json_encode(array('table'=>$out,'modal'=>$modal,'pagination'=>$pagination));
}



function indexapproval(){

	$domains = new Wishes();
	$page = strip_tags($_POST['page']);
	$limit = 10000;
	$link = SITE_URL.'wish/?page=';
	$class = 'pagination';

	$Pager = new Pager();
	$query = $domains->selectAllQueryApproval();
	$Buttons = array('&laquo;', '&raquo;');

	$all = $domains->selectAllApproval();

	$pagination = '';

	$data = $Pager->pager($query, $page, $limit); //print_r($data);
	if(count($all)>$limit){
		$Pager->getPager();
		$pagination .= $Pager->getPagerStyle($Buttons, $class, $link);
	}
	
	//$data = $domains->selectAll();

	$out = '';
	$modal = '';

	$district = new Districts();

	foreach ($data as $row) {

		$district_data = $district->getById($row['did']);

		if($row['aproval_status']==0){
			$class = "info";
			
		}else if($row['aproval_status']==2){
			$class = "danger";
		}else{
			$class = '';
		}

		$out .= '<tr id="row'.$row['id'].'" class="'.$class.'">';
		$out .= '<td>'.$row['id'].'</td>';
		$out .= '<td>'.$row['facebook_id'].'</td>';
		
		$out .= '<td>'.$row['first_name'].' '.$row['last_name'].'</td>';

		$out .= '<td>'.$district_data[0]['dname'].'</td>';

		$out .= '<td>'.$row['wish'].'</td>';

		$out .= '<td><img src="//graph.facebook.com/'.$row['facebook_id']. '/picture?"></td>';
		
// 		 $out .= '<td><input type="text" class="form-control" name="lat_'.$row['id'].'" id="lat_'.$row['id'].'" placeholder="Lat" value="'.$row['lat'].'"></td>';
	    
// 	    $out .= '<td><input type="text" class="form-control" name="lang_'.$row['id'].'" id="lang_'.$row['id'].'" placeholder="Lat" value="'.$row['lang'].'"></td>';

			$out.= '<td><select id="status" name="status" class="form-control" onchange="setstatus(' . $row['id'] . ',this.value)">';
      

		    $out.= '<option ';
			$out.= ($row['aproval_status'] == 0) ? 'selected="selected"' : '';
			$out.= ' value="0">Pending</option>';

		    $out.= '<option ';
			$out.= ($row['aproval_status'] == 1) ? 'selected="selected"' : '';
			$out.= ' value="1">Approved</option>';

			$out.= '<option ';
			$out.= ($row['aproval_status'] == 2) ? 'selected="selected"' : '';
			$out.= ' value="2">Rejected</option>';
		 

		    $out.= '</select>';
			$out.= '<div id="' . $row['id'] . 'status_msg"><div></td>';
			
		
		$out .= '</td>';
		$out .= '</tr>';


	}

	foreach ($data as $row) {
		$modal .= '<div id="delete_'.$row['id'].'" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Delete Domain</h4>
				      </div>
				      <div class="modal-body">
				        <p>Are you sure you want to delete this domain.</p>
				      </div>
				      <div class="modal-footer">
				      <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
				        <button type="button" class="btn btn-danger" onclick="deleteDomain('.$row['id'].')">Yes</button>
				      </div>
				    </div>

				  </div>
				</div>';
	}

	
	echo json_encode(array('table'=>$out,'modal'=>$modal,'pagination'=>$pagination));

}

function create(){
  echo 'create';
}

function store(){

	$data = $_POST;
	$data['user_id'] = $_SESSION['userID'];
	$data['email'] = $_SESSION['email'];
	$data['first_name'] = $_SESSION['first_name'];
	$data['last_name'] = $_SESSION['last_name'];
	$data['fbToken'] = $_SESSION['fbToken'];

	$date = date("Y-m-d H:i:s");
	$data['created_at'] = $date;	

	$data['ip'] = $_SERVER['REMOTE_ADDR'];
	$data['origin'] = $_SERVER['HTTP_ORIGIN'];

	$wish_string = $data['wish'];

	$newString = str_replace('"', "", $wish_string);
    $newString1 = str_replace("'", "", $newString);
    
    // $newString2 = preg_replace('/[^\p{L}\p{N}\s]/u', '', $wish_string);

    $data['wish'] = $newString1;

	if(!isset($_SESSION["token"])){
	    session_destroy();
		echo 500;

	}else if ($data['user_id'] != null){

		if ($data['district'] == 0) {
			echo 401;
		}else{
			$wish = new Wishes();
			$is_exist = $wish->getByFbId2($data['user_id']);

			if ($is_exist) {
				$data['id'] = $is_exist[0]['id'];
				$store = $wish->update($data);

				
			}else{
				$store = $wish->store($data);
			}

			if ($store) {
				echo 200;
			}else{
				echo 400;
			}
		}

		

	}else{
		echo 500;
	}

	
}

function show(){
  echo 'show';
}

function edit(){
  echo 'edit';
}

function update(){

	//print_r($_POST);die();

	$date = date("Y-m-d H:i:s");

	$data = $_POST;
	$data['updated_at'] = $date;


	$domains = new Domains();
	$updates = $domains->update($data);

	

	if($updates){
		echo 200;
	}else{
		echo 400;
	}
}

function destroy(){
	
	$domains = new Domains();
	$delete = $domains->delete(strip_tags($_POST['id']));

	if($delete){
		echo 200;
	}else{
		echo 400;
	}
}


function setstatus(){

	 $data = $_POST;

	// print_r($data);die();

	 $domains = new Wishes();
	 $insert  = $domains->setAsStatus($data);	
	
	 echo $data['id'];


}

function getwishes(){

	$wishes = new Wishes();
	$data = $wishes->getApprovedNotWin();

	$out = '';

	foreach ($data  as $value) {
		$out .= '<span class="light"> <span class="tool-tip"><div class="span-img" style="background-image: url(//graph.facebook.com/'.$value['facebook_id'].'/picture?);"></div><div class="span-details"><p class="span-name">'.$value['first_name'].'</p><p class="span-msg">'.$value['wish'].'</p></div></span></span>';
	}


    echo json_encode(array('out'=>$out));
}



function day1winners(){

	$wishes = new Wishes();
	$data = $wishes->getApprovedNotWin();

	$array = array();

	foreach ($data as $key => $value) {
		$array[$key] = $value['id'];
	}

	$your_array=$array;
    shuffle($your_array); // randomize the order
    $your_array = array_slice($your_array, 0, 1); //pick 2

    $error = 0;
    
    for ($i=0; $i < sizeof($your_array) ; $i++) { 
    	//$set_winner = $wishes->setDay1winner($your_array[$i]);

    	if ($set_winner) {
    		$error++;
    	}
    }

    if ($day1_winner == 0) {
    	echo 200;
    }else{
    	echo 400;
    }


}


function day2winners(){

	$wishes = new Wishes();
	$data = $wishes->getApprovedNotWin();

	$array = array();

	foreach ($data as $key => $value) {
		$array[$key] = $value['id'];
	}

	$your_array=$array;
    shuffle($your_array); // randomize the order
    $your_array = array_slice($your_array, 0, 1); //pick 2

    $error = 0;
    
    for ($i=0; $i < sizeof($your_array) ; $i++) { 
    	$set_winner = $wishes->setDay2winner($your_array[$i]);

    	if ($set_winner) {
    		$error++;
    	}
    }

    if ($day1_winner == 0) {
    	echo 200;
    }else{
    	echo 400;
    }


}


function day3winners(){

	$wishes = new Wishes();
	$data = $wishes->getApprovedNotWin2();

	$array = array();

	foreach ($data as $key => $value) {
		$array[$key] = $value['id'];
	}

	$your_array=$array;
    shuffle($your_array); // randomize the order
    $your_array = array_slice($your_array, 0, 1); //pick 2

    $error = 0;
    
    for ($i=0; $i < sizeof($your_array) ; $i++) { 
    	$set_winner = $wishes->setDay3winner($your_array[$i]);

    	if ($set_winner) {
    		$error++;
    	}
    }

    if ($day1_winner == 0) {
    	echo 200;
    }else{
    	echo 400;
    }


}


function mywish(){

	$wishes = new Wishes();
	$data = $wishes->getMywish($_POST['id']);


	$out = '';

	if ($data){
		$out .= '<span class="light my-light" style="background-image:url(//graph.facebook.com/'.$data[0]['facebook_id'].'picture?)" data-name="'.$data[0]['first_name'].'" data-image="//graph.facebook.com/'.$data[0]['facebook_id'].'picture?" data-msg="'.$data[0]['wish'].'"></span>';
	}

	
	
	

    echo json_encode(array('mywish'=>$out));
}

?>