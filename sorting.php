<?php
	include'classes/sortingClass.php';

	/**
	 * 
	 */
?>

	<div class="col-4 btn-group mb-3" role="group">	
  		<select class="form-control" name="target" id="select">
    		<option value="All">All</option>
    		<option value="Monthly">Monthly</option>
    		<option value="Annual">Annually</option>
  		</select>
  		<button class="btn btn-primary" style="width: 3cm;" type="submit" data-toggle="modal" data-target="#target" onclick="open1()"><i class="fas fa-filter"></i> Filter</button>
	</div>
			<script>
				function open1(){
					if (document.getElementById("select").value == "All") {
						document.getElementById("target").hidden = "true";
						document.getElementById("click").value = "All";
						document.getElementById("click").click();
					}
					else{
						
						if (document.getElementById("select").value == "Annual") {
							document.getElementById("month").hidden = "true";
							document.getElementById("label").hidden = "true";
							document.getElementById("month").value = null;
							document.getElementById("tag").innerHTML = document.getElementById("select").value;
							document.getElementById("click").value = document.getElementById("select").value;
						}else{
							document.getElementById("tag").innerHTML = document.getElementById("select").value;
							document.getElementById("click").value = document.getElementById("select").value;
						}
					}
				}
 			</script>


<form action="" method="POST">
	<div class="modal fade" id="target" tabindex="-1" role="dialog" aria-labelledby="target" aria-hidden="false">
  		<div class="modal-dialog modal-dialog-scrollable" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
      				<h4 id="tag"></h4>
      			</div>
	      		<div class="modal-body">
	      			<i>Year</i>
  					<select class="form-control" name="year">
  						<?php 
  							$sorting = new Sorting();
  							$sorting->selectYear();
  						?>
  					</select>
  					<i id="label">Month</i>
  					<select class="form-control" name="month" id="month">
  						<option value="01">January</option>
  						<option value="02">Febuary</option>
  						<option value="03">March</option>
  						<option value="04">April</option>
  						<option value="05">May</option>
  						<option value="06">June</option>
  						<option value="07">July</option>
  						<option value="08">August</option>
  						<option value="09">September</option>
  						<option value="10">October</option>
  						<option value="11">November</option>
  						<option value="12">December</option>
  					</select>
			    </div>
			    <div class="modal-footer">
        			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        			<button type="submit" class="btn btn-primary" name="submit" id="click">Apply changes</button>
      			</div>
		    </div>
		</div>
	</div>
</form>