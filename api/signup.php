<?php 

	
	include "../app/user.php";
	session_start();

	$user = new user();
	
	$user->addUser($_POST["fname"],$_POST["lname"],$_POST["email"], $_POST["password"]);