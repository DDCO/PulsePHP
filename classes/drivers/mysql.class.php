<?php
class Mysql extends Database
{
	private $link;
	private $resource;
	
	public function __construct()
	{
		global $_CONFIG;
		if($this->link = mysql_connect($_CONFIG["host"],$_CONFIG["username"],$_CONFIG["password"]))
			mysql_select_db($_CONFIG["db"],$this->link);
	}
	
	/* 
	 *  Example query: SELECT * FROM users WHERE username = @username;
	 *  Example Args array: array ( "@username" => "admin" );
	 *  replace: SELECT * FROM users WHERE username = 'admin'; 
	 *	TODO: parent class should add args and table prefix
	 */
	public function sendQuery($query,$args=NULL)
	{
		global $_CONFIG;
		if(is_array($args))
		{
			foreach($args as $key => $value)
				$query = str_replace($key,'\''.mysql_real_escape_string($value).'\'',$query);
		}
		$query = str_replace("#__",$_CONFIG["tablePrefix"],$query);
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
	
	public function getRows()
	{
		$i = 0;
		while(true)
		{
			$temp[$i++] = mysql_fetch_assoc($this->resource);
			if(!$temp[$i])
				return $temp;
		}
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
	
	public function update()
	{
		return true;
	}
	
	public function insert()
	{
		return true;
	}
	
	public function select()
	{
		return true;
	}
}
?>