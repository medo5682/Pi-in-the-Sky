<?php

session_start();

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "PiInTheSky";
$dbName = "piServer";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
?>
