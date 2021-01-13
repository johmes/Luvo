<?php
include "includes/page-init.inc.php";
$user_id = $_SESSION["user_id"];
$mainpage = 'settings';
$subpage = 'settings';
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
     <script src="script.js"></script>
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
       <h3>General Account Settings</h3>
       <!--USER SETTINGS-->
      <form rel='async' action="settings.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
        <div class="form-group">
          <h4>Name</h4>
            <label for="settings_firstname">Firstname</label>
            <input class="form-control" type="text" name="settings_firstname" value="<?php echo htmlspecialchars($_SESSION['firstname']); ?>">
        </div>

        <div class="form-group">
          <label for="settings_lastname">Lastname</label>
          <input class="form-control" type="text" name="settings_lastname" value="<?php echo htmlspecialchars($_SESSION['lastname']); ?>">
        </div>

        <div class="form-group">
          <label for="settings_phone_or_email">Contact</label>
          <input class="form-control" type="text" name="settings_phone_or_email" value="<?php echo htmlspecialchars($_SESSION['contact']); ?>" placeholder="E-mail or mobile number">
        </div>
        <div class="form-group">
          <label for="phone_or_email">Birthday</label>
          <input class="form-control" type="date" name="settings_phone_or_email" value="<?php echo htmlspecialchars($_SESSION['dob']); ?>" readonly>
        </div>
        <div class="form-group">
          <div id="show_settings">
            <input class="form-control-button edit_form_btn" type="submit" name="edit_form_btn" value="Save Changes" />
            <input class="form-control-button" type="reset" name="cncl_edit_btn" value="Cancel" />
          </div>
        </div>
        <div class="hr"></div>
      </form>
      <div class="delete_account">
        <h4>Careful now! After deleting you can not get your account and data back.</h4>
        <form rel='async' action="#" method="post">
          <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
          <div class="form-group">
            <div id="show_settings">
              <input class="form-control-button delete_btn" type="submit" name="delete_account_btn" value="Delete" />
            </div>
          </div>
        </form>
      </div>
     </div>
   </body>
 </html>
