<?php
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "localhost";

    //global $conn;
    $conn = mysqli_connect($db_servername, $db_username, $db_password);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "CREATE DATABASE IF NOT EXISTS testdb";
    if (mysqli_query($conn, $sql)) {
        mysqli_select_db($conn,"testdb");
        $sql = "CREATE TABLE IF NOT EXISTS userdetails(
            id INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(40) NOT NULL ,
            email VARCHAR(40) NOT NULL,
            password VARCHAR(70) NOT NULL,
            firstname VARCHAR(40) NOT NULL,
            lastname VARCHAR(40) NOT NULL
        )";
        if(!mysqli_query($conn, $sql)){
            die("error connecting to database");
        }
    }
?>
