<?php 

require_once DOC_ROOT.'vendor/autoload.php';

use Medoo\Medoo;

class Wishes
{
	private $table_name = "wishes";
	protected $connection;

	function __construct()
	{
		$database = new medoo([
		    'database_type' => 'mysql',
		    'database_name' => DB_NAME,
		    'server' => DB_HOST,
		    'username' => DB_USER,
		    'password' => DB_PASS,
		    'charset' => 'utf8'
		]); 

		$this->connection = $database;
	}

	
	function store($data){
		$status = $this->connection->insert($this->table_name, [
            "facebook_id" => strip_tags($data['user_id']),
            "email" => strip_tags($data['email']),     
            "first_name" => strip_tags($data['first_name']), 
            "last_name" => strip_tags($data['last_name']), 
            "fbToken" => strip_tags($data['fbToken']),
            "did" => strip_tags($data['district']),    
            "created_at" => strip_tags($data['created_at']),   
            "ip" => strip_tags($data['ip']),
            "origin" => strip_tags($data['origin']),
            "winner" => 0,
            "aproval_status" => 0,
            "wish" => strip_tags($data['wish'])
        ]);

        return $status;
	}

	function update($data){
		$status = $this->connection->update($this->table_name, [
            "facebook_id" => strip_tags($data['user_id']),
            "email" => strip_tags($data['email']),     
            "first_name" => strip_tags($data['first_name']), 
            "last_name" => strip_tags($data['last_name']), 
            "fbToken" => strip_tags($data['fbToken']),
            "did" => strip_tags($data['district']),    
            "ip" => strip_tags($data['ip']),
            "origin" => strip_tags($data['origin']),
            "winner" => 0,
            "aproval_status" => 0,
            "wish" => strip_tags($data['wish']),          
            "updated_at" => strip_tags($data['created_at'])
        ], ["id" => strip_tags($data['id'])]);

        return $status;
	}


	function setDay1winner($id){
		$status = $this->connection->update($this->table_name, [
            "winner" => 1,
            "day1_winner" => 1,
        ], ["id" => strip_tags($id)]);

        return $status;
	}


	function setDay2winner($id){
		$status = $this->connection->update($this->table_name, [
            "winner" => 1,
            "day2_winner" => 1,
        ], ["id" => strip_tags($id)]);

        return $status;
	}

	function setDay3winner($id){
		$status = $this->connection->update($this->table_name, [
            "winner" => 1,
            "day3_winner" => 1,
        ], ["id" => strip_tags($id)]);

        return $status;
	}



	function delete($id){

		$status = $this->connection->delete($this->table_name, " WHERE id=$id ");
		return $status;
	}

	function selectAll(){

		$data = $this->connection->select($this->table_name, '*', 'WHERE aproval_status=1 ORDER BY id ASC');
		return $data;
	}
	
	function selectAllNew(){

		$data = $this->connection->select($this->table_name, '*', 'ORDER BY did ASC');
		return $data;
	}


	function getApprovedNotWin(){

		$data = $this->connection->select($this->table_name, '*', 'WHERE aproval_status=1 AND winner=0 ORDER BY rand() LIMIT 500');
		return $data;
	}

	function getApprovedWishRandom(){
		$data = $this->connection->select($this->table_name, '*', 'WHERE aproval_status=1 ORDER BY rand() LIMIT 500');
		return $data;
	}

	function getApproved(){
		$data = $this->connection->select($this->table_name, '*', 'WHERE aproval_status=1 ORDER BY id DESC');
		return $data;
	}
	
	function getApprovedNotWin2(){

		$data = $this->connection->select($this->table_name, '*', 'WHERE aproval_status=1 AND winner=0 ORDER BY id DESC LIMIT 500');
		return $data;
	}

	function getDayWinners(){

		$data = $this->connection->select($this->table_name, '*', 'WHERE day1_winner=1 ORDER BY id ASC');
		return $data;
	}

	function getDay2Winners(){

		$data = $this->connection->select($this->table_name, '*', 'WHERE day2_winner=1 ORDER BY id ASC');
		return $data;
	}

	function getDay3Winners(){

		$data = $this->connection->select($this->table_name, '*', 'WHERE day3_winner=1 ORDER BY id ASC');
		return $data;
	}



	function selectAllApproval(){

		$data = $this->connection->select($this->table_name, '*', 'WHERE aproval_status !=1 ORDER BY id ASC');
		return $data;
	}
	
	function getApprovedPage($offset,$no_of_records_per_page){
	    $data = $this->connection->select($this->table_name, '*', "WHERE aproval_status =1 ORDER BY id DESC LIMIT $offset,$no_of_records_per_page");
		return $data;
	}
	
	function getApprovedPageNew($offset,$no_of_records_per_page){
	    $data = $this->connection->select($this->table_name, '*', "ORDER BY did ASC LIMIT $offset,$no_of_records_per_page");
		return $data;
	}

	function selectAllQuery(){
		return "SELECT * FROM wishes WHERE aproval_status=1  ORDER BY id ASC";
	}

	function selectAllQueryApproval(){
		return "SELECT * FROM wishes WHERE 	aproval_status !=1 ORDER BY id ASC";
	}
	
	
	function getCount(){
	    return "SELECT COUNT(*) FROM wishes WHERE 	aproval_status =1 ORDER BY id DESC";
	}


	function getById($id){

		$data = $this->connection->select($this->table_name, '*', " WHERE id=$id ");
		return $data;
	}

	function getByFbId($id){

		$data = $this->connection->select($this->table_name, '*', " WHERE facebook_id=$id AND aproval_status =1 ");
		return $data;
	}
	
	function getByFbId2($id){

		$data = $this->connection->select($this->table_name, '*', " WHERE facebook_id=$id");
		return $data;
	}

	function getByDid($did){
		$data = $this->connection->select($this->table_name, '*', " WHERE did=$did AND aproval_status =1");
		return $data;
	}

	function getMywish($id){

		$data = $this->connection->select($this->table_name, '*', " WHERE facebook_id=$id AND aproval_status =1 AND winner= 0 ");
		return $data;
	}

	function getAllCount(){

		$data = $this->connection->select($this->table_name, '*');
		return count($data);
	}

	function getFirstReminderSentCount(){

		$data = $this->connection->select($this->table_name, '*', " WHERE status=2 ");
		return count($data);
	}

	function getSecondReminderSentCount(){

		$data = $this->connection->select($this->table_name, '*', " WHERE status=3 ");
		return count($data);
	}


// 	function setAsStatus($data){
// 		$status = $this->connection->update($this->table_name, [
//             "aproval_status" => strip_tags($data['status']),
//             "lat" => strip_tags($data['lat']),
//             "lang" => strip_tags($data['lang'])
            
//         ], ["id" => strip_tags($data['id'])]);
//         return $status;
// 	}
	
	function setAsStatus($data){
		$status = $this->connection->update($this->table_name, [
            "aproval_status" => strip_tags($data['status'])
            
        ], ["id" => strip_tags($data['id'])]);
        return $status;
	}


	function selectAllData($data){

		  $data = $this->connection->query("SELECT * FROM $this->table_name WHERE status=1 AND username LIKE '$data%'")->fetchAll();
          return $data;

	}
	
	function getRejected(){

		$data = $this->connection->select($this->table_name, '*', 'WHERE aproval_status = 2 ORDER BY id ASC');
		return $data;
	}
	
	function getPending(){

		$data = $this->connection->select($this->table_name, '*', 'WHERE aproval_status = 0 ORDER BY id ASC');
		return $data;
	}


	function selectAllDatacategory($data){


		if($data == NULL) {


		  $data = $this->connection->query("SELECT * FROM $this->table_name WHERE status=1")->fetchAll();
          return $data;



		}else{

		  $data = $this->connection->query("SELECT * FROM $this->table_name WHERE status=1 AND category=$data ")->fetchAll();
          return $data;


		}

		 

	}

	


}

?>