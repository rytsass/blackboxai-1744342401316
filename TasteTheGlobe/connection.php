<?php
$host = "localhost";
$user = "root"; // Corrected variable name
$email = ""; // Corrected variable name
$db_name = "recommendations";

$con = mysqli_connect($host, $user, $email, $db_name);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>