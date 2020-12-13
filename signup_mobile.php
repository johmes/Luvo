<?php
require "config.php";

/*$firstname = htmlentities(mysqli_real_escape_string($conn,isset($_POST['firstname'])));
$lastname = htmlentities(mysqli_real_escape_string($conn,isset($_POST['lastname'])));
$email = htmlentities(mysqli_real_escape_string($conn,isset($_POST['email'])));
$gender = htmlentities(mysqli_real_escape_string($conn,isset($_POST['gender'])));
$dob = isset($_POST['dob']);
$password = htmlentities(mysqli_real_escape_string($conn,isset($_POST['password'])));*/

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$dob = date('Y-m-d', strtotime($_POST['dob']));
$password = $_POST['password'];
$salt = "st";

$isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
if($conn) {
  if(strlen($password) > 40 or strlen($password) < 6) {
    echo "Password lenght must be between 6-40 characters";
  } else if($isValidEmail != true){
    echo "This email is not valid";
  }
  else {
    $sqlCheckEmail = "SELECT * FROM users WHERE phone_or_email = '$email'";
    $emailQuery = mysqli_query($conn, $sqlCheckEmail);

    if(mysqli_num_rows($emailQuery) > 0) {
      echo "This email address is taken";
    } else{
      $password = crypt($password, $salt);//encrypt the password before saving in the database
      $sql_register = "INSERT INTO users (firstname, lastname, gender, phone_or_email, dob, password)
      VALUES('$firstname','$lastname', '$gender', '$email','$dob', '$password')";

      if(mysqli_query($conn,$sql_register)) {
        echo "Successfully Registered";
      } else {
        echo "Failed to register";
      }
    }
  }
} else {
  echo "Couldn't connect to server" . $conn->mysqli_error();
}

 ?>
