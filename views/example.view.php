<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dreamy - A Ginger Ninja! template</title>
<link rel="stylesheet" href="http://<?php echo($_SERVER['SERVER_NAME']);?>/css/style.css" type="text/css" media="screen" />
</head>

<body>

<div id="wrapper">

	<div id="header">
		<h1>PulsePHP Framework</h1>
	</div>

	<div id="menu">
		<ul>
			<li><a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/example/index">Home</a></li>
			<li><a href="http://dan-ubuntu.local:8080/">Internet PVR</a></li>
			<li><a href="http://dan-ubuntu.local:8085/">Usenet Download Manager</a></li>
			<li><a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/joomla/">Joomla</a></li>
			<li><a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/drupal/">Drupal</a></li>
            <?php if($isLoggedIn) { ?>
            <li><a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/example/logout">Logout</a></li>
            <?php } else { ?>
            <li><a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/example/login">Login</a></li>
            <?php } ?>
            <li><a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/example/register">Register</a></li>
		</ul>
	</div>

	<div id="sidebar">
		<div id="feed" style="text-align:center;">
			<a class="feed-button" href="#">Downloads</a>
		</div>
		<ul>
			<li><a href="#">PulsePHP</a></li>
			<li><a href="#">ircClient</a></li>
		</ul>
		<div id="sidebar-bottom">
			&nbsp;
		</div>
	</div>

	<div id="content">
		<div id="ad-top">
			<!-- Insert 468x60 banner advertisement -->
		</div>
        <?php if($isLoggedIn) { ?>
        <span style="padding-left:10px;">Welcome <?php echo($_SESSION["user"]["username"])?></span>
        <?php } ?>
		<div class="entry">
			<div class="entry-title"><a href="#">The PulsePHP Framework Example Page</a></div>
			<div class="date">Admin Posted on May 9, 2011</div>
			<p>By default the root directory will navigate to the <a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/example/index/">/example/index/</a> page. You can choose to change this in the index.php page.</p>
            <p>I designed the framework to my desire, I have tried to follow the REST methodology and create a simple, lightweight and an elegant object oriented design.</p> 
            <p>The first argument in the url is the controller object, which controlles the program flow. The second argument is the method in the controller object that will be called. By default the second argument will be index if nothing is given. The rest of the arguments are parameters to the method being called (this feature is not yet implemented).</p>
            <p>Thanks to ginger ninja for the template design. It looks great and is very simple/small, which is what I'm looking for.</p>
			<div class="comments"><a href="#">0 comments</a></div>
		</div>
	</div>

	<div id="footer">
		<div id="footer-valid">
			<a href="http://validator.w3.org/check/referer">xhtml</a> / <a href="http://www.ginger-ninja.net/">ginger ninja!</a>
		</div>
	</div>

</div>

</body>
</html>
