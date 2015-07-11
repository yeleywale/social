<?php

function dbConnect(){
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "tweb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;
}/*
function dbConnect(){
    $servername = "localhost";
    $username = "felixtalmacel";
    $password = "felixtalmacel";
    $dbname = "dbfelixtalmacel";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    return $conn;
}*/
?>