<?php
class example extends Controller
{
	/*
	* Model is automatically included if exists. As long as you follow the naming conventions
	* You can access it from $this->model. Also add all your variable to $this->TPL so the view
	* can have access to it.
	*/
	public function index()
	{
		$auth = new userAuth();
		$this->TPL["isLoggedIn"] = $auth->isLoggedIn();
	}
	
	public function login()
	{
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
				$this->TPL["auth"] = $auth->authenticate();
			else
				$this->TPL["errors"] = $result;
		}
	}
	
	public function logout()
	{
		$auth = new userAuth();
		$auth->logout();
		$auth->redirect("example/index");
	}
	
	public function register()
	{
		$auth = new userAuth();
		if($auth->isLoggedIn())
			$auth->redirect("example/index");
			
		$result = $this->model->registrationFormValidate();
		if($result === true)
			$this->model->addNewUser();
		else
			$this->TPL["errors"] = $result;
	}
}
?>