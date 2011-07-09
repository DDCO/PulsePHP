<?php
abstract class Controller
{
	protected function loadView($name="",$vars="")
	{
		if (is_array($vars))
			extract($vars, EXTR_PREFIX_SAME, "wddx");
		if(empty($name))
			require_once(VIEW_PATH.get_class($this).".view.php");
		else
			require_once(VIEW_PATH.$name.".view.php");
	}
	
	protected function loadModel($name="")
	{
		$class = "";
		if(empty($name))
		{
			require_once(MODEL_PATH.__CLASS__.".model.php");
			$class = __CLASS__."Model";
		}
		else
		{
			require_once(MODEL_PATH.$name.".model.php");
			$class = $name."Model";
		}
		return new $class();
	}
}
?>