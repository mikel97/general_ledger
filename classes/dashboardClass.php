<?php

class Dashboard extends Dbh{
	public $Total;
	public function sort($date){ 
		$query = $this->connect()->query("SELECT DISTINCT $date(date_of_transaction) as 'date' FROM finance_entries");
		while($result = $query->fetch(PDO::FETCH_ASSOC)){
			echo ',"'.$result['date'].'"';
		}
	}
	
	public function Query($category){
		$stmt = $this->connect()->query("SELECT * FROM finance_coa where category = '$category'");
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//Debit
			$statement = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted'");
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//Credit
			$statement2 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted'");
			$result2 = $statement2->fetch(PDO::FETCH_ASSOC);

			$this->Total = $this->Total + ($result['total'] - $result2['total']);
		}
	}
	public function chart($category, $date){
		$query = $this->connect()->query("SELECT DISTINCT $date(date_of_transaction) as 'date' FROM finance_entries");
		while($queryresult = $query->fetch(PDO::FETCH_ASSOC)){
		$total = 0;
		$stmt = $this->connect()->query("SELECT * FROM finance_coa where category = '$category'");
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//Debit
			$statement = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted' and $date(date_of_transaction) = '$queryresult[date]'");
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//Credit
			$statement2 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted' and $date(date_of_transaction) = '$queryresult[date]'");
			$result2 = $statement2->fetch(PDO::FETCH_ASSOC);
			if ($category == "Expense") {
				$total = $total + ($result['total'] - $result2['total']);
			}elseif ($category == "Income") {
				$total = $total + ($result2['total'] - $result['total']);
			}
			
			}
			echo ','.$total;
		}
	}
}