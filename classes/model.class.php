<?php
class Model
{
	public function update($table,$data,$where)
	{
		$database = Database::getDatabaseObject();
		$sql = "UPDATE #__".$table." SET ";
		$args = array();
		$i = 0;
		
		foreach($data as $column => $value)
		{
			$sql .= $column . " = " . '@' . $i . ", ";
			$args["@".$i] = $value;
			$i++; 
		}
		$sql = substr($sql,0,strlen($sql)-2);
		$sql .= " WHERE ";
		foreach($where as $column => $value)
		{
			$sql .= $column . " = " . '@' . $i . " AND ";
			$args["@".$i] = $value;
			$i++; 
		}
		$sql = substr($sql,0,strlen($sql)-5);
		$database->sendQuery($sql,$args);
		return $database->affectedRows();
	}
	
	public function insert($table,$data)
	{
		$database = Database::getDatabaseObject();
		$sql = "INSERT INTO #__" . $table;
		$sql .= "(" . implode(',',array_keys($data)) . ") VALUES (";
		$args = array();
		$i = 0;

		foreach($data as $column => $value)
		{
			$sql .= '@' . $i . ',';
			$args["@".$i] = $value;
			$i++; 
		}
		
		$sql = substr($sql,0,strlen($sql)-1) . ");";
		
		$database->sendQuery($sql,$args);
		return $database->affectedRows();
	}
	
	public function delete($table,$where)
	{
		$database = Database::getDatabaseObject();
		$sql = "DELETE FROM #__" . $table;
		
		if(count($where))
		{
			$sql .= " WHERE ";
			$i = 0;
			$args = array();
			
			foreach($where as $column => $value)
			{
				$sql .= $column . " = " . '@' . $i;
				$args["@".$i] = $value;
				$i++; 
			}
		}
		$database->sendQuery($sql,$args);
		return $database->affectedRows();
	}
	
	public function select($table,$where)
	{
		$database = Database::getDatabaseObject();
		$sql = "SELECT * FROM #__" . $table;
		
		if(count($where))
		{
			$sql .= " WHERE ";
			$i = 0;
			$args = array();
			
			foreach($where as $column => $value)
			{
				$sql .= $column . " = " . '@' . $i;
				$args["@".$i] = $value;
				$i++; 
			}
		}
		$database->sendQuery($sql,$args);
		return $database->getRows();
	}
}
?>