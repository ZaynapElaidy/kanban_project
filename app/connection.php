<?php
	/**
	* class for database connection
	*/
	class Connection
	{
		private $host;
		private $database;
		private $username;
		private $password;
		
		public function __construct()
		{
			require('config.php');
			$this->host = $config['host'];
			$this->database = $config['database'];
			$this->username = $config['username'];
			$this->password = $config['password'];
		}

		public function connect ()
		{
			try{
				$conn = new PDO("mysql:hostname=".$this->host.";dbname=".$this->database, $this->username, $this->password);
				// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				return $conn;
			} catch (PDOException $e){
				return false;
			}
		}

	}


	
