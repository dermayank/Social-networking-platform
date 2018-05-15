<?php
    require_once("connect_db.php");

    function verify_details($email, $username){
        global $conn;
        $sql1 = "SELECT * FROM $user_table where `email`= '$email'";
        $sql2 = "SELECT * FROM $user_table where `username`= '$username'";
        $result1 = mysqli_query($conn, $sql1);
        $result2 = mysqli_query($conn, $sql2);
        if(mysqli_num_rows($result1)>0){
            return 1;
        }
        if(mysqli_num_rows($result2)>0){
            return 2;
        }
        return 3;
    }

 ?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="css/register.css">
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php

    session_start();

    if(isset($_SESSION['username']) && isset($_SESSION['state'])){
        if(!empty($_SESSION['username']) && !empty($_SESSION['state'])){
            if($_SESSION['state'] == 1){
                header("Location:login.php");
            }
        }
    }

    if(isset($_POST['login'])){
        if(!empty($_POST['email'])&&!empty($_POST['psw'])&&!empty($_POST['psw-repeat'])&&!empty($_POST['username'])&&!empty($_POST['fullname'])&&!empty($_POST['lastname'])){
            if($_POST['psw-repeat'] == $_POST['psw']){
                $return_value = verify_details($_POST['email'],$_POST['username']);
                if($return_value==3){
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['psw'] = $_POST['psw'];
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['fullname'] = $_POST['fullname'];
                    $_SESSION['lastname'] = $_POST['lastname'];
                    header("Location:response.php");
                    die();
                }
                else if($return_value == 2){
                    ?>
                    <div class="container">
                      <div class="alert alert-danger">
                        <strong >Error!</strong> Username already taken
                      </div>
                    </div>
                    <?php
                }
                else {
                    ?>
                    <div class="container">
                      <div class="alert alert-danger">
                        <strong >Error!</strong> Email id already Exist.
                      </div>
                    </div>
                    <?php
                }
            }
            else{
                ?>
                <div class="container">
                  <div class="alert alert-danger">
                    <strong >Error!</strong> Password didnt match.
                  </div>
                </div>
                <?php
            }
        }
    }
?>


<form method="post" action="" style="border:1px solid #ccc">
  <div class="container">
    <div class="omb_login">
        <h3 class="omb_authTitle">Sign Up or <a href="login.php">Login</a></h3>
        <hr>

        <input type="text" placeholder="@What do we call you" name="username" class="form-control" required>
        <input type="text" placeholder="Full Name" name="fullname" class="form-control" required>
        <input type="text" placeholder="Last Name" name="lastname" class="form-control" required>
        <input type="email" placeholder="Enter Email" name="email" class="form-control" required>
        <input type="password" placeholder="Enter Password" name="psw" class="form-control" required>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" class="form-control" required>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
          <button type="button" class="cancelbtn">Cancel</button>
          <button type="submit" class="signupbtn" name="login" >Sign Up</button>
        </div>
    </div>
  </div>
</form>

</body>
</html>
