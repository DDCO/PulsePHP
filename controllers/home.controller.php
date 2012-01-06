<?php
class home extends Controller
{
	/*
	* ACL Example
	* public $acl = array(
	*	{usergroup} => array(
	*		{methodname},
	*		{methodname}
	*	)
	* );
	*/
	public $acl = array(
		"Administrator" => "ALL",
		"Registered" => "ALL",
		"Guest" => "ALL"
	);
	
	/*
	* Model is automatically included if exists. As long as you follow the naming conventions
	* You can access it from $this->model. Also add all your variable to $this->TPL so the view
	* can have access to it.
	*/
	public function index()
	{
	}
	
	public function login()
	{
		$this->TPL["errors"] = "";
		$auth = new userAuth();
		$auth->redirectPage = array("controller"=>"todo","method"=>"index");
		$auth->isLoggedIn();
		
		if(formVal::validate($this->model->loginFormRules))
			$auth->authenticate();
		$this->TPL["errors"] = formVal::getErrors();
	}
	
	public function logout()
	{
		$auth = new userAuth();
		$auth->logout();
		Framework::redirect("home","index");
	}
	
	public function register()
	{
		$auth = new userAuth();
		$auth->redirectPage = array("controller"=>"todo","method"=>"index");
		$auth->isLoggedIn();
			
		if(formVal::validate($this->model->registrationFormRules))
		{
			if(User::addUser($_POST['username'],$_POST['password'],$_POST['email'],2)) // Add new user of type registered
				$this->TPL["success"] = "The user has been successfully created.";
			else
				$this->TPL["userExists"] = "A user with the username you have entered already exists.";
		}
		$this->TPL["errors"] = formVal::getErrors();
	}
}
?>