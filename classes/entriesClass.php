<?php

class Entries extends Dbh{

	public function entry(){
		$check = $this->connect()->query("SELECT DISTINCT date_of_transaction FROM finance_entries where status = 'Pending'");
		if ($check->fetch(PDO::FETCH_ASSOC) <= 0) {
			echo '<option value="none">No Entry</option>';
		}
		else{
			$statement = $this->connect()->query("SELECT DISTINCT date_of_transaction FROM finance_entries where status = 'Pending'");
			while($row = $statement->fetch(PDO::FETCH_ASSOC)){
				$date = date("M-j-Y", strtotime($row['date_of_transaction']));
				echo '<option value="'.$row["date_of_transaction"].'">Entry dated '.$date.'</option>';
			}
		}
	}
 
	public function showEntry($date){

		if ($date == "all") {
			$statement = $this->connect()->query("SELECT * FROM finance_entries where status = 'Pending'");
			while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$date = date("M-j-Y", strtotime($row['date_of_transaction']));
			echo '<tr class="text-dark">
            	<td class="p-2 border">'.$row["trans_no"].'</td>
            	<td class="p-2 border">'.$date.'</td>
            	<td class="p-2 border">'.number_format($row["amount"]).'</td>
            	<td class="p-2 border">'.$row["description"].'</td>
            	<td class="p-2 border">'.$row["process_by"].'</td>
          	</tr>';
		}
		}
		elseif ($date == "none") {
			echo '<script type="text/javascript">alert("No record");</script>';
		}
		else{
			$check = $this->connect()->query("SELECT * FROM finance_entries where date_of_transaction = '$date' and status = 'Pending'");
			if ($check->fetch(PDO::FETCH_ASSOC) <= 0) {
				echo '<script type="text/javascript">alert("No record");</script>';
			}
			else{
			$statement = $this->connect()->query("SELECT * FROM finance_entries where date_of_transaction = '$date' and status = 'Pending'");
			while($row = $statement->fetch(PDO::FETCH_ASSOC)){
			$date = date("M-j-Y", strtotime($row['date_of_transaction']));
			echo '<tr class="text-dark">
            	<td class="p-2 border">'.$row["trans_no"].'</td>
            	<td class="p-2 border">'.$date.'</td>
            	<td class="p-2 border">'.number_format($row["amount"]).'</td>
            	<td class="p-2 border">'.$row["description"].'</td>
            	<td class="p-2 border">'.$row["process_by"].'</td>
          	</tr>';
			}
		}
		}
	}
	public function insert($insert){
		if ($insert == "all") {
			$statement = "UPDATE finance_entries set status = 'Inserted' where status = 'Pending'";
			$this->connect()->prepare($statement)->execute([$insert]);
    	echo "<SCRIPT type='text/javascript'>
      	alert('Entries Inserted!');
      	window.location.replace(\"http:://../../Entries.php\");
      	</SCRIPT>";
		}elseif ($insert == "none") {
			echo '<script type="text/javascript">alert("No record");</script>';
		}
		else{
			$statement = "UPDATE finance_entries set status = 'Inserted' where date_of_transaction = ?";
			$this->connect()->prepare($statement)->execute([$insert]);
    	echo "<SCRIPT type='text/javascript'>
      	alert('Entries Inserted!');
      	window.location.replace(\"http:://../../Entries.php\");
      	</SCRIPT>";
		}
		
	}
}