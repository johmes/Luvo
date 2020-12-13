<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "budgetsection";

$conn = mysqli_connect($host, $user, $password, $dbname);
// Check connection
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
