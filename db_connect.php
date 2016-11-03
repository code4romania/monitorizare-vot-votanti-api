<?php
$dbusername="root";
$dbname="monitorizare";
$dbserver="localhost";
$dbpassword="";
    $conn = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
    mysqli_set_charset($conn, "utf8");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
