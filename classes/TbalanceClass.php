<?php

class TB extends Dbh {

	public function trial_balance(){
		$statement = $this->connect()->query("SELECT * FROM account_title Order by Account_no");	
		$totalDebit = 0;
  		$totalCredit = 0;
  		$balance = 0;

  		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
  			$totalDebitBal = 0;
			$totalCreditBal = 0;
			// DEBIT
			$statement1 = $this->connect()->query("SELECT * FROM debit where acc_no = '$row[Account_no]'");
			while($row1 = $statement1->fetch(PDO::FETCH_ASSOC)){
				$statement2 = $this->connect()->query("SELECT * FROM entry where e_id = '$row1[entry_id]'");
				while($row2 = $statement2->fetch(PDO::FETCH_ASSOC)){
					$statement3 = $this->connect()->query("SELECT SUM(amout) as 'debit' FROM debit where entry_id = '$row2[e_id]'");
					$total = $statement3->fetch(PDO::FETCH_ASSOC);
					$totalDebitBal = $totalDebitBal + $total['debit'];
				}
			}
			// CREDIT
			$statement4 = $this->connect()->query("SELECT * FROM credit where acc_no = '$row[Account_no]'");
			while($row3 = $statement4->fetch(PDO::FETCH_ASSOC)){
				$statement5 = $this->connect()->query("SELECT * FROM entry where e_id = '$row3[entry_id]'");
				while($row4 = $statement5->fetch(PDO::FETCH_ASSOC)){
					$statement6 = $this->connect()->query("SELECT SUM(amout) as 'credit' FROM credit where entry_id = '$row4[e_id]'");
					$total1 = $statement6->fetch(PDO::FETCH_ASSOC);
					$totalCreditBal = $totalCreditBal + $total1['credit'];
				}
			}

			$balance = $totalDebitBal - $totalCreditBal;
  			if ($balance < 0) {
  				$balance = $balance * -1;
  				$totalCredit = $totalCredit + $balance;
  				echo '<tr>
						<td style="padding-left: 1cm;">'.$row['Accoutnt_title'].'</td>
						<td align="right"> --- </td>
						<td align="right" style="padding-right: 2cm;">₱ '.$balance.'</td>
					</tr>';
  			}
  			else if ($balance == 0) {
  				
  			}
  			else{
  				$totalDebit = $totalDebit + $balance;
  				echo '<tr>
						<td style="padding-left: 1cm;">'.$row['Accoutnt_title'].'</td>
						<td align="right">₱ '.$balance.'</td>
						<td align="right" style="padding-right: 2cm;"> --- </td>
					</tr>';
  			}

  		}

  		echo '<tr>
					<td style="padding-left: 1cm;"><b><i>Total:</i></b></td>
					<td align="right"><b>₱ <i>'.$totalDebit.'</i></b></td>
					<td align="right" style="padding-right: 2cm;"><b>₱ <i>'.$totalCredit.'</i></b></td>
				</tr>';
	}
}