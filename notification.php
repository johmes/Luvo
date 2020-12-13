<?php
$mainpage = 'settings';
$subpage = 'notification';
$title= 'Luvo - Notification settings';
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
     <style media="screen">
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
       <h3>Notifications Settings</h3>
       <!-- NOTIFICATION SETTINGS -->
       <button class="btn btn-primary" onclick="notifyMe()">Notify me!</button>
       <ul>
         <label for="notifications_check">Recieve notifications</label>
         <li>
           <label class="switch">
             <input type="checkbox" class="checked" id="checkbox" name="notifications_check" onclick="setCookie()">
             <span class="slider round"></span>
           </label>
         </li>
       </ul>
     </div>
     <script type="text/javascript">
     //TOGGLE CHECK
     function setCookie(cname,cvalue) {
       var d = new Date();
       cname = "notificationEnabled";
        d.setTime(d.getTime() + (365*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        if (document.getElementById('checkbox').checked) {
          //notificationEnabled = true;
          cvalue = "true";
          document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
          //document.getElementById('checkbox').classList.toggle("checked");
        } else {
          cvalue = "false";
          document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
      }

    function getCookie(cname) {
      var name = cname + "=";
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
    }

/*function checkCookie() {
  var user = getCookie("notificationEnabled");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
    user = prompt("Please enter your name:", "");
    if (user != "" && user != null) {
      setCookie("username", user, 365);
    }
  }
}*/


     function notifyMe(theBody, theTitle, theIcon) {
        var options = {
            body: "Öri öri öri örrrrr",
            title: "Moro <?php echo $_SESSION['firstname']; ?>!",
            icon: "https://www.iconfinder.com/data/icons/essentials-solid/100/Notification-512.png"
        }
       // Let's check if the browser supports notifications
       if (!("Notification" in window)) {
         alert("This browser does not support desktop notification");
       }

       // Let's check whether notification permissions have already been granted
       else if (Notification.permission === "granted") {
         // If it's okay let's create a notification
         if (getCookie("notificationEnabled") === "true") {
           document.getElementById('checkbox').classList.toggle("checked");
           var notification = new Notification("Moro <?php echo $_SESSION['firstname']; ?>", options);
           console.log(notification.body);
       } else {
         document.getElementById('checkbox').classList.toggle("unchecked");
         console.log(getCookie("notificationEnabled"));
         console.log("Notifications are off.");
        }
       }

       // Otherwise, we need to ask the user for permission
       else if (Notification.permission !== "denied") {
         Notification.requestPermission().then(function (permission) {
           // If the user accepts, let's create a notification
           if (permission === "granted") {
             if (getCookie("notificationEnabled") === "true") {
               var notification = new Notification("Moro <?php echo $_SESSION['firstname']; ?>", options);
               console(getCookie("notificationEnabled"));
               console.log(notification.body);
           } else {
             console.log(getCookie("notificationEnabled"));
             console.log("Notifications are off.");
            }
          }
         });
       }

       // At last, if the user has denied notifications, and you
       // want to be respectful there is no need to bother them any more.
     }
     </script>
   </body>
 </html>
