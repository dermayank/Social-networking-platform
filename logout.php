<?php
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['state'])){
        if(!empty($_SESSION['username']) && !empty($_SESSION['state'])){
            if($_SESSION['state'] == 1){
                unset($_SESSION['username']);
                unset($_SESSION['state']);
                unset($_SESSION['email']);
                unset($_SESSION['fullname']);
                unset($_SESSION['gender']);
                session_destroy();
            }
        }
    }
    header("Location:login.php");
 ?>
