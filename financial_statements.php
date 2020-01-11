<?php
  include'includes/header.php';
  include'includes/navigation.php';
  include'classes/financial_statementClass.php';
?>

<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	    Financial Statements	
	  </div>
	  <div class="card-body" style="height: 15cm; overflow: auto;">
	  <div class="col-12 row">
        <?php
          include'sorting.php';
        ?>

        <div class="col-4">
          <form action="pdf.php" method="POST">
            <button class="btn bg-primary text-white" type="submit" name="print" color: white; width: 3cm;">
              <i class="fas fa-download"></i> Save as PDF
            </button>
          </form>
        </div>
      </div>

      	    <?php
	    	$year = null;
	    	$month = null;
        	if (isset($_POST['submit'])) {
              if ($_POST['submit'] == "All") {
                $year = null;
	    		$month = null;
              }elseif ($_POST['submit'] == "Annual") {
                $year = $_POST['year'];
                $month = null;
              }
              else{
                $year = $_POST['year'];
                $month = $_POST['month'];
              }
            }else{
              	$year = null;
	    		$month = null;
            }
      	?>

	    <!---insert transaction here--->

	    <div class="row p-0">
	    <!-------- INCOME STATEMENT --------------->
	    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<table class="rounded shadow table-sm" style="height: 100%; width: 100%; color: #6c757d;">
				<thead>
					<tr class="table-active bg-primary text-white" align="center" style=" color: #003366;">
						<td  colspan="3"><b>Skyline Hotel & Restaurant<br>Income Statement<br>Date</b></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><b>Income</b></td>
						<td></td>
						<td></td>
					</tr>
					<?php
						$financial = new Financial();
            			$financial->income("Income",$year,$month);
            		?>
            		<tr>
						<td><b>Expense</b></td>
						<td></td>
						<td></td>
					</tr>
            		<?php	
            			$financial->income("Expense",$year,$month);
            			$financial->net("Income","Expense",$year,$month);
          			?>
				</tbody>
			</table>
		</div>

		<!--------------------- BALANCE SHEET ---------------->
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<table class="rounded shadow table-sm" style="height: 100%; width: 100%; color: #6c757d;">
				<thead>
					<tr class="table-active bg-primary text-white" align="center" style=" color: #003366;">
						<td  colspan="3"><b>Skyline Hotel & Restaurant<br>Balance Sheet<br>Date</b></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><b><i>Asset:</i></b></td>
						<td></td>
						<td></td>
					</tr>
					<?php	
            			$financial->balanceSHEET("Asset",$year,$month);
          			?>
          			<tr>
						<td><b><i>Total Asset:</i></b></td>
						<td align="right">₱ 
							<?php	
            					echo number_format($financial->TOTALS);
          					?>
						</td>
						<td></td>
					</tr>
					<tr>
						<td><b><i>Liabilities:</i></b></td>
						<td></td>
						<td></td>
					</tr>
					<?php	
						$financial1 = new Financial();
            			$financial1->balanceSHEET("Liabilities",$year,$month);
          			?>
          			<tr>
						<td><b><i>Total Liabilities:</i></b></td>
						<td></td>
						<td align="right"> ₱
							<?php	
            					echo number_format($financial1->TOTALS);
          					?>
						</td>
					</tr>
					<tr>
						<td><b><i>Equity:</i></b></td>
						<td></td>
						<td></td>
					</tr>
					<?php	
						$financial2 = new Financial();
            			$financial2->balanceSHEET("Equity",$year,$month);
          			?>
          			<tr>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Net 
							<?php	
            					echo $financial->remarks;
          					?>
						</td>
						<td></td>
						<td align="right">₱ 
							<?php	
            					echo number_format($financial->NET);
          					?>
						</td>
					</tr>
          			<tr>
						<td><b><i>Total Equity:</i></b></td>
						<td></td>
						<td align="right">₱ 
							<?php
								if($financial->remarks == "Income"){
									$equity = $financial2->TOTALS + $financial->NET;
								}
								elseif ($financial->remarks == "Loss") {
									$equity = $financial2->TOTALS - $financial->NET;
								}
            					echo number_format($equity);
          					?>
						</td>
					</tr>
					<tr>
						<td><b><i>Total Liabilities and Equity:</i></b></td>
						<td></td>
						<td align="right">₱ 
							<?php	
            					$total = $financial1->TOTALS + $equity;
            					echo number_format($total);
          					?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		</div>
	  </div>
	</div>
</div>