<?php
	$form = new formHelper("Login",$framework->route(array("controller"=>"example","method"=>"login"),false),"post");
	$form->errors = $errors;
	$form->addLabel("Username: ");
	$form->addElement("Textbox",array("name"=>"username"));
	$form->addLabel("Password: ");
	$form->addElement("PasswordField",array("name"=>"password"));
	$form->addElement("SubmitButton",array("value"=>"Log in"));
	$form->printForm();
?>