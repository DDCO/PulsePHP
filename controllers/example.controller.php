<?php
class example extends Controller
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
		$auth = new userAuth();
		$this->TPL["isLoggedIn"] = $auth->isLoggedIn();
	}
	
	public function login()
	{
		$this->TPL["errors"] = "";
		$auth = new userAuth();
		if($auth->isLoggedIn())
			$auth->redirect("example/index");
		
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
		if(formVal::validate($formArgs))
			$this->TPL["auth"] = $auth->authenticate();
		else
			$this->TPL["errors"] = formVal::getErrors();
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
			
		if(formVal::validate($this->model->registrationFormRules))
			$this->model->addNewUser(); //Finish
		else
			$this->TPL["errors"] = formVal::getErrors();
	}
}
?>