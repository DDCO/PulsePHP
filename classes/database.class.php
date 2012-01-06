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
				require_once(API_PATH."drivers/mysql.class.php");
				self::$instance = new Mysql();
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
	
	public function assembleQuery($query,$args=NULL)
	{
		global $_CONFIG;
		$query = str_replace("#__",$_CONFIG["tablePrefix"],$query);
		$query = self::$instance->escapeArgs($query,$args);
		return $query;
	}
	
	public abstract function sendQuery($query,$args=NULL);
	public abstract function affectedRows();
	public abstract function getRow();
	public abstract function getRows();
	public abstract function getField($index);
	public abstract function countRows();
	public abstract function getError();
	public abstract function escapeArgs($query,$args);
}
?>