<?php
class Mysql extends Database
{
	private $link;
	private $resource;
	
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
		$this->resource = mysql_query($query,$this->link);
	}
	
	public function affectedRows()
	{
		return mysql_affected_rows($this->link);
	}
	
	public function getRow()
	{
		return mysql_fetch_assoc($this->resource);
	}
	
	public function getField($index)
	{
		return mysql_result($this->resource,$index);
	}
	
	public function countRows()
	{
		return mysql_num_rows($this->resource);
	}
	
	public function getError()
	{
		return array ( "type" => mysql_errno($this->link), "message" => mysql_error($this->link), "file" => __FILE__, "line" => __LINE__ );
	}
}
?>