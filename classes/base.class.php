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
		$file = MODULE_PATH . $class . ".module.php";
		if(file_exists($file))
		{
			require_once($file);
			$module =  new $class();
			$module->onLoad();
			$view = Framework::getViewPath($class,"index");
			if(file_exists($view))
				require_once ($view);
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
		return $root;
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

	public static function minify($path)
	{
		$pathInfo = pathinfo($path);
		$newFilename = $pathInfo["dirname"] . '/' . $pathInfo["filename"] . ".min." . $pathInfo["extension"];
		if(!file_exists($newFilename))
		{
			$file = file_get_contents($path);
			$min = preg_replace("/(\/\*[^*]*\*+([^\/*][^*]*\*+)*\/)/", "", $file); //remove multiline comments
			if($pathInfo["extension"] == "js")
				$min = preg_replace('/(\/\/(.|)+)+/', '', $min); //remove single line comments from js
			$min = preg_replace('/(\s+\{\s+)+/', '{', $min); //remove space before open bracket
			$min = preg_replace('/[\t\r\n]+/', '', $min); //remove whitespace
			$min = preg_replace('/;\s+/', ';', $min); // remove space after ;
			file_put_contents ($newFilename,$min);
		}
		switch($pathInfo["extension"])
		{
			case "css":
				echo("<link rel='stylesheet' type='text/css' href='".WEB_DIRECTORY.$newFilename."'>");
			break;
			case "js":
				echo("<script type='text/javascript' src='".WEB_DIRECTORY.$newFilename."'></script>");
			break;
		}
	}
}
?>
