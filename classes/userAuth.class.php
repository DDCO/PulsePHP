<?php
class userAuth
{
	public $loginPage = "example/login";
	
	public function __construct(){}
	
	public function isLoggedIn()
	{
		if(empty($_SESSION["IsLoggedIn"]) || $_SESSION["IsLoggedIn"] == false)
			return false;
		return true;
	}
	
	public function authenticate()
	{		
		$username = $_POST["username"];
		if(User::userExists($username))
		{
			$clearPassword = $_POST["password"];
			$password = explode(':',User::getPassword($username));
			$hash = $password[0];
			$salt = $password[1];
			
			if(crypt($clearPassword,$salt)===$hash)
			{
				$_SESSION["IsLoggedIn"] = true;
				$_SESSION["user"] = array( 
					"username" => $username,
					"password" => $password,
					"clearPassword" => $clearPassword,
					"email" => User::getEmail($username),
					"usergroup" => User::getUsergroup($username) 
				);
				$this->redirect("example/index");
			}
		}
		return false;
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION = array();
		setcookie('PHPSESSID='.$_COOKIE['PHPSESSID'],'',time()-36000,'/');
	}
	
	public function redirect($page)
	{
		header("Location: http://".$_SERVER["SERVER_NAME"] . '/' . $page);
		exit();
	}
}
?>