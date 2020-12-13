<?php
// configuration
session_start();
include_once '../config.php';
if (isset($_SESSION['loggedin'])) {
  header('location: ../home.php');
  exit();
}
 ?>
<!DOCTYPE html>
<html>
<title>Luvo- Log In or Sign Up</title>
  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="icon" href="img/Luvo_logo.png">
  <style>
    body {
      background: rgb(245, 248, 250);
      margin: 0;
      padding: 0;
      font-family: "SkattaSans", "Segoe UI", "Arial", "Helvetica Neue", sans-serif; /*Arial, Helvetica, sans-serif;*/
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
    input{
      outline: none;
    }
    .header {
      width: 28%;
      height: 300px;
      border-radius: 9px;
      border: solid 1.5px #5CD9FF;
      margin: 80px auto 45px auto;
      background: white;
      padding: 20px 15px;
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
      .new_account a {
        padding: 10px 8px;
        border-radius: 5px;
        border: none;
        background-color: #42b72a;
        color: #FFF;
        text-decoration: none;
      }
      .new_account a:hover {
        background-color: #3FAB29;
      }
  /*  .cone-up {
      position: relative;
      top: -120px;
      left: 110px;
      margin: auto 0;
	     width: 0;
	     height: 0;
	     border-left: 1em solid transparent;
	     border-right: 1em solid transparent;
	     border-bottom: 1em solid #be4b49;
}*/
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
  </style>
<body>
<div class="main">
  <div class="main_logo">
    <h1>Luvo</h1>
  </div>
  <div class="header">

    <form class="login" action="authenticate.php" method="post">
        <input class="form-control" type="text" placeholder="Phone Number or Email"
        name="phone_or_email" aria-label="Phone Number or Email" autofocus />  <!--required-->
        <div class="form-group">
          <input class="form-control" type="password" placeholder="Password" name="pwd" /> <!--required-->
        </div>
        <div class="form-group">
          <div><input type="submit" class="btn" name="login" value="Log In"></input></div>
        </div>
      </form>
      <div class="forgot_account_link">
        <a href="#">Forgot passoword?</a>
      </div>
      <div class="hr"></div>
      <div class="new_account">
        <a href="signup.php" name="new_account">Create New Account</a>
      </div>
    </div>
  </div>
</div>
  <?php
    $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (strpos($fullUrl, "login=empty") == true) {
      echo '<div role="alert" class="alert"><p class="error">Fill in all fields.</p><div class="cone-up" /></div>';
      exit();
    } elseif (strpos($fullUrl, "login=email") == true) {
        echo '<div role="alert" class="alert"><p class="error">The email that you&#39;ve entered is incorrect.</p><div class="cone-up" /></div>';
        exit();
      } elseif (strpos($fullUrl, "login=wrongpwd") == true) {
          echo '<div role="alert" class="alert"><p class="error">The password that you&#39;ve entered is incorrect.</p><div class="cone-up" /></div>';
          exit();
        } elseif (strpos($fullUrl, "login=notvalid") == true) {
            echo '<div role="alert" class="alert"><p class="error">The username and password that you entered did not match our records. Please double-check and try again.</p><div class="cone-up" /></div>';
            //exit();
          }
   ?>
</body>
</html>
