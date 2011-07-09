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

$framework = new Framework();
Database::singleton();
$framework->loadController($class,$method);
?>