<?php
  include'includes/header.php';
  include'includes/navigation.php';
  include'classes/database.php';
  include'classes/journalClass.php';
?>
	  	
<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	    General Journal	
	  </div>
	  <div class="card-body" style="height: 15cm; overflow: auto;">
      <!-- Transaction here -->
	  	
      <div class="col-12">
        <table class="table-sm" width="100%" border="1">
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
            $journal->journals();
          ?>

        </thead>
        </table>
      </div>
      
	  </div>
	</div>
</div>
