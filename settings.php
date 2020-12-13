<?php
$mainpage = 'settings';
$subpage = 'settings';
$title= 'Luvo - Settings';
// configuration
session_start();
include_once 'config.php';
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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <link rel="stylesheet" type="text/css" href="bootstrap.css" />
     <link rel="stylesheet" type="text/css" href="style.css" />
     <link rel="icon" href="img/Luvo_logo.png">
     <title><?php echo $title; ?></title>
     <style media="screen">
       /* * {
         box-sizing: border-box;
        }
         body {
           margin: 0;
           padding: 0;
         }

         .left_settings_menu {
           margin: 55px 15px;
           display: block;
           position: absolute;
           float: left;
         }
         .left_settings_menu ul li {
           list-style: none;
         }
         .main {
           float: left;
           width: 500px;
           margin: 55px 15px;
           display: inline-block;
           position: relative;
           text-align: center;
         }
         .form-group {
           display: block;
           width: 50%;
           padding: 15px 10px;
           text-align: left;
           margin: auto 16px;
         }
         .form-group #show_settings {
           margin-bottom: 35px;
         }
         .form-control {
           display: inline-block;
         }
         .form-control #show_settings {
           margin: 15px 0px;
         }
         .form-group[type=label] {
           text-align: left;

         }
         .form-control-button {
           position: relative;
           width: 100px;
           font-size: 12px;
           padding: 6px 8px;
           text-align: center;
           border-radius: 4px;
           transition: .1s;
         }
         .form-control-button[type=submit] {
           background-color: #4FC3F7;
           border: solid 2px #4FC3F7;
           font-weight: 700;
           color: white;
         }
         .form-control-button[type=reset] {
           background-color: white;
           margin-left: 15px;
           border: solid 2px grey;
           color: grey;
           font-weight: 700;
           letter-spacing: 0.5px;
         }
         .edit_btn {
           padding: 0 9px;
           border: solid 1px grey;
           color: grey;
           background-color: transparent;
           border-radius: 4px;
         }
         .form-control-button:hover {
           //box-shadow: 0 1px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1);
           opacity: .9;
         }
         .hr {
           background-color: #D2D2D2;
           border: solid .5px #D2D2D2;
           width: 340px;
           margin: 0px 10px 5px 10px;
           border-radius: 5px;
         }
         .show_settings {
           visibility: hidden;
         }
         .change_password {
           display: none;
         }
         .main h2  {
           margin: 25px 5px 15px 5px;
         }
         label {
           width: 70px;
         }
         #password_form {
           display: none;
         }
         .left_settings_menu {
           position: relative;
           display: block;
           float: left;
           width: 250px;
           height: 80vh;
         }
         .left_settings_menu ul {
           position: fixed;
           width: 250px;
           height: 100%;
           padding: 25px 16px;
           text-align: center;
           border-right: 1px solid black;
         }
         .left_settings_menu ul li {
           margin: 3.8px;
           padding: 2px 5px;
           width: 192.4px;
           font-size: 18px;
           border-radius: 11px;
           text-align: left;
           text-decoration: none;
           transition: .2;
           transition-timing-function: ease-out;
         }
         .left_settings_menu ul li:hover {
           background-color: #eee;
           color: #fff;
         }
         .left_settings_menu ul li a {
           text-align: left;
           color: #333333;
           font-size: 14px;
           overflow-y: hidden;
           padding: 8px auto 8px 5px;
         }
          .left_settings_menu ul li a i::before {
           padding-right: 5px;
           padding-left: 19px;
         }
         .left_settings_menu ul li a p {
           position: absolute;
           right: 0;
         }
         .left_settings_menu ul.active {
           display: block;
           transition: .4s;
         }
         .left_settings_menu ul li a.active {
           color: #abaaac;
         }
         @media screen and (max-width: 870px) {
           .main {
             display: block;
             width: auto;
             padding: 15px 35px;
           }
           .main h3 {
             padding-left: 15px;
           }
           .form-group {
             width: auto;
             display: block;
             margin: 15px;
           }
         } */
     </style>
   </head>
   <body>
     <div>
       <?php include "sort_list.php"; ?>
     </div>
     <div>
       <?php include "settings_menu.php" ?>
     </div>
     <div class="main">
       <h3>General Account Settings</h3>
       <!--USER SETTINGS-->
      <form rel='async' action="settings.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
        <div class="form-group">
          <h4>Name</h4>
            <label for="firstname">Firstname</label>
            <input class="form-control" type="text" name="settings_firstname" value="<?php echo htmlspecialchars($_SESSION['firstname']); ?>">
        </div>

        <div class="form-group">
          <label for="lastname">Lastname</label>
          <input class="form-control" type="text" name="settings_lastname" value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>">
        </div>

        <div class="form-group">
          <label for="phone_or_email">Contact</label>
          <input class="form-control" type="text" name="settings_phone_or_email" value="<?php echo htmlspecialchars($_SESSION['contact']); ?>" placeholder="E-mail or mobile number">
        </div>
        <div class="form-group">
          <label for="phone_or_email">Birthday</label>
          <input class="form-control" type="date" name="settings_phone_or_email" value="<?php echo htmlspecialchars($_SESSION['dob']); ?>" readonly>
        </div>
        <div class="form-group">
          <div id="show_settings">
            <input class="form-control-button" type="submit" name="edit_form_btn" value="Save Changes" />
            <input class="form-control-button" type="reset" name="cncl_edit_btn" value="Cancel" />
          </div>
        </div>
        <div class="hr"></div>
      </form>
     </div>
   </body>
 </html>
