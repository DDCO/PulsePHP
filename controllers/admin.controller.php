<?php
class example extends Controller
{
	public function index()
	{
		$auth = new userAuth();
		$TPL["isLoggedIn"] = $auth->isLoggedIn(); 
		$this->loadView(NULL,$TPL);
	}
	
	public function login()
	{
		$TPL = array();
		$auth = new userAuth();
		if($auth->isLoggedIn())
			$auth->redirect("example/index");
		
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			//form validation 
			$formArgs = array(
				"rules" => array(
					"username" => array(
						"required" => true
					),
					"password" => array(
						"required" => true
					)
				),
				"messages" => array(
					"username" => array(
						"required" => "Username field is required."
					),
					"password" => array(
						"required" => "Password field is required."
					)
				)
			);
			$result = formVal::validate($formArgs);
			if($result === true)
				$TPL["auth"] = $auth->authenticate();
			else
				$TPL["errors"] = $result;
		}
		$this->loadView("login",$TPL);
	}
	
	public function logout()
	{
		$auth = new userAuth();
		$auth->logout();
		$auth->redirect("example/index");
	}
}
?>