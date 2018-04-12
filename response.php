<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <div class="alert alert-success">

    <strong >Success!</strong> Registration is successfull. <a href="login.php">Click here</a> to login.
  </div>
</div>
</body>
</html>

<?php
    session_start();
    require_once("connect_db.php");

    if(isset($_SESSION['email']) && isset($_SESSION['psw'])){
        if(!empty($_SESSION['email']) && !empty($_SESSION['psw'])){
            $email = $_SESSION['email'];
            $password = $_SESSION['psw'];
            $username = $_SESSION['username'];
            $firstname = $_SESSION['firstname'];
            $lastname = $_SESSION['lastname'];
            $sql = "INSERT INTO userdetails(username, email, password, firstname, lastname) VALUES('$username', '$email', '$password', '$firstname', '$lastname')";
            mysqli_query($conn,$sql);

        }
    }
    else {
        header("Location:register.php");
    }
    session_destroy();
 ?>
