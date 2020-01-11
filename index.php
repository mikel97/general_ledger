
<!---follow the includes position--->


<?php
	include'header.php';
	include'sidebar.php';
?>
	<!--sidenavigation-->

	<nav id="mySidenav" class="sidenav">

			<!-- you can change this depends on you

			  <button type="button" class="attriv btn btn-primary mt-2 ml-2" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="top" title="Account Settings"><i class="fas fa-user-cog"></i></button>
			  <button type="button" class="attriv btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModal1" data-toggle="tooltip" data-placement="top" title="Add Event"><i class="fas fa-plus"></i></button>
			  <button type="button" class="attriv btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModal2" data-toggle="tooltip" data-placement="top" title="Help"><i class="fas fa-question-circle"></i></button>
			  <button type="button" class="attriv btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModal3" data-toggle="tooltip" data-placement="top" title="Settings"><i class="fas fa-sliders-h"></i></button>
	       <hr> --->

	       <!-- Change this depends on your module--->

	    <div class="sample nav flex-column nav-pills mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
	      <a class="active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-chart-line"></i> Dashboard</a>
	      <a class="" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">News Feed</a>
	      <a class="" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Events</a>
	      <a class="k" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Profile</a>
	    </div>
	</nav>

	<div id="main">
		<?php
			include'topnavigation.php';
		?>
	 <!-- insert your transaction here--->
	  
    <div class="container-fluid">
    	<div class="tab-content" id="v-pills-tabContent">
	      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

	      	<!---First transaction here-->
	      	<?php
	      	  include'dashboard.php';
	      	?>
	      </div>
	      <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
	      	<h1>News Feed</h1>
	      	<!-- Second Transaction Here -->
	      </div>
	      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
	      	<h1>Event</h1>
	      	<!-- Third Transaction Here -->
	      </div>
	      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
	      	<h1>Profile</h1>
	      	<!-- 4th Transaction Here -->
	      </div>
	    </div>
      </div>
  </div>


  <?php
	include'modal.php';
?>




</body>
</html>