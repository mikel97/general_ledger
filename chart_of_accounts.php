<?php
  include'includes/header.php';
  include'includes/navigation.php';
  include'classes/chart_of_accountsClass.php';
?>

<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	    Chart of Accounts	
	  </div>
	  <div class="card-body" style="height: 15cm; overflow: auto;">
	    <!---insert transaction here--->

	  	<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addAccount">
	  		<i class="fas fa-plus"></i>&nbsp; Add Account
	  	</button>
	    	<table class="table-sm shadow-sm mt-3" style="width: 100%;">
				<tr class="bg-primary text-white">
					<td class="pt-2 pl-3 pb-2"><b>Account No.</b></td>
					<td class="pt-2 pl-3 pb-2"><b>Account Title</b></td>
					<td class="pt-2 pl-3 pb-2"><b>Category</b></td>
					<td class="pt-2 pl-3 pb-2"><b>Type</b></td>
				</tr>
				<?php
					$accounts = new Accounts();
					$accounts->chartOfAccounts();
				?>
			</table>
	  </div>
	</div>
</div>

<form action="#" method="POST">
        <div class="modal fade" id="addAccount" tabindex="-1" role="dialog" aria-labelledby="addAccount" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  Add Account
                </div>
                <div class="modal-body">
                  	<div style="padding: 5px;">
						<h6>Account No.</h6><input class="form-control" type="number" name="acc_no" required="required">
					</div>
					<div style="padding: 5px;">
						<h6>Account Title</h6><input class="form-control" type="text" name="title" required="required">
					</div>
					<div style="padding: 5px;">
						<h6>Category</h6>
						<select class="form-control" name="category">
							<option value="Asset">Asset</option>
							<option value="Liabilities">Liabilities</option>
							<option value="Income">Income</option>
							<option value="Expense">Expense</option>
							<option value="Equity">Equity</option>
						</select>
					</div>
					<div style="padding: 5px;">
						<h6>Type</h6>
						<select class="form-control" name="type">
							<option value="Debit">Debit</option>
							<option value="Credit">Credit</option>
							<option value="Either">Either</option>
						</select>
					</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary" name="add">Add</button>
                </div>
              </div>
          </div>
        </div>
    </form>

    <?php
    if (isset($_POST['add'])) {
    	$add_accounts = new Accounts();
		$add_accounts->insert($_POST['acc_no'],$_POST['title'],$_POST['category'],$_POST['type']);
		echo '<script type="text/javascript">alert("Inserted");</script>';
    }
    else{

    }
?>
</body>