<?php
session_start();
error_reporting(E_ALL);

define("API_PATH","classes/");
define("CONTROLLER_PATH","controllers/");
define("MODEL_PATH","models/");
define("VIEW_PATH","views/");
define("TEMPLATE_PATH","templates/");
define("WEB_DIRECTORY",(isset($_SERVER['HTTPS'])?"https://":"http://").rtrim($_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]),"/\\").'/');
define("DS",'/');

//Load base API
require_once("config.php");
require_once( API_PATH."base.class.php" );

//Initialize Framework Libraries
Framework::load();

$uri = Framework::parseURI();

//Initialize Database Connection
Database::singleton();

//Get Controller and run calling function 
$Controller = Framework::getController($uri["class"]);

//Access Control
ACL::hasAccess($Controller->acl,$uri["method"]);

if (method_exists($Controller,$uri["method"]))
	call_user_func_array(array($Controller,$uri["method"]),$uri["params"]);
else
	trigger_error("Page does not exist", E_USER_ERROR);

//Extract TPL array for easy access in view
if(!empty($Controller->TPL))
	extract($Controller->TPL,EXTR_OVERWRITE);

//echo($test);

//Render page
$viewPath = Framework::getViewPath($uri["class"],$uri["method"]);
if(Framework::templateExists())
{
	$templatePath = Framework::getTemplatePath();
	//Top portion of template
	require_once($templatePath["top"]);
	
	//Include view
	if(file_exists($viewPath))
		require_once($viewPath);
	
	//Bottom portion of template
	require_once($templatePath["bottom"]);
}
else
{
	if(file_exists($viewPath))
		require_once($viewPath); // show view only
}
?>