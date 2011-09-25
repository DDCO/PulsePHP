<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Dreamy - A Ginger Ninja! template</title>
<link rel="stylesheet" href="<?php $framework->route();?>templates/dreamy/style.css" type="text/css" media="screen" />
</head>

<body>

<div id="wrapper">

	<div id="header">
		<h1>PulsePHP Framework</h1>
	</div>

	<div id="menu">
		<ul>
			<li><a href="<?php $framework->route('example','index');?>">Home</a></li>
			<li><a href="http://dan-ubuntu.local:8080/">Internet PVR</a></li>
			<li><a href="http://dan-ubuntu.local:8085/">Usenet Download Manager</a></li>
            <?php if(isset($_SESSION["isLoggedIn"])&&$_SESSION["isLoggedIn"]) { ?>
            <li><a href="<?php $framework->route('example','logout');?>">Logout</a></li>
            <?php } else { ?>
            <li><a href="<?php $framework->route('example','login');?>">Login</a></li>
            <?php } ?>
            <li><a href="<?php $framework->route('example','register');?>">Register</a></li>
		</ul>
	</div>

	<div id="sidebar">
		<div id="feed" style="text-align:center;"><a class="feed-button" href="#"></a></div>
		<ul>
			<li><a href="https://github.com/DDCO/PulsePHP">PulsePHP</a></li>
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
        <?php if(isset($_SESSION["isLoggedIn"])&&$_SESSION["isLoggedIn"]) { ?>
        <span style="padding-left:10px;">Welcome <?php echo($_SESSION["user"]["username"])?></span>
        <?php } ?>
		<div class="entry">