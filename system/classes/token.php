<?php 

require_once DOC_ROOT.'vendor/autoload.php';

use Medoo\Medoo;

class Token
{
	private $table_name = "device";
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
            "token" => strip_tags($data['token'])
           
           
        ]);

        return $status;
	}

	function getByDeviceId( $device_token){

		$data = $this->connection->select($this->table_name, '*', " WHERE token=  '$device_token' ");
		return $data;
	}


}

?>