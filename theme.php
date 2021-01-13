<?php
require "includes/page-init.inc.php";
$user_id = $_SESSION["user_id"];
$mainpage = 'settings';
$subpage = 'theme';
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
     <div>
       <?php include "mainmenubar.php"; ?>
     </div>
     <div>
       <?php include "settings_menu.php" ?>
     </div>
     <div class="main">
       <h3>Display Preferences</h3>
       <ul>
         <label for="notifications_check">Dark Mode</label>
         <li>
           <label class="switch">
             <input type="checkbox" class="theme" id="theme_switch" name="theme_toggle">
             <span class="slider round"></span>
           </label>
         </li>
       </ul>
       <!--<button class="btn btn-primary" id="theme-toggle" title="Display Preferences">Switch to dark mode</button>
       <ul>
         <li><label for="" style="display: block; float: left;">Dark Mode</label></li>
         <li><label for="theme">On</label><input type="radio" name="theme" value="on" checked="checked"></li>
         <li><label for="theme">Off</label><input type="radio" name="theme" value="off"></li>
       </ul>-->
       <!--<p>Hey! Theme Preferences is work in progress. Coming soon...</p>-->
     </div>
    <script>
      var toggleTheme = document.querySelector('.theme');
      var bodyEl = document.querySelector('body');
      var slider = document.querySelector('input');

      var darkMode = () => {
        bodyEl.classList.toggle('dark');
        slider.classList.toggle('checked');
      }
      toggleTheme.addEventListener('click', () => {
        // Get the value of the "dark" item from the
        // local storage on every click
        setDarkMode = localStorage.getItem('dark');
        if (setDarkMode !== "on") {
          darkMode();
          // Set the value of the item to "on" when dark mode is on
          setDarkMode = localStorage.setItem('dark', 'on');
        } else {
          darkMode();
          // Set the value of the item to "null" when dark mode is off
          setDarkMode = localStorage.setItem('dark', null);
        }
        if ($('body').hasClass('dark')) {
          $( '#theme_switch' ).prop( "checked", true )
        } else {
          $( '#theme_switch' ).prop( "checked", false )
        }
      });

      // Get the value of the "dark" item from the local localStorage
      var setDarkMode = localStorage.getItem('dark');

      // Check dark mode if it is on or off on page reload
      if (setDarkMode === 'on') {
        darkMode();
      }
    </script>
   </body>
 </html>
