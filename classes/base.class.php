<?php
class Framework
{	
	public function __construct()
	{
		$this->loadObjects();
	}
	
	private function loadObjects()
	{
		$handle = opendir(API_PATH);
		while (false !== ($file = readdir($handle))) 
		{
			if(preg_match("/^[A-Za-z]+.class.php$/",$file))
        		require_once($file);
    	}
	}
	
	public function loadHelpers()
	{
		$path = API_PATH."helpers/";
		$handle = opendir($path);
		while (false !== ($file = readdir($handle))) 
		{
			if(preg_match("/^[A-Za-z]+.class.php$/",$file))
        		require_once($path.$file);
    	}
	}
	
	public function getController($class)
	{
		$file = CONTROLLER_PATH . $class . ".controller.php";
		if(file_exists($file))
		{
			require_once($file);
			return new $class();
		}
	}
	
	public function getModel($class)
	{
		$file = MODEL_PATH . $class . ".model.php";
		if(file_exists($file))
		{
			require_once($file);
			$modelClass = $class."Model"; 
			return new $modelClass();
		}
	}
	
	public function getView($class,$method)
	{
		$file = VIEW_PATH . $class . '/' . $method . '.view.php';
		if(file_exists($file))
			return $file;
	}
	
	public function setTemplate($name)
	{
		global $_CONFIG;
		$_CONFIG["template"] = $name;
	}
	
	public function parseURI()
	{
		global $_CONFIG;
		if($_CONFIG["SEO"])
			return preg_split("[\\/]", $_SERVER['REQUEST_URI'],-1,PREG_SPLIT_NO_EMPTY);
		else
		{
			$uri_array = array();
			$uri_array[0] = isset($_GET["controller"])?$_GET["controller"]:"";
			$uri_array[1] = isset($_GET["method"])?$_GET["method"]:"";
			if(isset($_GET["args"]))
				return array_merge($uri_array,explode(',',$_GET["args"]));
			return $uri_array;
		}
	}
	
	public function route($controller='',$method='',$print=true)
	{
		global $_CONFIG;
		if($_CONFIG["SEO"])
			$url = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]).$controller.'/'.$method;
		else
		{
			$url = "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]);
			if(!empty($controller) && !empty($method))
				$url .= "index.php?controller=".$controller."&amp;method=".$method;
		}
		if(!$print)
			return $url;
		echo($url);
	}
}
?>