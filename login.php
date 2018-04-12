<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="login.css">
<head>

<?php
    session_start();
    require_once("connect_db.php");

    if(isset($_SESSION['username']) && isset($_SESSION['state'])){
        if(!empty($_SESSION['username']) && !empty($_SESSION['state'])){
            if($_SESSION['state'] == 1){
                $username = $_SESSION['username'];
                header("Location:profile.php?user=$username");
            }
        }
    }

    if(isset($_POST['useremail']) && isset($_POST['password'])){
        if(!empty($_POST['useremail']) && !empty($_POST['password'])){
            $useremail = $_POST['useremail'];
            $password = $_POST['password'];

            if (filter_var($useremail, FILTER_VALIDATE_EMAIL)){
                $sql = "SELECT * FROM userdetails WHERE `email` = '$useremail' AND `password` = '$password'";
            } else {
                $sql = "SELECT * FROM userdetails WHERE `username` = '$useremail' AND `password` = '$password'";
            }


            $result = mysqli_query($conn, $sql);

            if( mysqli_num_rows($result) >0){
                $row = mysqli_fetch_array($result);
                if((($useremail == $row['email']) || $useremail == $row['username']) && ($password = $row['password'])){
                    $username = $row['username'];
                    $_SESSION['username'] = $username;
                    $_SESSION['state'] = 1;
                    header("Location:profile.php?user=$username");
                }
            }
            else{
                ?>
                <div class="container">
                  <div class="alert alert-danger">
                    <strong >Error!</strong> Incorrect email or password.
                  </div>
                </div>
                <?php
            }
        }
    }
?>

<div class="container">
    <div class="omb_login">
    	<h3 class="omb_authTitle">Login or <a href="register.php">Sign up</a></h3>

		<div class="row omb_row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">
			    <form action="" method="POST">

                    <div class="form-group">
                        <input type="text" class="form-control" name="useremail" placeholder="Username or Email" >
                     </div>
					<span class="help-block"></span>

					<div class="form-group">
						<input  type="password" class="form-control" name="password" placeholder="Password">
					</div>
                    <span class="help-block"></span>

					<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
				</form>
			</div>
    	</div>
		<div class="row omb_row-sm-offset-3">

			<div class="col-xs-12 col-sm-3">
				<p class="omb_forgotPwd">
					<a href="#">Forgot password?</a>
				</p>
			</div>
		</div>
	</div>
</div>
