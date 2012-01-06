<?php 
class formVal
{	
	public static $errors;

	private function __contruct(){}
	
	/*
	* This validation method is very similar to jquery validate.
	* The args parameter is an array with the rules and error messages to return.
	* Example args array:
	* array(
	*		"rules" => array(
	*			"password"=>array(
	*				"required" => true,
	*				"minlength" => 3,
	*				"maxlength" => 8,
	*				"alphanumeric" => true
	*			),
	*			"email"=>array(
	*				"required" => true,
	*				"email" => true
	*			)
	*		),
	*		"messages" => array(
	*			"password"=>array(
	*				"required" => "Password field is required",
	*				"minlength" => "Password must be greater or equal to 3 characters",
	*				"maxlength" => "Password must be less then or equal to 8 characters"
	*			),
	*			"email"=>array(
	*				"required" => "Email field is required",
	*				"email" => "Email is not valid"
	*			)
	*		)
	*	);
	* The validate method will return false if args is not an array or the rule value is empty.
	* It will return true if all the rules are meet, and return an array with the error messages for each
	* field that failed validation. The error array will look similar to the below example.
	* array(
	*	"password" => "Password field is required",
	*	"email" => "Email field is required"
	* );
	*/
	public static function validate($args)
	{
		self::$errors = array();
		if(!is_array($args))
			return false;
		if(empty($_POST))
			return false;

		foreach($args["rules"] as $field => $value)
		{
			$fieldValue = $_POST[$field];
			foreach($value as $rule => $ruleValue)
			{
				if(empty($ruleValue))
					return false;
				switch($rule)
				{
					case "required":
						if(empty($fieldValue))
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "minlength":
						if( strlen($fieldValue) < $ruleValue )
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "maxlength":
						if( strlen($fieldValue) > $ruleValue )
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "email":
						if(!self::isEmail($fieldValue) && !empty($fieldValue))
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "phonenumber":
						if(!self::isPhonenumber($fieldValue) && !empty($fieldValue))
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "postalcode":
						if(!self::isPostalcode($fieldValue) && !empty($fieldValue))
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "alphanumeric":
						if(!ctype_alnum($fieldValue) && !empty($fieldValue))
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "numeric":
						if(!ctype_digit($fieldValue) && !empty($fieldValue))
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "alphabetic":
						if(!ctype_alpha($fieldValue) && !empty($fieldValue))
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "lowercase":
						if(!ctype_lower($fieldValue) && !empty($fieldValue))
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "uppercase":
						if(!ctype_upper($fieldValue) && !empty($fieldValue))
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
					case "compare":
						if($fieldValue != $_POST[$ruleValue])
						{
							self::$errors[$field] = $args["messages"][$field][$rule];
							break 2;
						}
					break;
				}
			}
		}
		return empty(self::$errors)?true:false;
	}
	
	public static function formHasSubmitted()
	{
		if(empty($_GET) && empty($_POST))
			return false;
		return true;
	}
	
	public static function getErrors()
	{
		return self::$errors;
	}
	
	public static function isEmail($email)
	{
		return preg_match("/^[\w\d._-]+@[\w\d]+\.\w{0,3}$/",$email);
	}
	
	public static function isPhonenumber($phonenumber)
	{	
		return preg_match("/^\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{4}$/",$phonenumber);	
	}
	
	public static function isPostalcode($postalcode)
	{
		return preg_match("/^\w\d\w\s?\d\w\d$/",$postalcode);
	}
}
?>