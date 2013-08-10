<?php
class Framework
{	
	private function __construct(){}

	public static function load()
	{
		spl_autoload_register('Framework::__autoload');
		set_error_handler(array(new Debug,"errorHandler"));
	}
	
	public static function __autoload($class)
	{
		if(strpos($class,"Helper")>0)
			require_once(API_PATH."helpers/".strtolower($class).".class.php");
		else
			require_once(API_PATH.strtolower($class).".class.php");
	}
	
	public static function getController($class)
	{
		$file = CONTROLLER_PATH . $class . ".controller.php";
		if(file_exists($file))
		{
			require_once($file);
			return new $class();
		}
		trigger_error("Page does not exist", E_USER_ERROR);
	}
	
	public static function loadModule($class)
	{
		$file = CONTROLLER_PATH . $class . ".controller.php";
		if(file_exists($file))
		{
			require_once($file);
			$module =  new $class();
			$module->index();
			if(file_exists($viewPath))
				require_once (Framework::getViewPath($class,"index"));
		}
	}
	
	public static function getModel($class)
	{
		$file = MODEL_PATH . $class . ".model.php";
		if(file_exists($file))
		{
			require_once($file);
			$modelClass = $class."Model"; 
			return new $modelClass();
		}
	}
	
	public static function getTemplatePath()
	{
		global $_CONFIG;
		$root = TEMPLATE_PATH.$_CONFIG["template"];
		return array("top"=>$root."/index.top.php", "bottom"=>$root."/index.bottom.php");
	}
	
	public static function getViewPath($class,$method)
	{
		$file = VIEW_PATH . $class . DS . $method . '.view.php';
		if(file_exists($file))
			return $file;
	}
	
	public static function setTemplate($name)
	{
		global $_CONFIG;
		$_CONFIG["template"] = $name;
	}
	
	public static function parseURI()
	{
		global $_CONFIG;
		$uri_array = array();
		$uri = "";		
		if(isset($_GET['uri']))
		{
			$uri = str_replace(dirname($_SERVER["PHP_SELF"]).'/','',$_GET['uri']);
			$uri_array = preg_split("[\\/]", $uri,-1,PREG_SPLIT_NO_EMPTY);
			unset($_GET["uri"]);
		}
		foreach($_POST as $arg => $value)
			$uri_array[] = $value;
		foreach($_GET as $arg => $value)
			$uri_array[] = $value;
		return array(
			"class"=> ( isset($uri_array[0])?$uri_array[0]:$_CONFIG["default"] ),
			"method"=> ( isset($uri_array[1])?$uri_array[1]:"index" ),
			"params"=> ( (count($uri_array) >= 2)?array_slice($uri_array,2):array() )
		);
	}
	
	public static function templateExists()
	{
		global $_CONFIG;
		return (!empty($_CONFIG["template"])&&is_dir(TEMPLATE_PATH.$_CONFIG["template"]));
	}
	
	public static function route($controller='',$method='',$print=true)
	{
		global $_CONFIG;
		$url = WEB_DIRECTORY;
		if(!empty($controller) && !empty($method))
		{
			if($_CONFIG["SEO"])
				$url .= $controller.DS.$method;
			else
				$url .= "index.php?uri=".$controller.DS.$method;
		}
		if(!$print)
			return $url;
		echo($url);
	}
	
	public static function redirect($controller,$method)
	{
		header("Location: ".self::route($controller,$method,false));
		exit();
	}
}
?>
