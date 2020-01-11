<?php 
$Debit = 0;
$Credit = 0;
if (isset($_POST['submit_annual'])) {
  $_SESSION['query'] = " where Year(transaction_date) = '$_POST[annual]' Order by transaction_date Asc";
  $_SESSION['journal'] = "Journal for the year ".$_POST['annual'];
}
elseif(isset($_POST['all'])){
  $_SESSION['query'] = " Order by transaction_date Asc";
  $_SESSION['journal'] = "Journal as of ".date("M-d-Y");
}
elseif (isset($_POST['submit_semi-annual'])) {

  if ($_POST['optradioSemi'] == '01') {
    $first = '1';
    $last = '6';
    $_SESSION['journal'] = "Journal from January ".$_POST['semiannual']." to June ".$_POST['semiannual'];
  }
  else{
    $first = '07';
    $last = '12';
    $_SESSION['journal'] = "Journal from January ".$_POST['semiannual']." to June ".$_POST['semiannual'];
  }
  $_SESSION['query'] = " where MONTH(transaction_date) >= '$first' And MONTH(transaction_date) <= '$last' and YEAR(transaction_date) = '$_POST[semiannual]' Order by transaction_date Asc";
}
elseif (isset($_POST['quarterly'])) {
  if ($_POST['quarter'] == 1) {
    $last = 3;
    $_SESSION['journal'] = "Journal for the first quarter of ".$_POST['selectYear'];
  }elseif ($_POST['quarter'] == 4) {
    $last = 6;
    $_SESSION['journal'] = "Journal for the second quarter of ".$_POST['selectYear'];
  }elseif ($_POST['quarter'] == 7) {
    $last = 9;
    $_SESSION['journal'] = "Journal for the third quarter of ".$_POST['selectYear'];
  }elseif ($_POST['quarter'] == 10) {
    $last = 12;
    $_SESSION['journal'] = "Journal for the fourth quarter of ".$_POST['selectYear'];
  }
  $_SESSION['query'] = " entry where YEAR(transaction_date) = '$_POST[selectYear]' and MONTH(transaction_date) >= '$_POST[quarter]' and MONTH(transaction_date) <= '$last' Order by transaction_date Asc";
}
elseif (isset($_POST['monthly'])) {
  $_SESSION['query'] = " where YEAR(transaction_date) = '$_POST[Year]' and MONTH(transaction_date) = '$_POST[Month]' Order by transaction_date Asc";
  $_SESSION['journal'] = "Journal for the month of ".$_POST['Year'];
}
elseif (isset($_POST['custom'])) {
  $_SESSION['query'] = " where YEAR(transaction_date) = '$_POST[year]' and MONTH(transaction_date) >= '$_POST[from]' and MONTH(transaction_date) <= '$_POST[to]' Order by transaction_date Asc";
  $_SESSION['journal'] = "Journal from the month ".$_POST['from']." ".$_POST['year']." to ".$_POST['to']." ".$_POST['year'];
}

?>

<div class="col-12" style="margin-top: 1cm;">
			   		<center>
			   		<table class="table table-sm bg-light rounded shadow" id="table" >
  						<thead class="table-active rounded shadow-sm" style=" color: #003366;">
    						<tr>
      							<th scope="col">Date</th>
      							<th scope="col">Account Titles & Explanation</th>
      							<th scope="col">Ref</th>
      							<th scope="col">Debit</th>
      							<th scope="col">Credit</th>
    						</tr>
  						</thead>
  						<tbody>
  						<?php
              if (!isset($_SESSION['query'])) {
                $session = "";
                $_SESSION['query'] = "";
                $_SESSION['journal'] = "As of ".date("M-d-Y");
              }
              else{
                $session = $_SESSION['query'];
              }
			   				$sql = "SELECT * FROM entry".$session;
  							$result = mysqli_query($conn, $sql);
							while($row = mysqli_fetch_assoc($result)){	
                  
									$sql3 = "SELECT * FROM debit where entry_id = '$row[e_id];'";
  									$result3 = mysqli_query($conn, $sql3);
									$sql4 = "SELECT * FROM credit where entry_id = '$row[e_id];'";
  									$result4 = mysqli_query($conn, $sql4);

                    $month = 0;
                    $newDate = explode('-', $row['transaction_date']);
                    $newMonth = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
                    if ($newDate[1] == '01') {
                      $month = 0;
                    }elseif ($newDate[1] == '02') {
                      $month = 1;
                    }
                    elseif ($newDate[1] == '03') {
                      $month = 2;
                    }
                    elseif ($newDate[1] == '04') {
                      $month = 3;
                    }
                    elseif ($newDate[1] == '05') {
                      $month = 4;
                    }
                    elseif ($newDate[1] == '06') {
                      $month = 5;
                    }
                    elseif ($newDate[1] == '07') {
                      $month = 6;
                    }
                    elseif ($newDate[1] == '08') {
                      $month = 7;
                    }
                    elseif ($newDate[1] == '09') {
                      $month = 8;
                    }
                    elseif ($newDate[1] == '10') {
                      $month = 9;
                    }
                    elseif ($newDate[1] == '11') {
                      $month = 10;
                    }
                    elseif ($newDate[1] == '12') {
                      $month = 11;
                    }
                    $dates = date("M-j-Y", strtotime($row['transaction_date']));
                    $newDates = explode("-", $dates);

									echo'<tr>
      									<th scope="row">'.$newDates[0].' '.$newDates[1].','.$newDates[2].'</th>
      									<td></td>
      									<td></td>
      									<td></td>
      									<td></td>
      									</tr>';
      						//Debit
										while($row3 = mysqli_fetch_assoc($result3)){
											$sql2 = "SELECT Accoutnt_title FROM account_title where Account_no = '$row3[acc_no]'";
  											$result2 = mysqli_query($conn, $sql2);
											$row2 = mysqli_fetch_assoc($result2);
      										echo '<tr></tr>
      												<th scope="row"></th>
      												<td>'.$row2['Accoutnt_title'].'</td>
      												<td>'.$row3['acc_no'].'</td>
      												<td>₱ '.$row3['amout'].'</td>
      												<td></td>
      											</tr>';
                            $Debit = $Debit + $row3['amout'];
      									}
      						//Credit
  										while($row4 = mysqli_fetch_assoc($result4)){
											$sql5 = "SELECT Accoutnt_title FROM account_title where Account_no = '$row4[acc_no]'";
  											$result5 = mysqli_query($conn, $sql5);
											$row5 = mysqli_fetch_assoc($result5);
      											echo '<tr>
      												<th scope="row"></th>
      												<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row5['Accoutnt_title'].'</td>
      												<td>'.$row4['acc_no'].'</td>
      												<td></td>
      												<td>₱ '.$row4['amout'].'</td>
      											</tr>';
                            $Credit = $Credit + $row4['amout'];
  										}
      								echo '<tr>
      										<th scope="row"></th>
      										<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( '.$row['Description'].' )</td>
      										<td></td>
      										<td></td>
      										<td></td>
      									</tr>';    							
      								}

      								echo '
  										<tr>
  											<td scope="row" colspan="3" align="center"><b><br><br>Total</b></td>
  											<td><b><br><br>₱'.$Debit.'</b></td>
  											<td><b><br><br>₱ '.$Credit.'</b></td>
  										</tr>';
  							?>
  						</tbody>
					</table>
					</center>
			   	</div>

