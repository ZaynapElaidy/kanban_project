<?php
include "../app/user.php";

session_start();

$user = new user();



$user->login($_POST["email"], $_POST["password"]);