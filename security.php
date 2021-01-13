<?php
require "includes/page-init.inc.php";
$user_id = $_SESSION["user_id"];
$mainpage = 'settings';
$subpage = 'security';
$title= 'Settings | Luvo';
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8" />
     <link rel="icon" type="image/png" href="img/Luvo_logo.png">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="Budget App For Keeping Your Financial Life Easy.">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script type="text/javascript" src="script.js"></script>
     <link rel="stylesheet" type="text/css" href="bootstrap.css" />
     <link rel="stylesheet" type="text/css" href="style.css" />
     <link rel="apple-touch-icon" href="img/Luvo_logo.png">
     <link rel="manifest" href="manifest.webmanifest">
     <title><?php echo $title; ?></title>
   </head>
   <body>
     <?php include "noscript.php"; ?>
     <div>
       <?php include "mainmenubar.php"; ?>
     </div>
     <div>
       <?php include "settings_menu.php" ?>
     </div>
     <div class="main">
       <h3>Security Settings</h3>
       <!--PASSWORD-->
       <form rel='async' action="authenticate.php" method="post">
         <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
         <!--EDIT BUTTON FOR PASSWORD-->
         <div class="form-group">
           <label for="change_password">Password</label>
           <input class="edit_btn" id="edit_btn" type="button" name="edit_password" value="Edit" onclick="pwdFunction()" />
         </div>
         <div id="password_form">
           <div class="form-group">
               <input class="form-control" type="password" name="pwd" placeholder="Current Password">
           </div>

           <div class="form-group">
             <input class="form-control" id="pwd_new1" type="password" name="pwd_new1" placeholder="New Password">
           </div>

           <div class="form-group">
             <input class="form-control" id="pwd_new2" type="password" name="pwd_new2" placeholder="Confirm Password">
           </div>

           <div class="form-group">
             <div id="show_settings">
               <input class="form-control-button" type="submit" name="change_pwd_button" value="Save Changes" />
               <input class="form-control-button" type="reset" name="cancel_pwd_button" value="Cancel" onclick="pwdCancelFunction()"/>
             </div>
           </div>
         </div>
       </form>
     </div>
     <script type="text/javascript">
       var pwd_form = document.getElementById("password_form");
       var settings = document.getElementsByClassName("show_settings");
       var edit = document.getElementById("edit_btn");
       function pwdFunction() {
         pwd_form.style.display = 'block';
       }
       function pwdCancelFunction() {
         pwd_form.style.display = 'none';
       }
    </script>
   </body>
 </html>
