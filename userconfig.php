<?php
// Change this to your connection info.
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "budgetsection"; /* Database name */
$errors = array();

// Try and connect using the info above.
$db = mysqli_connect($host, $user, $password, $dbname);
//mysqli_set_charset($db,'utf8');
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

printf("Initial character set: %s\n", $db->character_set_name());

/* change character set to utf8 */
if (!$db->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $db->error);
    exit();
} else {
    printf("Current character set: %s\n", $db->character_set_name());
}

 ?>
