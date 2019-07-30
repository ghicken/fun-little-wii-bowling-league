<?php
function login()
{
    $servername = "servername";
    $database = "database";
    $username = "username";
    $password = "password";
    
    // Create connection

    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection

    if (!$conn) {

        die("Connection failed: " . mysqli_connect_error());

    }
}
?>