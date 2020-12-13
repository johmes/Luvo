<?php
//include_once 'functions.php';
session_start();
// Unset all session variables
$_SESSION = array();

// Get session parameters
$param = session_get_cookie_params();

// Delete cookie
setcookie(session_name(),
  '', time() - 42000,
  $params["path"],
  $params["domain"],
  $params["secure"],
  $params["httponly"]);

// Destroy session
session_destroy();

// Redirect to login page
header("Location: login.php");
exit();
?>
