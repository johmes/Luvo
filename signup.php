<?php
// configuration
session_start();
include 'userconfig.php';
if (isset($_SESSION['loggedin'])) {
  header('location: ../home.php');
  exit();
}
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Luvo - Log In or Sign Up</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="icon" href="img/Luvo_logo.png">
    <style media="screen">
      body {
        background: rgb(245, 248, 250);
        margin: 0;
        padding: 0;
        font-family: "SkattaSans", "Segoe UI", "Arial", "Helvetica Neue", sans-serif;
        min-width: 1150px;
      }

      * {
        box-sizing: border-box;
      }

      /* Change styles for cancel button and signup button on extra small screens */
      @media screen and (max-width: 1015px) {
        .header{
          width: 70%;
          font-size: 0.7em;
        }
      }
      table input {
        border-radius: 9px;
        margin: 5px;
        border: solid 1px black;
        padding: 6px 15px;
      }
      input{
        outline: none;
      }
      .header {
        width: 28%;
        height: 420px;
        border-radius: 9px;
        border: solid 1.5px #5CD9FF;
        margin: 50px auto 45px auto;
        background: white;
        padding: 20px 15px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1);
      }
      .btn {
        float: left;
        box-sizing: border-box;
        background: #66B8FF;
        border: none;
        width: 100%;
        color: #fff;
        text-decoration: inherit;
        outline: none;
      }
      .btn:hover {
        background-color: #8AC9FF;
      }
      .menu {
        width: 100%;
        height: 3.5em;
        border-bottom: solid #000 1px;
        padding-left: 31px;
      }
      .form-group-box{
        outline: none;
        float: left;
        font-size: .9em;
      }
      .form-group{
        margin: 5px auto;
      }
      .form-control{
        margin-bottom: 15px;
      }
      .alert {
        font-family: "Helvetica", sans-serif;
        font-size: 1.2em;
        float: right;
        width: 18%;
        margin-right: 240px;
        margin-top: -235px;
        margin-left: 20px;
        padding: 10px;
        border-radius: 2px;
        background-color: #be4b49;
        color: white;
        text-align: center;
      }
      div.hr {
        width: 100%;
        height: 1px;
        float: left;
        border-radius: 5px;
        align-items: center;
        border-bottom: 1px solid #dadde1;
        display: flex;
        margin: 25px 0px;
        text-align: center;
        }
        .forgot_account_link {
          text-align: center;
          float: left;
          margin-top: 15px;
          width: 100%;
        }
        .new_account {
          float: left;
          margin: auto;
          text-align: center;
          width: 100%;
        }
        .new_account input {
          //padding: 10px 8px;
          border-radius: 5px;
          border: none;
          background-color: #42b72a;
          color: #FFF;
          text-decoration: none;
        }
        .new_account input:hover {
          background-color: #3FAB29;
        }
        .cone-up {
          position: relative;
          top: -120px;
          left: 110px;
          margin: auto 0;
          width: 0;
          height: 0;
          border-left: 1em solid transparent;
          border-right: 1em solid transparent;
          border-bottom: 1em solid #be4b49;
        }
        .main_logo {
          width: 100%;
          text-align: center;
          color: #4f6ff7;
          margin-top: 65px;
        }
        .main_logo h1 {
          font-size: 4em;
          font-family: "SkattaSans", "Segoe UI", "Arial", "Helvetica Neue", sans-serif;
        }
        .main {
        max-width: 1500px;
        margin: auto;
        padding: 10px;
      }
      #fname {
        float: left;
        width: 48%;
        margin-right: 4%;
      }
      #lname {
        width: 48%;
      }
      input[type="date"].form-control {
        line-height: 20px;
      }

      /*LOGIN ERRORS*/



      /*LOGIN ERRORS END*/
    </style>
  </head>
  <body>
    <div class="main">
      <div class="main_logo">
        <h1>Luvo</h1>
      </div>
      <div class="header">
        <form class="" action="signup.dbh.php" method="post">
          <?php include 'errors.php'; ?>

          <div class="form-group">
            <input id="fname" class="form-control" type="text" placeholder="First name"
            name="firstname" aria-label="First name" maxlength="256" autofocus />
            <input id="lname" class="form-control" type="text" placeholder="Last name"
            name="lastname" aria-label="Last name" maxlength="256"/> <!--required-->
          </div>

          <div class="form-group">
            <label for="gender">Gender</label>
            <div class="gender">
              <label for="male" class="radio-inline"><input type="radio" name="gender" value="m" id="male">Male</label>
              <label for="female" class="radio-inline"><input type="radio" name="gender" value="f" id="female">Female</label>
              <label for="other" class="radio-inline"><input type="radio" name="gender" value="o" id="other">Other</label>
            </div>
          </div>

          <div class="form-group">
            <label for="dob">Date of birth</label>
            <input class="form-control" type="date" name="dob" aria-label="Date of birth" />
          </div>

          <div class="form-group">
            <input class="form-control" type="text" placeholder="Phone Number or Email"
            name="phone_or_email" aria-label="Phone Number or Email" maxlength="256" />  <!--required-->
          </div>

          <div class="form-group">
            <input class="form-control" type="password" placeholder="New Password" name="pwd" minlength="8" maxlength="256"/> <!--required-->
          </div>
          <div class="form-group">
            <p style="font-size: 12px;">By creating an account you agree to our <a href="#terms">Terms & conditions.</a></p>
          </div>
          <div class="form-group">
          <div class="new_account"><input class="form-control" type="submit" name="submit" value="Sign Up"/></div>
        </div>
      </form>
      <!--<div class="hr"></div>-->
        <p style="font-size: 14px; float: right; margin-right: 5px;">Already an user? <a href="login.php">Log In</a></p>
      </div>
    </div>

    <?php
      $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

      if (strpos($fullUrl, "signup=empty") == true) {
        echo '<div role="alert" class="alert"><p class="error">Fill in all fields.</p><div class="cone-up" /></div>';
        exit();
      } elseif (strpos($fullUrl, "signup=phone_or_email") == true) {
          echo '<div role="alert" class="alert"><p class="error">The E-mail address or mobile number is taken.</p><div class="cone-up" /></div>';
          exit();
        } elseif (strpos($fullUrl, "signup=wrongpwd") == true) {
            echo '<div role="alert" class="alert"><p class="error">The password that you&#39;ve entered is incorrect.</p><div class="cone-up" /></div>';
            exit();
          } elseif (strpos($fullUrl, "signup=notvalid") == true) {
              echo '<div role="alert" class="alert"><p class="error">The username and password that you entered did not match our records. Please double-check and try again.</p><div class="cone-up" /></div>';
              //exit();
            }
     ?>
  </body>
</html>
