<?php
  include'includes/header.php';
  include'includes/navigation.php';
  include'classes/entriesClass.php';
?>

<div class="col-12 col-sm-9">
	<div class="card mt-3 shadow-sm">
	  <div class="navigation text-white card-header">
	    New Entries
	  </div>

	  <div class="card-body" style="height: 15cm; overflow: auto;">
      <!-- Transaction here -->
      <form action="" method="POST">
	  	<div class="btn-group col-4" role="group">
        <select class="form-control" name="entry">
          <?php 
            $entry = new Entries(); 
            $entry->entry();
          ?>
          <option value="all">View All</option>
        </select>
        <button class="btn btn-primary" type="submit" name="view">View</button>
      </div>
      </form>
      <div class="col-12 mt-3">
        <?php
          if (isset($_POST['view'])) {
        ?>
        <div class="float-right mb-2">
          <form action="" method="POST">
            <button class="btn btn-primary" type="submit" name="insert" value=<?php echo $_POST['entry']; ?> >Insert to Journal</button>
          </form>
        </div>
        <table class="table-sm shadow-sm" width="100%">
        <thead>
          <tr class="text-white bg-primary">
            <th scope="col" class="p-2">Transaction #</th>
            <th scope="col" class="p-2">Date</th>
            <th scope="col" class="p-2">Amount</th>
            <th scope="col" class="p-2">Description</th>
            <th scope="col" class="p-2">Processed By</th>
          </tr>
          <tbody>
            <?php
                $entry->showEntry($_POST['entry']);
            ?>
          </tbody>
        </thead>
        </table>
        <?php
          }
          else {

          }
  if (isset($_POST['insert'])) {
    $entry->insert($_POST['insert']);
  }
        ?>
      </div>
	  </div>
	</div>
</div>
