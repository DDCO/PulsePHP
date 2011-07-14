<?php
class User
{
	private function __construct(){}
	private function __clone(){}
	
	public static function getUsergroup($user)
	{
		$database = Database::getDatabaseObject();
		$res = $database->sendQuery("SELECT usergroup FROM users WHERE username = @user",array("@user"=>$user));
		return $database->getField(0);
	}
	
	public static function getEmail($user)
	{
		$database = Database::getDatabaseObject();
		$res = $database->sendQuery("SELECT email FROM users WHERE username = @user",array("@user"=>$user));
		return $database->getField(0);
	}
	
	public static function getPassword($user)
	{
		$database = Database::getDatabaseObject();
		$res = $database->sendQuery("SELECT password FROM users WHERE username = @user",array("@user"=>$user));
		return $database->getField(0);
	}
	
	public static function userExists($user)
	{
		$database = Database::getDatabaseObject();
		$res = $database->sendQuery("SELECT * FROM users WHERE username = @user",array("@user"=>$user));
		if ($database->countRows()>0)
			return true;
		return false;
	}
	
	//Returns salt for Blowfish crypt
	public static function generateSalt()
	{
		$salt = "$2a$";
		$salt .= "$10$"; //Cost parameter (higher number = lower performance && higher number = more secure) must be from 4-31
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$len = strlen($chars);
		for($i = 0; $i < 22; $i++)
			$salt .= $chars[rand(0,$len-1)];
		$salt .= "$";
	}
	
	public static function addUser($user,$pass,$email,$group)
	{
		$database = Database::getDatabaseObject();
		if (!self::userExists($user))
		{
			$salt = self::generateSalt();
			$hash = crypt($pass,$salt);
			$res = $database->sendQuery("SELECT max(userid) FROM users;");
			$id = (int)$database->getField($res,0) + 1;
			$res = $database->sendQuery("INSERT INTO users VALUES('".$id."',@user,@pass,@email,@group);",array(
				"@user"=>$user,
				"@pass"=>$pass,
				"@email"=>$email,
				"@group"=>$group
			));
			if($database->affectedRows($res) > 0)
			{
				Log::logAction("User " . $user . " created");
				return true;
			}
		} 
		else
			Log::showErrorPage(array("type"=>"1000","message"=>"User already exists","file"=>__FILE__,"line"=>__LINE__));
	}
	
	public static function deleteUser($user)
	{
		$database = Database::getDatabaseObject();
		$res = $database->sendQuery("DELETE FROM users WHERE username = @user",array("@user"=>$user));
		if($database->affectedRows() > 0)
		{
			Log::logAction("User " . $user . " Deleted");
			return true;
		}
		Log::showErrorPage();
	}
	
	public static function updateUsergroup($user, $group)
	{
		$database = Database::getDatabaseObject();
		$res = $database->sendQuery("UPDATE users SET usergroup = @group WHERE username = @user",array("@group"=>$group,"@user"=>$user));
		if($database->affectedRows() > 0)
		{
			Log::logAction("Updated usergroup of user " . $user);
			return true;
		}
		Log::showErrorPage();
	}
	
	public static function updatePassword($user,$pass)
	{
		$database = Database::getDatabaseObject();
		$res = $database->sendQuery("UPDATE users SET password = @pass WHERE username = @user",array("@pass"=>$pass,"@user"=>$user));
		if($database->affectedRows() > 0)
		{
			Log::logAction("Updated password of user " . $user);
			return true;
		}
		Log::showErrorPage();
	}
	
	public static function updateEmail($user,$email)
	{
		$res = $database->sendQuery("UPDATE users SET email = @email WHERE username = @user",array("@email"=>$email,"@user"=>$user));
		if($database->affectedRows() > 0)
		{
			Log::logAction("Updated email of user " . $user);
			return true;
		}
		Log::showErrorPage();
	}
}
?>