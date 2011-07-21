<?php
class Controller
{
	public $TPL;
	public $model;
	public $acl = array();
	
	public function __construct()
	{
		$class = get_class($this);
		$file = MODEL_PATH . $class . ".model.php";
		if(file_exists($file))
		{
			require_once($file);
			$modelClass = $class."Model"; 
			$this->model = new $modelClass();
		}
	}
	
	public function setTemplate($name)
	{
		global $CONFIG;
		if(file_exists("templates/".$name."/index.top.html")&&file_exists("templates/".$name."/index.bottom.html"))
			$CONFIG["template"] = $name;
	}
}
?>