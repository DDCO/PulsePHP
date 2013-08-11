<?php
class Database extends PDO
{
	private static $instance;
	
	public function __construct($dbstr,$username=NULL,$password=NULL,$args=NULL)
	{
		parent::__construct($dbstr,$username,$password,$args);
	}
	
	public static function singleton()
	{
		global $_CONFIG;
		switch($_CONFIG["driver"])
		{
			case "mysql":
				self::$instance = new Database('mysql:host='.$_CONFIG["host"].';dbname='.$_CONFIG["db"], $_CONFIG["username"], $_CONFIG["password"], array(PDO::ATTR_PERSISTENT=>true));
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
		global $_CONFIG;
		$query = str_replace("#__",$_CONFIG["tablePrefix"],$query);
		$pdos = $this->prepare($query);
		$pdos->execute($args);
		return $pdos;
	}
}
?>