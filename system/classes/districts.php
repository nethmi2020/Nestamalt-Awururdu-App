<?php 

require_once DOC_ROOT.'vendor/autoload.php';

use Medoo\Medoo;

class Districts
{
	private $table_name = "district";
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
            "first_name" => strip_tags($data['first_name']),
            "last_name" => strip_tags($data['last_name']),
            "email" => strip_tags($data['email']),
            "username" => strip_tags($data['username']),
            "password" => md5(strip_tags($data['password'])),
            "created_at" => strip_tags($data['created_at'])
        ]);

        return $status;
	}

	function update($data){

		if(strip_tags($data['password']) != ''){
			$status = $this->connection->update($this->table_name, [
	            "first_name" => strip_tags($data['first_name']),
	            "last_name" => strip_tags($data['last_name']),
	            "email" => strip_tags($data['email']),
	            "username" => strip_tags($data['username']),
	            "password" => md5(strip_tags($data['password'])),
	            "updated_at" => strip_tags($data['updated_at'])
	        ], ["id" => strip_tags($data['id'])]);
	    }else{
	    	$status = $this->connection->update($this->table_name, [
	            "first_name" => strip_tags($data['first_name']),
	            "last_name" => strip_tags($data['last_name']),
	            "email" => strip_tags($data['email']),
	            "username" => strip_tags($data['username']),
	            "updated_at" => strip_tags($data['updated_at'])
	        ], ["id" => strip_tags($data['id'])]);
	    }

        return $status;
	}

	function updateStatus($status,$id){
		$status = $this->connection->update($this->table_name, [
            "status" => $status
            
        ], ["id" => $id]);
        return $status;
	}

	function delete($id){

		$status = $this->connection->delete($this->table_name, " WHERE id=$id ");
		return $status;
	}

	function selectAll(){

		$data = $this->connection->select($this->table_name, '*', ' ORDER BY dname ASC');
		return $data;
	}

	function selectAllQuery(){
		return "SELECT * FROM $this->table_name";
	}

	function getById($id){

		$data = $this->connection->select($this->table_name, '*', " WHERE did=$id ");
		return $data;
	}

	function getByUsernameAndPassword($username, $password){
		$data = $this->connection->select($this->table_name, '*', " WHERE username='$username' AND password='".md5($password)."'");
		return $data;
	}

}

?>