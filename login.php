<!DOCTYPE html>
<html>
<head>
	<title>Skyline Hotel and Restaurant</title>
	<!-- links for bootstrap na nagamit -->
	<meta content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<style>
	
</style>
<body>
	<div class="container" >  
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
	      <div class="form">
	        <!-- the input -->
	      <div class="first-row">
	        <h2 class="first" >Skyline</h2>
	      </div>
	      <br>
	        <form action="login_control.php" method="post">
	          <div class="input-group">
	            <input type="text" class="form-control" placeholder="Username" name="username" >
	            <span class="input-group-addon">
	              <span class="fa fa-user fa-2x"></span>
	            </span>
	          </div>
	          <div class="input-group">
	            <input type="password" class="form-control" placeholder="Password" name="password">
	            <span class="input-group-addon">
	              <span class="fa fa-lock fa-2x"></span>
	            </span>
	          </div>
	        	<div style="margin-top: 1cm;">
	        		<button class="btn btn-primary btn-lg login-btn" type="submit" name="login">Login</button>
	        	</div>
	        </form>
	      </div>
	    </div>
    </div>

</body>
</html>