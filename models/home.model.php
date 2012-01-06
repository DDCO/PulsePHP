<?php
class homeModel extends Model
{
	//form validation 
	public $loginFormRules = array(
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
	
	public $registrationFormRules = array(
		"rules" => array(
			"username" => array(
				"required" => true
			),
			"password" => array(
				"required" => true
			),
			"confirm" => array(
				"required" => true,
				"compare" => "password"
			),
			"email" => array(
				"required" => true,
				"email" => true
			)
		),
		"messages" => array(
			"username" => array(
				"required" => "Username is required."
			),
			"password" => array(
				"required" => "Password is required."
			),
			"confirm" => array(
				"required" => "This field is required.",
				"compare" => "The password you have entered does not match"
			),
			"email" => array(
				"required" => "Email is required.",
				"email" => "The email you have entered is not a valid email address."
			)
		)
	);
}
?>