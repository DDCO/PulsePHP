<?php
class exampleModel extends Model
{
	public $registrationFormRules = array(
		"rules" => array(
			"username" => array(
				"required" => true,
				"minlength" => 3,
				"alphanumeric" => true
			),
			"password" => array(
				"required" => true,
				"minlength" => 8,
				"alphanumeric" => true
			),
			"confirm" => array(
				"compare" => "password"
			),
			"email" => array(
				"required" => true,
				"email" => true
			)
		),
		"messages" => array(
			"username" => array(
				"required" => "Username is required.",
				"minlength" => "Username must be greater then or equal to 3 characters.",
				"alphanumeric" => "Username must compose of only letters and numbers."
			),
			"password" => array(
				"required" => "Password is required.",
				"minlength" => "Password must be a minimum of 8 characters.",
				"alphanumeric" => "Password must consist of only letters and numbers."
			),
			"confirm" => array(
				"compare" => "Password does not match."
			),
			"email" => array(
				"required" => "Email is required.",
				"email" => "Not a valid email."
			)
		)
	);
}
?>