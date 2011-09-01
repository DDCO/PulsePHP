<?php
	$form = new formHelper("Register",$framework->route(array("controller"=>"example","method"=>"register"),false),"post");
	$form->errors = $errors;
	$form->addLabel("Username: ");
	$form->addElement("Textbox",array("name"=>"username"));
	$form->addLabel("Password: ");
	$form->addElement("PasswordField",array("name"=>"password"));
	$form->addLabel("Confirm Password: ");
	$form->addElement("PasswordField",array("name"=>"confirm"));
	$form->addLabel("Email: ");
	$form->addElement("Textbox",array("name"=>"email"));
	$form->addElement("SubmitButton",array("value"=>"Register"));
	$form->render();
?>