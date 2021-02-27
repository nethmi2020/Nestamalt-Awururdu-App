<?php 

require_once DOC_ROOT.'vendor/autoload.php';

use Medoo\Medoo;

class Common
{
	/*
	* @return an array of time periods that reminders need to send
	*/
	static function getReminderPeriodsArray(){
		return array("1 Week", "2 Weeks", "1 Month", "2 Months", "3 Months");
	}

}