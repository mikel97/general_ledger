<?php
  include'includes/header.php';
  include'includes/navigation.php';
  include'classes/database.php';
  include'classes/ledgerClass.php';
?>

<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	    General Ledger Posting	
	  </div>
	  <div class="card-body" style="height: 15cm; overflow: auto;">
	    <!---insert transaction here--->


	    <!-- ASSET -->

	    <div class="row col-12 ml-1 bg-primary" style="padding: 10px; height: 1cm; padding: 0;">
			<div class="col-10" style="color: #ffff; text-align: left;"><h4>Assets</h4></div>
			<div class="col-2" style=" color: #ffff; text-align: right;"><h6 style="cursor: pointer;" onclick="openAsset()"><i class="fas fa-minus" id="min" style="margin-top: 10px;"></i><i class="fas fa-plus" id="max" style="display: none; margin-top: 10px;"></i></h6></div>
		</div>

			<script>
				var toggleAsset = 1;
				function openAsset(){
					if (toggleAsset == 1) {
						document.getElementById("asset").style.display = "none";
						document.getElementById("max").style.display = "block";
						document.getElementById("min").style.display = "none";
						toggleAsset = 0;
					}else if(toggleAsset == 0){
						document.getElementById("asset").style.display = "block";
						document.getElementById("max").style.display = "none";
						document.getElementById("min").style.display = "block";
						toggleAsset = 1;
					}
				}
 			</script>

		<div class="row col-12 ml-2" id="asset" style="padding: 10px;">

			<?php
				$ledger = new GL();
				$ledger->ledger("Asset");

			?>

		</div>

		<!-- LIABILITIES -->

	    <div class="row col-12 ml-1 bg-primary" style="padding: 10px; height: 1cm; padding: 0; margin-top: 2px;">
			<div class="col-10" style="color: #ffff; text-align: left;"><h4>Liabilities</h4></div>
			<div class="col-2" style=" color: #ffff; text-align: right;"><h6 style="cursor: pointer;" onclick="openliability()"><i class="fas fa-minus" id="min1" style="margin-top: 10px;"></i><i class="fas fa-plus" id="max1" style="display: none; margin-top: 10px;"></i></h6></div>
		</div>

			<script>
				var toggleLiabilities = 1;
				function openliability(){
					if (toggleLiabilities == 1) {
						document.getElementById("liabilities").style.display = "none";
						document.getElementById("max1").style.display = "block";
						document.getElementById("min1").style.display = "none";
						toggleLiabilities = 0;
					}else if(toggleLiabilities == 0){
						document.getElementById("liabilities").style.display = "block";
						document.getElementById("max1").style.display = "none";
						document.getElementById("min1").style.display = "block";
						toggleLiabilities = 1;
					}
				}
 			</script>

		<div class="row col-12 ml-2" id="liabilities" style="padding: 10px;">
			<?php
				$ledger1 = new GL();
				$ledger1->ledger("Liabilities");

			?>
		</div>


		<!-- EQUITY -->

	    <div class="row col-12 ml-1 bg-primary" style="padding: 10px; height: 1cm; padding: 0; margin-top: 2px;">
			<div class="col-10" style="color: #ffff; text-align: left;"><h4>Equities</h4></div>
			<div class="col-2" style=" color: #ffff; text-align: right;"><h6 style="cursor: pointer;" onclick="openEquity()"><i class="fas fa-minus" id="min2" style="margin-top: 10px;"></i><i class="fas fa-plus" id="max2" style="display: none; margin-top: 10px;"></i></h6></div>
		</div>

			<script>
				var toggleEquity = 1;
				function openEquity(){
					if (toggleEquity == 1) {
						document.getElementById("equity").style.display = "none";
						document.getElementById("max2").style.display = "block";
						document.getElementById("min2").style.display = "none";
						toggleEquity = 0;
					}else if(toggleEquity == 0){
						document.getElementById("equity").style.display = "block";
						document.getElementById("max2").style.display = "none";
						document.getElementById("min2").style.display = "block";
						toggleEquity = 1;
					}
				}
 			</script>

		<div class="row col-12 ml-2" id="equity" style="padding: 10px;">
			<?php
				$ledger2 = new GL();
				$ledger2->ledger("Equity");

			?>
		</div>

		<!-- INCOME -->

	    <div class="row col-12 ml-1 bg-primary" style="padding: 10px; height: 1cm; padding: 0; margin-top: 2px;">
			<div class="col-10" style="color: #ffff; text-align: left;"><h4>Income</h4></div>
			<div class="col-2" style=" color: #ffff; text-align: right;"><h6 style="cursor: pointer;" onclick="openIncome()"><i class="fas fa-minus" id="min3" style="margin-top: 10px;"></i><i class="fas fa-plus" id="max3" style="display: none; margin-top: 10px;"></i></h6></div>
		</div>

			<script>
				var toggleIncome = 1;
				function openIncome(){
					if (toggleIncome == 1) {
						document.getElementById("income").style.display = "none";
						document.getElementById("max3").style.display = "block";
						document.getElementById("min3").style.display = "none";
						toggleIncome = 0;
					}else if(toggleIncome == 0){
						document.getElementById("income").style.display = "block";
						document.getElementById("max3").style.display = "none";
						document.getElementById("min3").style.display = "block";
						toggleIncome = 1;
					}
				}
 			</script>

		<div class="row col-12 ml-2" id="income" style="padding: 10px;">
			<?php
				$ledger3 = new GL();
				$ledger3->ledger("Income");

			?>
		</div>

		<!-- EXPENSES -->

	    <div class="row col-12 ml-1 bg-primary" style="padding: 10px; height: 1cm; padding: 0; margin-top: 2px;">
			<div class="col-10" style="color: #ffff; text-align: left;"><h4>Expenses</h4></div>
			<div class="col-2" style=" color: #ffff; text-align: right;"><h6 style="cursor: pointer;" onclick="openExpense()"><i class="fas fa-minus" id="min4" style="margin-top: 10px;"></i><i class="fas fa-plus" id="max4" style="display: none; margin-top: 10px;"></i></h6></div>
		</div>

			<script>
				var toggleExpense = 1;
				function openExpense(){
					if (toggleExpense == 1) {
						document.getElementById("expense").style.display = "none";
						document.getElementById("max4").style.display = "block";
						document.getElementById("min4").style.display = "none";
						toggleExpense = 0;
					}else if(toggleExpense == 0){
						document.getElementById("expense").style.display = "block";
						document.getElementById("max4").style.display = "none";
						document.getElementById("min4").style.display = "block";
						toggleExpense = 1;
					}
				}
 			</script>

		<div class="row col-12 ml-2" id="expense" style="padding: 10px;">
			<?php
				$ledger4 = new GL();
				$ledger4->ledger("Expense");

			?>
		</div>


	  </div>
	</div>
</div>