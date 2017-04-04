<?php 

	include "../app/connection.php";
	session_start();

	$connection = new connection();
	$PDO = $connection->connect();

	$stmt = $PDO->prepare("SELECT * from task WHERE user = :user");
	$stmt->execute([":user" => $_SESSION['user_email']]);
	$results =  $stmt->fetchAll(PDO::FETCH_ASSOC);
// 	$results = $stmt->fetch(PDO::FETCH_ASSOC);
// 	echo print_r($results);
	echo json_encode($results);