 <?php
	class Journal extends Dbh{
 
		public function journals($year,$month){
            if ($year == null) {
                  $sort1 = "";
                  $sort2 = "";
            }elseif ($month == null) {
                  $sort1 = "and YEAR(date_of_transaction) = '".$year."'";
                  $sort2 = "";      
            }
            else{
                  $sort1 = "and YEAR(date_of_transaction) = '".$year."'";
                  $sort2 = " and MONTH(date_of_transaction) = '".$month."'";
            }
            
		$statement = $this->connect()->query("SELECT * FROM finance_entries where status = 'Inserted' ".$sort1.$sort2." Order by date_of_transaction ASC");
		while($row = $statement->fetch(PDO::FETCH_ASSOC)) {

			$date = date("M-j-Y", strtotime($row['date_of_transaction']));
			$newDate = explode("-", $date);

			echo'<tr>
      			<td class="pl-2 border-left border-right border-bottom">'.$newDate[0]." ".$newDate[1].", ".$newDate[2]. '</td>
      			<td class="pl-2 border-left border-right border-bottom"></td>
      			<td class="pl-2 border-left border-right border-bottom"></td>
      			<td class="pl-2 border-left border-right border-bottom"></td>
      			<td class="pl-2 border-left border-right border-bottom"></td>
      		</tr>';
      			$statement2 = $this->connect()->query("SELECT * FROM finance_coa where account_id = '$row[debit]'");
      			while($acc = $statement2->fetch(PDO::FETCH_ASSOC)){

      			echo '<tr>
      				<td class="pl-2 border-left border-right border-bottom"></td>
      				<td class="pl-2 border-left border-right border-bottom">'.$acc['account_title'].'</td>
      				<td class="pl-2 border-left border-right border-bottom">'.$acc['account_no'].'</td>
      				<td class="pl-2 border-left border-right border-bottom">₱ '.number_format($row["amount"]).'</td>
      				<td class="pl-2 border-left border-right border-bottom"></td>
      			</tr>';
      		}
      			$statement3 = $this->connect()->query("SELECT * FROM finance_coa where account_id = '$row[credit]'");
      			while($acc2 = $statement3->fetch(PDO::FETCH_ASSOC)){
      			echo '<tr>
      				<td class="pl-2 border-left border-right border-bottom"></td>
      				<td class="pl-2 border-left border-right border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$acc2['account_title'].'</td>
      				<td class="pl-2 border-left border-right border-bottom">'.$acc2['account_no'].'</td>
      				<td class="pl-2 border-left border-right border-bottom"></td>
      				<td class="pl-2 border-left border-right border-bottom">₱ '.number_format($row["amount"]).'</td>
      			</tr>';
      		}

      		echo '<tr>
      			<td class="border-left border-right border-bottom"></td>
      			<td class="border-left border-right border-bottom">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( '.$row['description'].' )</td>
      			<td class="border-left border-right border-bottom"></td>
      			<td class="border-left border-right border-bottom"></td>
      			<td class="border-left border-right border-bottom"></td>
      			</tr>';
			}
		}	
	}

