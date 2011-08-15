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

$uri_array = preg_split("[\\/]", $_SERVER['REQUEST_URI'],-1,PREG_SPLIT_NO_EMPTY);

$class = empty($uri_array[0])?"example":$uri_array[0];
$method = empty($uri_array[1])?"index":$uri_array[1];
$params = array();
for($i = 2; $i < count($uri_array); $i++)
	$params[] = $uri_array[$i];

//Initialize Framework Libraries
$framework = new Framework();

//Initialize Database Connection
Database::singleton();

//Get Controller and run calling function 
$Controller = $framework->getController($class);
if (method_exists($Controller,$method))
	call_user_func_array(array($Controller,$method),$params);

//Access Control
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