<?php
session_start();

define("API_PATH","classes/");
define("CONTROLLER_PATH","controllers/");
define("MODEL_PATH","models/");
define("VIEW_PATH","views/");
define("TEMPLATE_PATH","templates/");

//Load base API
require_once( API_PATH."base.class.php" );
require_once("config.php");

//Initialize Framework Libraries
$framework = new Framework();

$uri_array = $framework->parseURI();

$class = empty($uri_array[0])?$_CONFIG["default"]:$uri_array[0];
$method = empty($uri_array[1])?"index":$uri_array[1];
$params = array();
for($i = 2; $i < count($uri_array); $i++)
	$params[] = $uri_array[$i];

//Initialize Database Connection
if(class_exists("Database"))
	Database::singleton();

//Get Controller and run calling function 
$Controller = $framework->getController($class);
if (method_exists($Controller,$method))
	call_user_func_array(array($Controller,$method),$params);

//Access Control
if(class_exists("ACL"))
	ACL::hasAccess($Controller->acl,$method);

//Extract TPL array for easy access in view
if(!empty($Controller->TPL))
	extract($Controller->TPL,EXTR_OVERWRITE);
	
//Load Helper Classes
$framework->loadHelpers();

//Top portion of template
require_once(TEMPLATE_PATH.$_CONFIG["template"]."/index.top.php");

//Include view
require_once($framework->getView($class,$method));

//Bottom portion of template
require_once(TEMPLATE_PATH.$_CONFIG["template"]."/index.bottom.php");
?>