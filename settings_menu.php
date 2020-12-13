<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
    <link id="theme" rel="stylesheet" type="text/css" href="style.css" />
    <script src="script.js"></script>
    <title></title>
  </head>
  <body>
    <div class="left_settings_menu">
      <ul>
        <h3>Settings</h3>
        <li><a class="<?php if($subpage=='settings'){ echo 'active';} ?>" href="settings.php" title="General Account Settings"><span class="glyphicon glyphicon-cog"></span> General</a></li>
        <li><a class="<?php if($subpage=='security'){ echo 'active';} ?>" href="security.php" title="Security and Login"><span class="fa fa-shield"></span> Security and Login</a></li>
        <li><a class="<?php if($subpage=='privacy'){ echo 'active';} ?>" href="privacy.php" title="Privacy"><span class="glyphicon glyphicon-lock"></span> Privacy</a></li>
        <hr style="width: 192.4px; border-radius: 9px;">
        <li><a class="<?php if($subpage=='theme'){ echo 'active';} ?>" href="theme.php" title="Display Preferences"><span class="glyphicon glyphicon-adjust"></span> Dispaly Preferences</a></li>
        <li><a class="<?php if($subpage=='notifications'){ echo 'active';} ?>" href="notification.php" title="Notifications"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
      </ul>
    </div>
  </body>
</html>
