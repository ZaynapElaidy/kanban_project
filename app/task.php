<?php

require ('connection.php');

/**
* class for tasks
*/
class task
{

	private $id; 
	private $user;
	private $title;
	private $content;
	private $statue;

	
	/*public function __construct()
	{
		$this->user = $user;
		$this->title = $title;
		$this->content = $content;
		// $this->statue = "todo";
	}*/

	public function addTask($user, $title, $content)
	{
		$connection = new connection();
		$PDO = $connection->connect();

		if($PDO) {
			try {
				$stmt = $PDO->prepare("INSERT INTO task (title, content, user) 
						VALUES (:title, :content, :user)");
				$stmt->execute([":title" => $title, ":content" => $content, ":user" => $user]);
				$res = array("status" => TRUE);
			} catch (Exception $e){
				$res = array("status" => FALSE, "msg" => "sorry");
			}
		} else {
			return false;
		}
	}


	public function getAllTasks()
	{
		$connection = new connection();
		$PDO = $connection->connect();

		$stmt = $PDO->prepare("SELECT * from task WHERE user = :user");
		$stmt->execute([":user" => $_SESSION['user_email']]);
		return $stmt->fetchAll();
	}

	public function updateStatue($id, $statue)
	{
			$connection = new connection();
			$PDO = $connection->connect();

			if($PDO) {
				try{
					$stmt = $PDO->prepare("UPDATE task SET statue =:statue WHERE id = :id");
					$result = $stmt->execute([":statue" => $statue, ":id" => $id]);

					echo json_encode($result);
					
				} catch (Exception $e){
					return false;
				}

			} else {
			return false;
		}
	}


	/*public function setContent($content)
	{
		$this->content = $content;
	}*/


}