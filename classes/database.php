<?php

class Dbh {

	private $servername;
	private $username;
	private $password;
	private $dbname;
	private $charset;

	public function connect(){
		
		//$this->servername = "192.168.1.8,1433";
		//$this->username = "sa";
		$this->servername = "127.0.0.1";
		$this->username = "root";
		$this->password = "";
		$this->dbname = "finance";


		try {
			//MSSQL
			//$dsn = "sqlsrv:Server=".$this->servername.";database=".$this->dbname;
			//MYSQL
			$dsn = "mysql:host=".$this->servername.";dbname=".$this->dbname;
			$pdo = new PDO($dsn, $this->username, $this->password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
			
		} catch (PDOException $e) {
			echo "Connection failed ".$e->getMessage();
		}
		
	}
}