<?php

class TB extends Dbh {

	public function trial_balance($year,$month){

		if ($year == null){
                  $sort1 = "";
                  $sort2 = "";
            }elseif ($month == null){
                  $sort1 = "and YEAR(date_of_transaction) = '".$year."'";
                  $sort2 = "";      
            }
            else{
                  $sort1 = "and YEAR(date_of_transaction) = '".$year."'";
                  $sort2 = " and MONTH(date_of_transaction) = '".$month."'";
            }
            
		$statement = $this->connect()->query("SELECT * FROM finance_coa Order by account_no");	
		$totalDebit = 0;
  	$totalCredit = 0;	

  		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
  					// DEBIT
					$statement3 = $this->connect()->query("SELECT SUM(amount) as 'debit' FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted'".$sort1.$sort2);
					$total = $statement3->fetch(PDO::FETCH_ASSOC);
					$totalDebitBal = $total['debit'];
			
			// CREDIT
					$statement6 = $this->connect()->query("SELECT SUM(amount) as 'credit' FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted'".$sort1.$sort2);
					$total1 = $statement6->fetch(PDO::FETCH_ASSOC);
					$totalCreditBal =  $total1['credit'];

			$balance = $totalDebitBal - $totalCreditBal;
  			if ($balance < 0) {
  				$balance = $balance * -1;
  				$totalCredit = $totalCredit + $balance;
  				echo '<tr>
						<td class="pl-3 border-bottom">'.$row['account_title'].'</td>
						<td class="border-bottom" align="right"> --- </td>
						<td class="pr-5 border-bottom" align="right">₱ '.number_format($balance).'</td>
					</tr>';
  			}
  			else if ($balance == 0) {
  				
  			}
  			else{
  				$totalDebit = $totalDebit + $balance;
  				echo '<tr>
						<td class="pl-3 border-bottom">'.$row['account_title'].'</td>
						<td class="border-bottom" align="right">₱ '.number_format($balance).'</td>
						<td class="pr-5 border-bottom" align="right"> --- </td>
					</tr>';
  			}

  		}

  		echo '<tr>
					<td class="pl-3"><b><i>Total:</i></b></td>
					<td align="right"><b>₱ <i>'.number_format($totalDebit).'</i></b></td>
					<td align="right" class="pr-5	"><b>₱ <i>'.number_format($totalCredit).'</i></b></td>
				</tr>';
	}
}