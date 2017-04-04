<?php

include 'connection.php';

$user = new user();

$user->getUserID("hamada@yahoo.com");

	/**
	 * class for the user
	 */
	class user
	{

		private $first_name;
		private $last_name;
		private $email;
		private $password;
		private $res;

		
		/*public function __construct()
		{
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->email = $email;
			$this->password = $password;
		}*/

		public function setPassword($password, $valid)
		{
			if($valid) {
				$this->password = $password;
			}	
		}

		public function getUser()
		{
			return $this->email;
		}

		public function login($email, $password)
		{
			$connection = new connection();
			$PDO = $connection->connect();

			if($PDO) {
				try {
					$stmt = $PDO->prepare("SELECT * FROM user WHERE email = :email AND password = :password LIMIT 1");
					$result = $stmt->execute([":email" => $email, ":password" => $password]);
					
					if($result){
						$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
						if(count($rows)>0){
							$_SESSION['user_email'] = $this->getUserID($email);
							$this->res = array("status" => TRUE, "url" => "./board.php");
							echo json_encode($this->res);
						}else{
							echo json_encode(false);
						}
					}
				} catch (Exception $e){
					$this->res = array("status" => FALSE, "msg" => "sorry");
				}
			} else {
				return false;
			}	
		}

		public function addUser($first_name, $last_name, $email, $password) {
			$connection = new connection();
			$PDO = $connection->connect();
			//var_dump($PDO);
			if($PDO) {
				try {
					$stmt = $PDO->prepare("INSERT INTO user SET 
															first_name=:first_name,
    														last_name=:last_name,
    														email=:email,
    														password=:password ");
					
					$result = $stmt->execute([":first_name" => $first_name, ":last_name" => $last_name, ":email" => $email, ":password" => $password]);
					
					$_SESSION['user_email'] = $this->getUserID($email);
					$this->res = array("status" => TRUE, "url" => "./board.php");
					echo json_encode($this->res);
				} catch (Exception $e){
					$this->res = array("status" => FALSE, "msg" => "sorry");
				}

				// echo json_encode($this->res);

			} else {
				return false;
			}
		}

		public function validateUser()
		{
			$connection = new connection();
			$PDO = $connection->connect();

			if($PDO) {
				try {
					$stmt = $PDO->prepare("SELECT email FROM user");
					$stmt->execute();
					$result = $stmt->fetchAll();
					//echo ($result);

					if (count($result)) {
						foreach ($result as $user) {
							if ($this->email == $user['email']){
								echo "this email registed before";
								die;
								header ("location: index.php");
							}
						}
					}
					$this->res = array("status" => true, "msg" => "welcome");
				} catch (Exception $e){
					$this->res = array("status" => false, "msg" => "sorry");
				}

				//echo json_encode($this->result);

			} else {
				return false;
			}
		}

		public function getUserID($email){
			$connection = new connection();
			$PDO = $connection->connect();
			$sql = "SELECT id from user WHERE email='$email' LIMIT 1";
			$result = $PDO->query($sql);
			$row = $result->fetchObject();
			return $row->id;
		}
	}