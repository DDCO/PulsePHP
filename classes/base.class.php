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
	
	// args array example: array("controller"=>"example","method"=>"index")
	public function route($args=NULL)
	{
		if(is_array($args))
			echo("http://".$_SERVER["HTTP_HOST"].'/'.$args["controller"].'/'.$args["method"]);
		else
			echo("http://".$_SERVER["HTTP_HOST"].'/');
	}
}
?>