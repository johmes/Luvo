<?php
//configuration
include "userconfig.php";

  //REGISTER USER
  if(isset($_POST['submit'])) {
    $firstname = htmlentities(mysqli_real_escape_string($db, $_POST['firstname']));
    $lastname = htmlentities(mysqli_real_escape_string($db, $_POST['lastname']));
    $gender = htmlentities(mysqli_real_escape_string($db, $_POST['gender']));
    $dob = htmlentities(mysqli_real_escape_string($db, $_POST['dob']));
    $phone_or_email = htmlentities(mysqli_real_escape_string($db, $_POST['phone_or_email']));
    $pwd = htmlentities(mysqli_real_escape_string($db, $_POST['pwd']));

    $firstname = stripcslashes($firstname);
    $lastname = stripcslashes($lastname);
    $gender = stripcslashes($gender);
    $dob = stripcslashes($dob);
    $phone_or_email = stripcslashes($phone_or_email);
    $pwd = stripcslashes($pwd);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($firstname)) {
      echo "etunimi tyhjä";
      //header("Location: ../profile_management/signup.php?signup=empty");
      //exit();
    } elseif (empty($lastname)) {
      echo "lastname tyhjä";
      // header("Location: ../profile_management/signup.php?signup=empty");
      // exit();
    } elseif (empty($phone_or_email)) {
      echo "email tyhjä";
      // header("Location: ../profile_management/signup.php?signup=empty");
      // exit();
    } elseif (empty($gender)) {
      echo "gender tyhjä";
      // header("Location: ../profile_management/signup.php?signup=empty");
      // exit();
    } elseif (empty($dob)) {
      echo "dob tyhjä";
      // header("Location: ../profile_management/signup.php?signup=empty");
      // exit();
    } elseif (empty($pwd)) {
      echo "salasana tyhjä";
      //header("Location: ../profile_management/signup.php?signup=empty");
      //exit();
    } else {

     // first check the database to make sure
     // a user does not already exist with the same username and/or email
     $user_check_query = "SELECT * FROM users WHERE phone_or_email = '$phone_or_email' LIMIT 1";
     $result = mysqli_query($db, $user_check_query);
     $row = mysqli_fetch_assoc($result);

     if ($row['phone_or_email'] === $phone_or_email) {
       header("Location: ../profile_management/signup.php?signup=phone_or_email");
       exit();
     } else {
         // Finally, register user if there are no errors in the form
         if (count($errors) == 0) {
           //hashes the password before saving in the database
           $options = [
             'cost' => 11
           ];
           $password_hash = password_hash($pwd, PASSWORD_BCRYPT, $options);
           $query = "INSERT INTO users (firstname, lastname, gender, phone_or_email, dob, password)
            VALUES('$firstname', '$lastname', '$gender', '$phone_or_email', '$dob', '$password_hash')";
            mysqli_query($db, $query);

            // GET ALL THE NEEDED DATA FROM DB AND SET THEM AS SESSION DATA
            $query = "SELECT user_id FROM users WHERE phone_or_email = '$phone_or_email'" or die($db->error());
            $result = mysqli_query($db, $query);
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['phone_or_email'] = $phone_or_email;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['dateToPrint'] = $row['dateToPrint'];
            $_SESSION['dob'] = date('Y-m-d', strtotime($dob));
            $_SESSION['password'] = $password_hash;
            $_SESSION['register_date'] = $row['register_date'];
            //redirects to home page
            header('location: ../home.php');
            exit();
          }
        }
      }
    }
    $db->close();
 ?>
