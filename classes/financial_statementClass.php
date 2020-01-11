<?php

class Financial extends Dbh{
	public $remarks;
	public $NET;
	public $TOTALS;
	public function income($category,$year,$month){

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


		$TOTAL = 0;
		$statement = $this->connect()->query("SELECT * FROM finance_coa where category = '$category' Order by account_no");
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$statement2 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted'".$sort1.$sort2);
			$row2 = $statement2->fetch(PDO::FETCH_ASSOC);
			$totalDEBIT = $row2['total'];
			$statement3 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted'".$sort1.$sort2);
			$row3 = $statement3->fetch(PDO::FETCH_ASSOC);
			$totalCREDIT = $row3['total'];

			$total = $totalDEBIT - $totalCREDIT;
			
			if ($total < 0 ) {
  				$total = $total * -1;	
  				echo '<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['account_title'].'</td>
				<td align="right">₱ '.number_format($total).'</td>
				<td></td>
				</tr>';
  			}
  			elseif ($total == 0) {
  				
  			}
  			else{

  			echo '<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['account_title'].'</td>
				<td align="right">₱ '.number_format($total).'</td>
				<td></td>
				</tr>';
			}
			$TOTAL = $TOTAL + $total;
		}
		
		if ($TOTAL < 0) {
			
		}else{
		echo '<tr>
			<td><b><i>Total '.$category.'</i></b></td>
				<td></td>
				<td align="right"><b>₱ '.number_format($TOTAL).'</b></td>
			</tr>';
		}
	}

	public function net($category1, $category2, $year, $month){

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

		$net = 0;
		$income=0;
		$expense=0;
		$statement1 = $this->connect()->query("SELECT * FROM finance_coa where category = '$category1' Order by account_no");
		while($row = $statement1->fetch(PDO::FETCH_ASSOC)){
			$statement2 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted'".$sort1.$sort2);
			$row2 = $statement2->fetch(PDO::FETCH_ASSOC);
			$totalDEBIT = $row2['total'];
			$statement3 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted'".$sort1.$sort2);
			$row3 = $statement3->fetch(PDO::FETCH_ASSOC);
			$totalCREDIT = $row3['total'];

			$total = $totalCREDIT - $totalDEBIT;
			$income = $income + $total;
		}
		$statement4 = $this->connect()->query("SELECT * FROM finance_coa where category = '$category2' Order by account_no");
		while($row1 = $statement4->fetch(PDO::FETCH_ASSOC)){
			$statement5 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where debit = '$row1[account_id]' and status = 'Inserted'".$sort1.$sort2);
			$row4 = $statement5->fetch(PDO::FETCH_ASSOC);
			$totalDEBIT = $row4['total'];
			$statement6 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where credit = '$row1[account_id]' and status = 'Inserted'".$sort1.$sort2);
			$row5 = $statement6->fetch(PDO::FETCH_ASSOC);
			$totalCREDIT = $row5['total'];

			$total1 = $totalDEBIT - $totalCREDIT;
			$expense = $expense + $total1;
		}
		$net = $income - $expense;

		if ($net < 0) {
			$net = $net * -1;
			$this->NET = $net;
			$this->remarks = "Loss";
			echo '<tr>
					<td><b><i>Net Loss forwarded to Balance Sheet</i></b></td>
					<td></td>
					<td align="right">₱ '.number_format($net).'</td>
				</tr>';
		}else{
			$this->NET = $net;
			$this->remarks = "Income";
			echo '<tr>
					<td><b><i>Net Income forwarded to Balance Sheet</i></b></td>
					<td></td>
					<td align="right">₱ '.number_format($net).'</td>
				</tr>';
		}
	}



	public function balanceSHEET($category,$year,$month){
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

		$TOTAL = 0;
		$statement = $this->connect()->query("SELECT * FROM finance_coa where category = '$category' Order by account_no");
		while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$statement2 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted'".$sort1.$sort2);
			$row2 = $statement2->fetch(PDO::FETCH_ASSOC);
			$totalDEBIT = $row2['total'];
			$statement3 = $this->connect()->query("SELECT SUM(amount) as 'total' FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted'".$sort1.$sort2);
			$row3 = $statement3->fetch(PDO::FETCH_ASSOC);
			$totalCREDIT = $row3['total'];

			$total = $totalDEBIT - $totalCREDIT;
			
			if ($total < 0 ) {
  				$total = $total * -1;	
  				echo '<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['account_title'].'</td>
				<td></td>
				<td align="right">₱ '.number_format($total).'</td>
				</tr>';
  			}
  			elseif ($total == 0) {
  				
  			}
  			else{

  			echo '<tr>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['account_title'].'</td>
				<td align="right">₱ '.number_format($total).'</td>
				<td></td>
				</tr>';
			}
			$this->TOTALS = $this->TOTALS + $total;
		}
	}
}