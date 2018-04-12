<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_SESSION['state'])){
    if(empty($_SESSION['username']) || empty($_SESSION['state'])){
            header("Location:login.php");
    }
}
if(isset($_GET['user']) && !empty($_GET['user']))
    echo $_GET['user'];
?>
<a href="logout.php">logout</a>
