<?php
class Mysql extends Database
{
	private $link;
	
	public function __construct()
	{
		global $CONFIG;
		if($this->link = mysql_connect($CONFIG["host"],$CONFIG["username"],$CONFIG["password"]))
		{
			if(!mysql_select_db($CONFIG["db"],$this->link))
				Log::showErrorPage($this->getError());
		}
		else
			Log::showErrorPage($this->getError());
	}
	
	/* 
	 *  Example query: SELECT * FROM users WHERE username = @username;
	 *  Example Args array: array ( "@username" => "admin" );
	 *  replace: SELECT * FROM users WHERE username = 'admin'; 
	 */
	public function sendQuery($query,$args=NULL)
	{
		if(is_array($args))
		{
			foreach($args as $key => $value)
				$query = preg_replace('/'.$key.'/','\''.mysql_real_escape_string($value).'\'',$query);
		}
		return mysql_query($query,$this->link);
	}
	
	public function affectedRows()
	{
		return mysql_affected_rows($this->link);
	}
	
	public function getRow($resource)
	{
		if(!is_resource($resource))
			return false;
		return mysql_fetch_assoc($resource);
	}
	
	public function getField($resource,$index)
	{
		if(!is_resource($resource))
			return false;
		return mysql_result($resource,$index);
	}
	
	public function countRows($resource)
	{
		if(!is_resource($resource))
			return false;
		return mysql_num_rows($resource);
	}
	
	public function getError()
	{
		return array ( "type" => mysql_errno($this->link), "message" => mysql_error($this->link), "file" => __FILE__, "line" => __LINE__ );
	}
}
?>