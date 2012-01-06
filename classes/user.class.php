<?php
class User
{
	private function __construct(){}
	private function __clone(){}
	
	public static function getUserID($user)
	{
		$database = Database::getDatabaseObject();
		$database->sendQuery("SELECT id FROM #__users WHERE username = @user",array("@user"=>$user));
		return $database->getField(0);
	}
	
	public static function getUsergroup($user)
	{
		$database = Database::getDatabaseObject();
		$database->sendQuery("SELECT name FROM #__usergroups g JOIN #__users u ON (u.usergroupID = g.id) WHERE username = @user",array("@user"=>$user));
		return $database->getField(0);
	}
	
	public static function getEmail($user)
	{
		$database = Database::getDatabaseObject();
		$database->sendQuery("SELECT email FROM #__users WHERE username = @user",array("@user"=>$user));
		return $database->getField(0);
	}
	
	public static function getPassword($user)
	{
		$database = Database::getDatabaseObject();
		$database->sendQuery("SELECT password FROM #__users WHERE username = @user",array("@user"=>$user));
		return $database->getField(0);
	}
	
	public static function userExists($user)
	{
		$database = Database::getDatabaseObject();
		$database->sendQuery("SELECT * FROM #__users WHERE username = @user",array("@user"=>$user));
		if ($database->countRows()>0)
			return true;
		return false;
	}
	
	//Returns salt for Blowfish crypt
	public static function generateSalt()
	{
		$salt = "$2a";
		$salt .= "$10$"; //Cost parameter (higher number = lower performance && higher number = more secure) must be from 4-31
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$len = strlen($chars);
		for($i = 0; $i < 25; $i++)
			$salt .= $chars[rand(0,$len-1)];
		$salt .= "$";
		return $salt;
	}
	
	public static function addUser($user,$pass,$email,$group)
	{
		$database = Database::getDatabaseObject();
		if (!self::userExists($user))
		{
			$salt = self::generateSalt();
			$hash = crypt($pass,$salt);
			$database->sendQuery("INSERT INTO #__users (username,password,email,usergroupID) VALUES(@user,@pass,@email,@group);",array(
				"@user"=>$user,
				"@pass"=>$hash.':'.$salt,
				"@email"=>$email,
				"@group"=>$group
			));
			if($database->affectedRows() > 0)
				return true;
		}
		return false;
	}
	
	public static function deleteUser($user)
	{
		$database = Database::getDatabaseObject();
		$database->sendQuery("DELETE FROM #__users WHERE username = @user",array("@user"=>$user));
		if($database->affectedRows() > 0)
			return true;
		return false;
	}
	
	public static function updateUsergroup($user, $usergroupID)
	{
		$database = Database::getDatabaseObject();
		$database->sendQuery("UPDATE #__users SET usergroupID = @group WHERE username = @user",array("@group"=>$usergroupID,"@user"=>$user));
		if($database->affectedRows() > 0)
			return true;
		return false;
	}
	
	public static function updatePassword($user,$pass)
	{
		$database = Database::getDatabaseObject();
		$database->sendQuery("UPDATE #__users SET password = @pass WHERE username = @user",array("@pass"=>$pass,"@user"=>$user));
		if($database->affectedRows() > 0)
			return true;
		return false;
	}
	
	public static function updateEmail($user,$email)
	{
		$database->sendQuery("UPDATE #__users SET email = @email WHERE username = @user",array("@email"=>$email,"@user"=>$user));
		if($database->affectedRows() > 0)
			return true;
		return false;
	}
}
?>