
<!DOCTYPE html>
<html>
<head>
  <title>REQUEST PORTAL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--Bootstrap CDN link------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!--Semantic UI CDN link------------>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/button.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/icon.min.css">
    <!--Google Fonts CDN link----------->
    <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round&display=swap" rel="stylesheet">
      <!--CSS Style sheet link------------>
    <link rel="stylesheet" type="text/css" href="login.css">
    <!--Fontawesome ICON CDN link----------->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">

      <!-- JQUERY / Bootstrap CDN Scripts---------->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>
<body>

<?php
include'classes/database.php';
$dbs = new Dbh();

  session_start();

  $username = $password = "";
  $account_nameErr = $passwordErr = "";
  $atmps = 0;

  if (isset($_POST['login'])) {
    
    $atmps = $_POST['hidden'];  

    if (empty($_POST['username'])) {
      
    }else{
      $username = $_POST['username'];
    }

    if (empty($_POST['password'])) {
      $passwordErr = "Password is required!";
    }else{
      $password = $_POST['password'];
    }


    if ($username && $password) {
      if ($atmps < 3) {
      $statement = $dbs->connect()->query("SELECT * FROM users where username = '$username'");
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      if (!is_null($row)) {
        
        $user_id = $row['user_id'];
        $username = $row['username'];
        $db_password = $row['password'];
        $name = $row['name'];
        $role = $row['role'];

        if ($password == $db_password) {

          $_SESSION['user_id'] = $user_id;
          $_SESSION['name'] = $name;
          $_SESSION['role'] = $role;

          echo "<SCRIPT type='text/javascript'>
          alert('Welcome ".$row['username']."!');
          window.location.replace(\"http:://../../index.php\");
          </SCRIPT>";

        }else{
          $atmps++;
          $passwordErr = "Incorrect Password!";
          echo "<script>alert('Number of Attempts $atmps')</script>";
        }

      }else{
        $atmps++;
        $account_nameErr = "Username is not Registered!";
        echo "<script>alert('Number of Attempts $atmps')</script>";
      }
    }
  }

  if ($atmps == 3) {
         echo "<script>alert('Login Limit Exceed')</script>";
     }
  }
?>


<div class="wrapper">
  <form class="form-signin" method="POST">
    <?php
        echo "<input type='hidden' name='hidden' value='".$atmps."'>";
    ?>
    <h2 class="form-signin-heading text-center">GENERAL LEDGER SYSTEM</h2>
    <hr>
    <label for="exampleInputEmail1">Account Name</label>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
      </div>
      <input type="text" name="username" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <label for="exampleInputEmail1">Password</label>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fas fa-unlock-alt"></i></span>
      </div>
      <input type="password" name="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <hr><br>

    <input class="login btn btn-block text-white" type="submit"  name="login" value="Login">
    
  </form>
  <center>
    <br>
    <?php 
    if (!empty($account_nameErr)) {
      echo '<span class="alert alert-danger text-center" role="alert" >'.$account_nameErr.'</span><br><br>';
    }else{
      echo '<span class="alert alert-danger text-center" role="alert" hidden>'.$account_nameErr.'</span><br><br>';
    }

   ?>
   <br>
   <?php 
    if (!empty($passwordErr)) {
      echo '<span class="alert alert-danger text-center" role="alert" >'.$passwordErr.'</span><br><br>';
    }else{
      echo '<span class="alert alert-danger text-center" role="alert" hidden>'.$passwordErr.'</span><br><br>';
    }

   ?>
   </center>
</div>