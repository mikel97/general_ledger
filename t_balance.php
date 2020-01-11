<?php
  include'includes/header.php';
  include'includes/navigation.php';
  include'classes/database.php';
  include'classes/TbalanceClass.php';
?>
<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	    Trial Balance	
	  </div>
	  <div class="card-body" style="height: 15cm; overflow: auto;">
	    <!---insert transaction here--->

	    <table class="rounded shadow table-sm " style="width: 100%; color: #6c757d;">
			<thead>
				<tr class="table-active bg-primary text-white" align="center" style=" color: #003366;">
					<td  colspan="3"><b>Skyline Hotel & Restaurant<br>Trial Balance<br>Date</b></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="padding-left: 1cm;"><b>Account Titles</b></td>
					<td align="right"><b>Debit</b></td>
					<td align="right" style="padding-right: 2cm;"><b>Credit</b></td>
				</tr>
				<?php
					$tbalance = new TB();
					$tbalance->trial_balance();
				?>
			</tbody>
		</table>
	  </div>
	</div>
</div>