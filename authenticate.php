<?php
session_start();
include "userconfig.php";
if(isset($_POST['login'])){
  //check if inputs are empty
  if (empty($_POST['phone_or_email'])) {
    header("Location: ../profile_management/login.php?login=empty");
    exit();
  } elseif (empty($_POST['pwd'])) {
    header("Location: ../profile_management/login.php?login=empty");
    exit();
  }
  if ($stmt = $db->prepare('SELECT user_id, firstname, lastname, dob, password FROM users WHERE phone_or_email = ?')) {
  	$stmt->bind_param('s', $_POST['phone_or_email']);
  	$stmt->execute();
  	$stmt->store_result();

    if ($stmt->num_rows > 0) {
	     $stmt->bind_result($user_id, $firstname, $lastname, $dob, $pwd);
	     $stmt->fetch();
	     if (password_verify($_POST['pwd'], $pwd)) {
		     // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
         session_regenerate_id();
         $_SESSION['loggedin'] = TRUE;
         $_SESSION['user_id'] = $user_id;
         $_SESSION['firstname'] = $firstname;
         $_SESSION['lastname'] = $lastname;
         $_SESSION['dob'] = date('Y-m-d', strtotime($dob));
         $_SESSION['contact'] = $_POST['phone_or_email'];
         // redirects to home page
         header('location: ../home.php');
         exit();
       } else {
           // Incorrect password
           header("Location: ../profile_management/login.php?login=notvalid");
           exit();
         }
     } else {
         // Incorrect username
         header("Location: ../profile_management/login.php?login=notvalid");
         exit();
       }
     $stmt->close();
   } else {
      mysqli_error($db);
    }
 }

if (isset($_POST['edit_form_btn'])) {
  $user_id = $_SESSION['user_id'];
  $firstname = mysqli_real_escape_string($db, $_POST['settings_firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['settings_lastname']);
  $phone_or_email = mysqli_real_escape_string($db, $_POST['settings_phone_or_email']);
  $sql = "UPDATE users SET firstname='$firstname', lastname='$lastname', phone_or_email='$phone_or_email' WHERE user_id = '$user_id'";

  if ($db->query($sql) === TRUE) {
    header('location: settings.php');
    exit();
  } else {
      echo "Error updating record: " . $db->error;
    }
}
if (isset($_POST['change_pwd_button'])) {
  $user_id = $_SESSION['user_id'];
  $current_password = mysqli_real_escape_string($db, $_POST['pwd']);
  $pwd_1 = mysqli_real_escape_string($db, $_POST['pwd_new1']);
  $pwd_2 = mysqli_real_escape_string($db, $_POST['pwd_new2']);
  //Encrypting passwords.
  $salt = 'st';
  $current_password = crypt($current_password, $salt);
  $pwd_1 = crypt($pwd_1, $salt);
  $pwd_2 = crypt($pwd_2, $salt);
  if(trim($current_password) == '' || trim($pwd_1) == '' || trim($pwd_2) == ''){
    echo "Fill in all forms";
  } else {
      $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
      $result = mysqli_query($db, $sql);
      $row = mysqli_fetch_assoc($result);
      $pwd = $row['password'];
      if (mysqli_num_rows($result) == 1) {
        if ($pwd = $current_password) {
          if ($pwd != $pwd_1) {
            if (isset($pwd_1) == isset($pwd_2)) {
              $sql = "UPDATE users SET password='$pwd_1' WHERE user_id = '$user_id'";
              if ($db->query($sql) === TRUE) {
                header('location: settings.php');
                exit();
              } else {
                  echo "Error changing password: " . $db->error;
                }
            } else {
                echo "Password's do not match";
              }
          } else {
              echo "New password can not be same as the old one";
            }
        } else {
            echo "Something has gone oopsie dasy...";
          }
      } else {
          echo "Check current password";
        }
    }
}
$db->close();
?>
