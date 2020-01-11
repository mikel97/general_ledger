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
		$this->servername = "db4free.net:3306";
		$this->username = "finance_gl";
		$this->password = "finance12345";
		$this->dbname = "finance_gl";


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