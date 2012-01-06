<?php
class Debug
{
	public static function errorHandler($errno, $errstr, $errfile, $errline, $errcontext)
	{
		$templatePath = Framework::getTemplatePath();
		ob_start();
		switch ($errno) 
		{
			case E_NOTICE:
			case E_USER_NOTICE:
				include(VIEW_PATH."error/notice.view.php");
				break;
			case E_WARNING:
			case E_USER_WARNING:
				include(VIEW_PATH."error/warning.view.php");
				break;
			case E_ERROR:
			case E_USER_ERROR:
				include(VIEW_PATH."error/severe.view.php");
				break;
			case E_STRICT:
				include(VIEW_PATH."error/notice.view.php");
				break;
			default:
				return false;
        }
		/*
		* Other Error types not in use:
		* E_PARSE,E_RECOVERABLE_ERROR,E_DEPRECATED,E_USER_DEPRECATED
		*/
		$buffer = ob_get_contents();
		ob_end_clean();
		//return false if you want the default error handler to be used
		echo($buffer);
		exit($errno);
	}
	
	public static function dump($var)
	{
		echo("<pre>");
		var_dump($var);
		echo("</pre>");
	}
}
?>