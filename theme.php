<?php
$mainpage = 'settings';
$subpage = 'theme';
$title = 'Luvo - Display Preferences';
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

      // if ($('#theme_switch').is(':checked') == true) {
      //   localStorage.setItem("theme_switch", "false");
      //   localStorage.getItem("theme_switch");
      // } else{
      //   localStorage.setItem("theme_switch", "true");
      //   localStorage.getItem("theme_switch");
      // }

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

    //TOGGLE CHECK COOKIE BASED
    /*toggleTheme.addEventListener('click', function() {
      function setCookie(theme,themeValue) {
        var toggleTheme = document.getElementsByClassName('theme');
        var bodyEl = document.querySelector('body');
        var slider = document.querySelector('input');

        var darkMode = () => {
          bodyEl.classList.toggle('dark');
          slider.classList.toggle('checked');
        }
        var d = new Date();
        theme = "notificationEnabled";
         d.setTime(d.getTime() + (365*24*60*60*1000));
         var expires = "expires="+ d.toUTCString();
         if (toggleTheme.checked) {
           //notificationEnabled = true;
           themeValue = "true";
           document.cookie = theme + "=" + themeValue + ";" + expires + ";path=/";
           darkMode();
           //document.getElementById('checkbox').classList.toggle("checked");
         } else {
           themeValue= "false";
           document.cookie = theme + "=" + themeValue + ";" + expires + ";path=/";
           darkMode();
         }
       }
     });

   function getCookie(theme) {
     var name = theme + "=";
     var ca = document.cookie.split(';');
     for(var i = 0; i < ca.length; i++) {
       var c = ca[i];
       while (c.charAt(0) == ' ') {
         c = c.substring(1);
       }
       if (c.indexOf(name) == 0) {
         return c.substring(name.length, c.length);
       }
     }
     return "";
   }*/
    </script>
   </body>
 </html>
