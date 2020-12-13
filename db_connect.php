<?php
  $db_name = "usersection";
  $mysql_username = "root";
  $mysql_password = "";
  $server_name = "localhost";
  $conn = mysqli_connect($server_name, $mysql_username, $mysql_password,$db_name);
  $conn = mysqli_set_charset($conn,'utf8');

 ?>
