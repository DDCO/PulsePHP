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
	
	public function loadController($class,$method)
	{
		$file = CONTROLLER_PATH . $class . ".controller.php";
		if(file_exists($file))
		{
			require_once($file);
			$controller = new $class();
			if (method_exists($controller,$method))
				$controller->$method();
		}
	}
}
?>