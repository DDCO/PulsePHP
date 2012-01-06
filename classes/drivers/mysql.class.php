<?php
class Mysql extends Database
{
	protected $link;
	protected $resource;
	
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
		$query = parent::assembleQuery($query,$args); // Calls escapeArgs and replaces #__ placeholder with database prefix.
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
		$temp = array();
		while($row = mysql_fetch_assoc($this->resource))
			$temp[] = $row;
		return $temp;
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
	
	public function escapeArgs($query,$args)
	{
		if(is_array($args))
		{
			foreach($args as $key => $value)
				$query = str_replace($key,'\''.mysql_real_escape_string($value).'\'',$query);
		}
		return $query;
	}
}
?>