<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title></title>
  </head>
  <body>
    <div class="left_settings_menu">
      <ul>
        <h3>Settings</h3>
        <li><a class="<?php if($subpage=='settings'){ echo 'active';} ?>" href="https://luvo.dev/settings.php" title="General Account Settings"><span class="glyphicon glyphicon-cog"></span> General</a></li>
        <li><a class="<?php if($subpage=='security'){ echo 'active';} ?>" href="https://luvo.dev/security" title="Security and Login"><span class="fa fa-shield"></span> Security and Login</a></li>
        <li><a class="<?php if($subpage=='privacy'){ echo 'active';} ?>" href="https://luvo.dev/privacy" title="Privacy"><span class="glyphicon glyphicon-lock"></span> Privacy</a></li>
        <hr style="width: 192.4px; border-radius: 9px;">
        <li><a class="<?php if($subpage=='theme'){ echo 'active';} ?>" href="https://luvo.dev/theme" title="Display Preferences"><span class="glyphicon glyphicon-adjust"></span> Dispaly Preferences</a></li>
        <li><a class="<?php if($subpage=='notifications'){ echo 'active';} ?>" href="https://luvo.dev/notification" title="Notifications"><span class="glyphicon glyphicon-bell"></span> Notifications</a></li>
      </ul>
    </div>
  </body>
</html>
