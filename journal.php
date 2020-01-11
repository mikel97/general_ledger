<?php
  include'includes/header.php';
  include'includes/navigation.php';
  include'classes/journalClass.php';
?>
	  	
<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	    General Journal	
	  </div>
    
	  <div class="card-body" style="height: 15cm; overflow: auto;">
      <!-- Transaction here -->

      <div class="col-12 row">
        <?php
          include'sorting.php';
        ?>

        <div class="col-4">
          <form action="pdfClass.php" method="POST">
            <button class="btn bg-primary text-white" type="submit" name="pdfJournal" color: white; width: 3cm;">
              <i class="fas fa-download"></i> Save as PDF
            </button>
          </form>
        </div>
      </div>

      <div class="col-12">
        <table class="table-sm shadow-sm" width="100%">
        <thead>
          <tr class="text-white bg-primary">
            <th scope="col" class="p-2">Date</th>
            <th scope="col" class="p-2">Account Titles & Explanation</th>
            <th scope="col" class="p-2">Ref</th>
            <th scope="col" class="p-2">Debit</th>
            <th scope="col" class="p-2">Credit</th>
          </tr>
          <?php
            $journal = new Journal();
            if (isset($_POST['submit'])) {
              if ($_POST['submit'] == "All") {
                $journal->journals(null,null);
              }elseif ($_POST['submit'] == "Annual") {
                $journal->journals($_POST['year'],null);
              }
              else{
                $journal->journals($_POST['year'],$_POST['month']);
              }
            }else{
              $journal->journals(null,null);
            }
          ?>

        </thead>
        </table>
      </div>
    
	  </div>
	</div>
</div>
    