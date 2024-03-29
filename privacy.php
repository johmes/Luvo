<?php
$mainpage = 'settings';
$subpage = 'privacy';
$title= 'Luvo - Privacy settings';
// configuration
include 'config.php';
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('location: profile_management/login.php');
  exit();
}
$user_id = $_SESSION["user_id"];
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
     <title><?php echo $title; ?></title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="script.js"></script>
     <link rel="stylesheet" type="text/css" href="bootstrap.css" />
     <link rel="stylesheet" type="text/css" href="style.css" />
     <link rel="icon" href="img/Luvo_logo.png">
   </head>
   <body>
     <div>
       <?php include "sort_list.php"; ?>
     </div>
     <div>
       <?php include "settings_menu.php" ?>
     </div>
     <div class="main">
       <h3>Privacy Settings</h3>
     </div>
     <script type="text/javascript">

     </script>
   </body>
 </html>
