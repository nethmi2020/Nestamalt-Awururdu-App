<?php 

require_once DOC_ROOT.'vendor/autoload.php';

use Medoo\Medoo;

class Wishess
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
            "sender_name" => strip_tags($data['sender_name']),
            "sender_mobnum" => strip_tags($data['sender_mobnum']),     
            "body" => strip_tags($data['body']),   
            "receiver_mobnum" => strip_tags($data['receiver_mobnum']),
			"receiver_name" => strip_tags($data['receiver_name']),    
            "created_at" => strip_tags($data['created_at'])
           
    
        ]);

        return $status;
	}



	
	function getApprovedAll(){
	$data = $this->connection->select($this->table_name, '*', 'WHERE approval_status =1 AND deleted_at IS NULL ORDER BY id DESC ');
	return $data;}


	function getRandom100(){
		$data = $this->connection->select($this->table_name, '*', 'WHERE approval_status =1 AND deleted_at IS NULL ORDER BY rand() limit 3');
	return $data;
	}


	
	
	function getCelebrityWishes(){
		$data = $this->connection->select($this->table_name, '*', 'WHERE approval_status =1 AND celebrity_status=1 AND deleted_at IS NULL  ORDER BY id DESC ');
	return $data;
	}

}
	
?>