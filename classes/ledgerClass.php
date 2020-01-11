<?php
	
	class GL extends Dbh {

		public function ledger($category, $year, $month){

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
			
			$statement = $this->connect()->query("SELECT * FROM finance_coa Where category = '$category' Order by account_no");			
			while($row = $statement->fetch(PDO::FETCH_ASSOC)){
				$statement1 = $this->connect()->query("SELECT SUM(amount) as 'Total' FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted' ".$sort1.$sort2);
				$total = $statement1->fetch(PDO::FETCH_ASSOC);
				$totaldebit = $total['Total'];
					
				$statement2 = $this->connect()->query("SELECT SUM(amount) as 'Total' FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted'".$sort1.$sort2);
				$total = $statement2->fetch(PDO::FETCH_ASSOC);
				$totalcredit = $total['Total'];


				$bal = $totaldebit - $totalcredit;
  				$final_Bal=0;
  				$mark = null;
  				if ($bal < 0) {
  					$mark = "Credit";
  					$final_Bal = $bal * -1;
  				}
  				elseif($bal > 0){
  					$mark = "Debit";
  					$final_Bal = $bal;
  				}				


  				echo'<div row class="col-12 bg-light rounded shadow" style="color: #6c757d; margin-top: 10px;">
			<div class="row col-12" style="font-weight: bold; color: #003366;">
				<div align="center" class="col-10">'.$row['account_title'].'</div>
				<div class="col-2">'.$row['account_no'].'</div>
			</div>
			<div class="row">
			<div class="col-6 border-right border-top-0" style="border-color: #6c757d;">
				<table class="table table-sm bg-light border">
					<thead class="table-active rounded shadow-sm" style="font-weight: bold; color: #003366;">
						<tr>
							<td align="center" colspan="3">Debit</td>
						</tr>
						<tr>
							<td align="left">Date</td>
							<td align="left">Explanation</td>
							<td align="left">Amount</td>
						</tr>
					</thead>
					<tbody>';
					$stmt1 = $this->connect()->query("SELECT * FROM finance_entries where debit = '$row[account_id]' and status = 'Inserted' ".$sort1.$sort2." Order by date_of_transaction");
						while($row4 = $stmt1->fetch(PDO::FETCH_ASSOC)){

						echo'<tr>
							<td class="border-right" align="left">'.$row4['date_of_transaction'].'</td>
							<td class="border-right" align="left">'.$row4['description'].'</td>
							<td class="border-right" align="left">₱ '.number_format($row4["amount"]).'</td>
						</tr>';

							}
						
				echo'</tbody>
				</table>
			</div>
			<div class="col-6 border-left border-top-0" style="border-color: #6c757d;">
				<table class="table table-sm bg-light borderless">
					<thead class="table-active rounded shadow-sm" style="font-weight: bold; color: #003366;">
						<tr>
							<td align="center" colspan="3">Credit</td>
						</tr>
						<tr>
							<td align="left">Date</td>
							<td align="left">Explanation</td>
							<td align="left">Amount</td>
						</tr>
					</thead>
					<tbody>';

					$stmt4 = $this->connect()->query("SELECT * FROM finance_entries where credit = '$row[account_id]' and status = 'Inserted' ".$sort1.$sort2." Order by date_of_transaction");
						while($row3 = $stmt4->fetch(PDO::FETCH_ASSOC)){

							echo'<tr>
								<td class="border" align="left">'.$row3['date_of_transaction'].'</td>
								<td class="border" align="left">'.$row3['description'].'</td>
								<td class="border" align="left">₱ '.number_format($row3["amount"]).'</td>
							</tr>';
  							}
						

				echo'</tbody>
				</table>
			</div>
			</div>
			<div class="row">
			<div class="col-3">Total</div>
			<div class="col-3">₱ '.number_format($totaldebit).'</div>
			<div class="col-3">Total</div>
			<div class="col-3">₱ '.number_format($totalcredit).'</div>
			</div>
			<div class="row">
			<div class="col-6" align="right"><b><i>'.$mark.' Balance:</i></b></div>
			<div class="col-6" align="center"><b><i>₱ '.number_format($final_Bal).'</i></b></div>
			</div>
		</div>';



			}
		}
	}