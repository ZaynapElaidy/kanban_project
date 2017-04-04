<?php 
	
	include "../app/task.php";

	session_start();

	$task = new task();

	$task->updateStatue($_POST['id'], $_POST['type']);