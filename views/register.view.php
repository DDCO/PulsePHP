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
			<li><a href="http://dan-ubuntu:8080/">Internet PVR</a></li>
			<li><a href="http://dan-ubuntu:8085/">Usenet Download Manager</a></li>
			<li><a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/joomla/">Joomla</a></li>
			<li><a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/drupal/">Drupal</a></li>
            <li><a href="http://<?php echo($_SERVER['SERVER_NAME']);?>/example/login">Login</a></li>
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
		<div class="entry">
			<form method="post" action="http://<?php echo($_SERVER['SERVER_NAME']);?>/example/register">
            	<table>
                	<thead>
                    	<tr>
                        	<th colspan="2"><h3>Register</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<tr>
                        	<td><label>Username:</label></td>
                            <td><input type="text" name="username"/></td>
                            <?php if(isset($errors["username"])) { ?>
                            <td><?php echo($errors["username"]);?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                        	<td><label>Password:</label></td>
                            <td><input type="password" name="password"/></td>
                            <?php if(isset($errors["password"])) { ?>
                            <td><?php echo($errors["password"]);?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                        	<td><label>Confirm Password:</label></td>
                            <td><input type="password" name="confirm"/></td>
                            <?php if(isset($errors["confirm"])) { ?>
                            <td><?php echo($errors["confirm"]);?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                        	<td><label>Email:</label></td>
                            <td><input type="text" name="email"/></td>
                            <?php if(isset($errors["email"])) { ?>
                            <td><?php echo($errors["email"]);?></td>
                            <?php } ?>
                        </tr>
                        <tr>
                        	<td colspan="2" style="text-align:right;"><input type="submit"/></td>
                        </tr>
                    </tbody>
                </table>
            </form>
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