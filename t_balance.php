<?php
  include'includes/header.php';
  include'includes/navigation.php';
  include'classes/TbalanceClass.php';
?>
<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	    Trial Balance	
	  </div>
	  <div class="card-body" style="height: 15cm; overflow: auto;">
	    <!---insert transaction here--->
	    <div class="col-12 row">
        <?php
          include'sorting.php';
        ?>

        <div class="col-4">
          <form action="pdfClass.php" method="POST">
            <button class="btn bg-primary text-white" type="submit" name="pdfTBalance" color: white; width: 3cm;">
              <i class="fas fa-download"></i> Save as PDF
            </button>
          </form>
        </div>
      </div>
	    <table class="rounded shadow-sm table-sm " style="width: 100%; color: #6c757d;">
			<thead>
				<tr class="table-active bg-primary text-white" align="center" style=" color: #003366;">
					<td  colspan="3"><b>Skyline Hotel & Restaurant<br>Trial Balance<br>Date</b></td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="pl-3 border-bottom"><b>Account Titles</b></td>
					<td align="right" class="border-bottom"><b>Debit</b></td>
					<td align="right" class="pr-5 border-bottom"><b>Credit</b></td>
				</tr>
				<?php
					$tbalance = new TB();
					if (isset($_POST['submit'])) {
              			if ($_POST['submit'] == "All") {
                			$tbalance->trial_balance(null,null);
              			}elseif ($_POST['submit'] == "Annual") {
                			$tbalance->trial_balance($_POST['year'],null);
              			}
              			else{
                			$tbalance->trial_balance($_POST['year'],$_POST['month']);
              			}
            		}else{
              			$tbalance->trial_balance(null,null);
            		}

				?>
			</tbody>
		</table>
	  </div>
	</div>
</div>