<?php 

require_once DOC_ROOT.'vendor/autoload.php';

use Medoo\Medoo;

class Sessions
{

	static function setAdminLoginDetails($admin_id,$admin_username,$admin_full_name){
		$_SESSION["admin_id"] = $admin_id;
		$_SESSION["admin_username"] = $admin_username;
		$_SESSION["admin_full_name"] = $admin_full_name;
		$_SESSION["is_admin_logged"] = true;
	}

	static function setAdminLoginDetailsnew($admin_id,$admin_username){
		$_SESSION["admin_id"] = $admin_id;
		$_SESSION["admin_username"] = $admin_username;
		$_SESSION["is_admin_logged"] = true;
	}		

	static function isAdminLogged(){
		if(isset($_SESSION['is_admin_logged']) && $_SESSION['is_admin_logged']==true){
			return true;
		}else{
			return false;
		}
	}

	static function getAdminId(){
		return $_SESSION["admin_id"];
	}

	static function getAdminFullName(){
		return $_SESSION["admin_full_name"];
	}
	
	static function adminRedirectOnNotLoggedIn(){

		if(!Sessions::isAdminLogged()){
		  header("Location: ".SITE_URL."login.php");
		  exit();
		}

	}
	static function logoutAdmin(){
		unset($_SESSION["admin_id"]);
		unset($_SESSION["admin_username"]);
		unset($_SESSION["is_admin_logged"]);
		unset($_SESSION["admin_full_name"]);
	}

}