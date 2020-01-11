<?php
class Accounts extends Dbh {
	public function chartOfAccounts(){
		$statement = $this->connect()->query("SELECT * FROM finance_coa Order by account_no");
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			echo '<tr>
					<td class="pl-3 border-right border-left border-bottom">'.$row['account_no'].'</td>
					<td class="pl-3 border-right border-left border-bottom">'.$row['account_title'].'</td>
					<td class="pl-3 border-right border-left border-bottom">'.$row['category'].'</td>
					<td class="pl-3 border-right border-left border-bottom">'.$row['type'].'</td>
				</tr>';
		}
	}

	public function insert($no,$title,$category,$type){
		$statement = "INSERT INTO finance_coa(account_no,account_title,category,type) VALUES(?,?,?,?)";
		$this->connect()->prepare($statement)->execute([$no,$title,$category,$type]);
		echo "<SCRIPT type='text/javascript'>
      	alert('Account Inserted!');
      	window.location.replace(\"http:://../../chart_of_accounts.php\");
      	</SCRIPT>";
	}
}