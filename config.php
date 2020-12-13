<?php
$host = "127.0.0.1"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "budgetsection"; /* Database name */

$conn = mysqli_connect($host, $user, $password, $dbname);
// Check connection
//mysqli_set_charset($conn,'utf8');
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//printf("Initial character set: %s\n", $conn->character_set_name());

/* change character set to utf8 */
/*if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
} else {
    printf("Current character set: %s\n", $conn->character_set_name());
}*/
