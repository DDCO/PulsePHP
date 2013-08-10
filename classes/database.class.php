<?php
abstract class Database
{
	private static $instance;
	
	
	private function __construct(){}
	
	public static function singleton()
	{
		global $_CONFIG;
		switch($_CONFIG["driver"])
		{
			case "mysql":
				global $_CONFIG;
				self::$instance = new PDO('mysql:host='.$_CONFIG["host"].';dbname='.$_CONFIG["db"], $_CONFIG["username"], $_CONFIG["password"], array(PDO::ATTR_PERSISTENT=>true));
			break;
			case "mysqli":
			break;
			case "mssql":
			break;
			case "SQLite":
			break;
			case "PostgreSQL":
			break;
		}
		return self::$instance;
	}
	
	public static function getDatabaseObject()
	{
		return self::$instance;
	}
	
	public function sendQuery($query,$args=NULL)
	{
		$pdos = $this->instance->prepare($query);
		$pdos->execute($args);
		return $pdos;
	}
}
?>