<?php
include "../app/task.php";

session_start();

$task = new task();
$task->addTask($_SESSION['user_email'],$_POST['title'],$_POST['content']);