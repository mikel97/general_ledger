<?php
	class Journal extends Dbh{

		public function journals(){
		$statement = $this->connect()->query("SELECT * FROM entry Order by transaction_date ASC");
		while($row = $statement->fetch(PDO::FETCH_ASSOC)) {

			$date = date("M-j-Y", strtotime($row['transaction_date']));
			$newDate = explode("-", $date);

			echo'<tr>
      			<td class="pl-2">'.$newDate[0]." ".$newDate[1].", ".$newDate[2]. '</td>
      			<td class="pl-2"></td>
      			<td class="pl-2"></td>
      			<td class="pl-2"></td>
      			<td class="pl-2"></td>
      		</tr>';
      		$statement2 = $this->connect()->query("SELECT * FROM debit where entry_id = '$row[e_id]'");
      		while($row2 = $statement2->fetch(PDO::FETCH_ASSOC)){
      			$statement4 = $this->connect()->query("SELECT Accoutnt_title FROM account_title where Account_no = '$row2[acc_no]'");
      			$acc = $statement4	->fetch(PDO::FETCH_ASSOC);
      			echo '<tr>
      				<td class="pl-2"></td>
      				<td class="pl-2">'.$acc['Accoutnt_title'].'</td>
      				<td class="pl-2">'.$row2['acc_no'].'</td>
      				<td class="pl-2">₱ '.$row2['amout'].'</td>
      				<td class="pl-2"></td>
      			</tr>';
      		}
      		$statement3 = $this->connect()->query("SELECT * FROM credit where entry_id = '$row[e_id]'");
      		while($row3 = $statement3->fetch(PDO::FETCH_ASSOC)){
      			$statement5 = $this->connect()->query("SELECT Accoutnt_title FROM account_title where Account_no = '$row3[acc_no]'");
      			$acc2 = $statement5->fetch(PDO::FETCH_ASSOC);
      			echo '<tr>
      				<td class="pl-2"></td>
      				<td class="pl-2">'.$acc2['Accoutnt_title'].'</td>
      				<td class="pl-2">'.$row3['acc_no'].'</td>
      				<td class="pl-2"></td>
      				<td class="pl-2">₱ '.$row3['amout'].'</td>
      			</tr>';
      		}

      		echo '<tr>
      			<th scope="row"></th>
      			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( '.$row['Description'].' )</td>
      			<td></td>
      			<td></td>
      			<td></td>
      			</tr>';
			}
		}	
	}

