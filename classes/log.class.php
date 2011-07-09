<?php
class Log
{	
	private function __construct()
	{
	}
	
	public static function logAction($description)
	{
		$database = Database::getDatabaseObject();
		$res = $database->sendQuery("SELECT max(logid) FROM log;");
		$id = (int)$database->getField($res,0) + 1;
		$database->sendQuery("INSERT INTO log (logid,timestamp,address,description) VALUES('" .
								$id . "','" .
								date("Y-m-d H:i:s") . "','" .
								$_SERVER["REMOTE_ADDR"] . "','" .
								$description . "')");
	}
	
	public static function showErrorPage($errorInfo = NULL)
	{
		if (!is_array($errorInfo))
		{
			$errorInfo = error_get_last();
			if(!isset($errorInfo))
				exit();
		}
		require_once("views/error.view.php");
		exit();
	}
}
?>