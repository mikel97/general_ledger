<?php
	
	class GL extends Dbh {

		public function ledger($category){
			$statement = $this->connect()->query("SELECT * FROM account_title Where Category = '$category' Order by Account_no");			while($row = $statement->fetch(PDO::FETCH_ASSOC)){
				$final_Bal=0;
				$totaldebit = 0;
				$totalcredit = 0;

				$statement2 = $this->connect()->query("SELECT * FROM debit where acc_no='$row[Account_no]'");
					while($row1 = $statement2->fetch(PDO::FETCH_ASSOC)){
						$statement3 = $this->connect()->query("SELECT * FROM entry where e_id = '$row1[entry_id]'");
						while($row2 = $statement3->fetch(PDO::FETCH_ASSOC)){
							$statement4 = $this->connect()->query("SELECT SUM(amout) as 'Total' FROM debit where entry_id = '$row2[e_id]'");
							$total = $statement4->fetch(PDO::FETCH_ASSOC);
							$totaldebit = $totaldebit + $total['Total'];

						}
					}

				$statement5 = $this->connect()->query("SELECT * FROM credit where acc_no='$row[Account_no]'");
					while($row3 = $statement5->fetch(PDO::FETCH_ASSOC)){
						$statement6 = $this->connect()->query("SELECT * FROM entry where e_id = '$row3[entry_id]'");
						while($row4 = $statement6->fetch(PDO::FETCH_ASSOC)){
							$statement7 = $this->connect()->query("SELECT SUM(amout) as 'Total' FROM credit where entry_id = '$row4[e_id]'");
							$total = $statement7->fetch(PDO::FETCH_ASSOC);
							$totalcredit = $totalcredit + $total['Total'];

						}
					}


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
				<div align="center" class="col-10">'.$row['Accoutnt_title'].'</div>
				<div class="col-2">'.$row['Account_no'].'</div>
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
						$stmt = $this->connect()->query("SELECT * FROM debit where acc_no = '$row[Account_no]'");
						while($debits = $stmt->fetch(PDO::FETCH_ASSOC)){
							$stmt1 = $this->connect()->query("SELECT * FROM entry where e_id = '$debits[entry_id]'");
							while($row4 = $stmt1->fetch(PDO::FETCH_ASSOC)){
								$stmt2 = $this->connect()->query("SELECT * From debit where entry_id = '$row4[e_id]'");
								$dbrow = $stmt2->fetch(PDO::FETCH_ASSOC);
						echo'<tr>
							<td class="border-right" align="left">'.$row4['transaction_date'].'</td>
							<td class="border-right" align="left">'.$row4['Description'].'</td>
							<td class="border-right" align="left">₱ '.$dbrow['amout'].'</td>
						</tr>';

							}
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


						$stmt3 = $this->connect()->query("SELECT * FROM credit where acc_no = '$row[Account_no]'");
						while($credits = $stmt3->fetch(PDO::FETCH_ASSOC)){
							$stmt4 = $this->connect()->query("SELECT * FROM entry where e_id = '$credits[entry_id]'");
							while($row3 = $stmt4->fetch(PDO::FETCH_ASSOC)){
								$stmt5 = $this->connect()->query("SELECT * From credit where entry_id = '$row3[e_id]'");
								$crrow = $stmt5->fetch(PDO::FETCH_ASSOC);

							echo'<tr>
								<td class="border" align="left">'.$row3['transaction_date'].'</td>
								<td class="border" align="left">'.$row3['Description'].'</td>
								<td class="border" align="left">₱ '.$crrow['amout'].'</td>
							</tr>';
  							}
						}

				echo'</tbody>
				</table>
			</div>
			</div>
			<div class="row">
			<div class="col-3">Total</div>
			<div class="col-3">₱ '.$totaldebit.'</div>
			<div class="col-3">Total</div>
			<div class="col-3">₱ '.$totalcredit.'</div>
			</div>
			<div class="row">
			<div class="col-6" align="right"><b><i>'.$mark.' Balance:</i></b></div>
			<div class="col-6" align="center"><b><i>₱ '.$final_Bal.'</i></b></div>
			</div>
		</div>';



			}
		}
	}