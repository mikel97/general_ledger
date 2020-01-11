<?php
session_start();
if (isset($_SESSION['user_id'])) {
  
}
else{
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Skyline Hotel and Restaurant</title>
	<link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="fontawesome/css/all.css">
	<link rel="stylesheet" href="design.css">
	<script src="bootstrap-4.3.1-dist/js/jquery-3.4.1.min.js"></script>
	<script src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head> 
<body class="bg-light">
<?php
	include'classes/database.php';
?>