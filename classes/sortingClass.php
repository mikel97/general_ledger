<?php

class Sorting extends Dbh{

	public function selectYear(){
		$statement = $this->connect()->query("SELECT DISTINCT YEAR(date_of_transaction) as 'year' FROM finance_entries where status = 'Inserted'");
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
		}
	}
}