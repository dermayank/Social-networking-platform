<?php
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "localhost";
    //global $conn;
    $user_table = "userdetails";
    $user_posts = "user_posts";
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
            fullname VARCHAR(40) NOT NULL,
            gender VARCHAR(40) NOT NULL,
            profession VARCHAR(14) ,
            about VARCHAR(100) NULL DEFAULT 'No About',
            profilepic VARCHAR(100) NULL DEFAULT 'images/avatar3.png'
        )";
        if(!mysqli_query($conn, $sql)){
            die("error connecting to database");
        }

        $sql = "CREATE TABLE IF NOT EXISTS user_posts(
            id INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(40) NOT NULL,
            title VARCHAR(100) NOT NULL,
            body TEXT NOT NULL,
            post_date DATE NOT NULL
        )";
        if(!mysqli_query($conn, $sql)){
            die("error connecting to database");
        }

        $sql = "CREATE TABLE IF NOT EXISTS online_status(
            id INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(40) NOT NULL,
            last_activity_timestamp DATE NOT NULL
        )";
    }
?>
