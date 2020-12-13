<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'usersection';
// Try and connect using the info above.
$db = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
if (isset($_POST['login'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $email = stripcslashes($email);
  $password = stripcslashes($password);
  //$password = password_hash($password, PASSWORD_ARGON2I);
  $password = md5($password);
  $user_id = 0;

  // Now we check if the data from the login form was submitted, isset() will check if the data exists.
  if (!isset($email, $password)) {
    //!isset($email, $password)
  	// Could not get the data that should have been sent.
    header('Location: ../apps/login.php?login=empty');
    exit();
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !isset($email)) {
    header('Location: ../apps/login.php?login=email');
    exit();
  }

  // Prepare our SQL, preparing the SQL statement will prevent SQL injection.
  $stmt = $db->prepare('SELECT user_id, password FROM users WHERE email = ? AND password = ?');
  // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
  $stmt->bind_param('sss', $user_id, $email, $password);
  $stmt->execute();
  $stmt->bind_result($user_id, $email, $password);
  // Store the result so we can check if the account exists in the database.
  $stmt->store_result();

  if ($stmt->num_rows > 0) { //$stmt->num_rows > 0
    if ($stmt->fetch()) {
      // Account exists, now we verify the password.
    	// Note: remember to use password_hash in your registration file to store the hashed passwords.
    	if (password_verify($_POST['password'], $password)) {
    		// Verification success! User has loggedin!
    		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
    		session_regenerate_id();
    		$_SESSION['loggedin'] = TRUE;
    		$_SESSION['user_id'] = $user_id;
    		$_SESSION['email'] = $email;
    		header('Location:home.php');
        exit();
    	} else {
    		echo 'Incorrect password!';
    	}
    }
  } else {
    header('Location: ../apps/login.php?login=notvalid');
    exit();
  }
  $stmt->close();
} else {

}
$db->close();
  //get user data from frontend
  /*$email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  $email = stripcslashes($email);
  $password = stripcslashes($password);

  $password = md5($password); //hash password

  //check if inputs are empty
  if (empty($email) || empty($password)) {
    header('Location: ../apps/login.php?login=empty');
    exit();
  } else {
      //check if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../sourceCode/login.php?login=email');
        exit();
      }
      if(1==1) {
        $result = mysqli_query($db, "SELECT * FROM users WHERE email = '$email' AND password = '$password'") or die(mysqli_error($db));
        // ???
        $row = mysqli_fetch_assoc($result);

        //Query the database for user
        if ($row['email'] === $email && $row['password'] === $password) {
          echo "<script>window.location.href='home.php';</script>";
          exit();
          $_SESSION['firstname'] = $row['firstname'];
          //header('Location:home.php');
          //exit(); //redirects to home page
        } else {
          header('Location: ../apps/login.php?login=notvalid');
          exit();
        }
      }
    }
  } else {
    header('Location:login.php');
    exit();
  }*/
?>
