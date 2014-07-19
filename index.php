<?php
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], "gzip")) 
	ob_start("ob_gzhandler"); else ob_start();
session_start();
error_reporting(E_ALL);

define("API_PATH","classes/");
define("CONTROLLER_PATH","controllers/");
define("MODEL_PATH","models/");
define("VIEW_PATH","views/");
define("TEMPLATE_PATH","templates/");
define("WEB_DIRECTORY",(isset($_SERVER['HTTPS'])?"https://":"http://").rtrim($_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]),"/\\").'/');
define("DS",'/');
define("MODULE_PATH","modules/");

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
$viewPath = Framework::getViewPath($uri["class"],$uri["method"]);
$Controller->TPL["content"] = file_get_contents($viewPath);
extract($Controller->TPL,EXTR_OVERWRITE);

//include page
if(Framework::templateExists())
{
	$templatePath = Framework::getTemplatePath();
	require_once($templatePath."/index.php");
}
else
	echo($content);
?>