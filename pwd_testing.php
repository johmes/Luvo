<?php
//include "userconfig.php";
/*$pwd = "Johannes123";

$salt = uniqid('', true);
$algo = '6'; // CRYPT_SHA512
$rounds = '5042';
$cryptSalt = '$'.$algo.'$'.$rounds.'$'.$salt;

$hashedPassword = crypt($pwd, $cryptSalt);
// Store complete $hashedPassword in DB

echo "<hr>Password: $pwd<hr>Algo: $algo<hr>Rounds: $rounds<hr>Salt: $cryptSalt<hr>Hashed: $hashedPassword<br>";

// Usage 1:
echo password_hash('Johannes123', PASSWORD_DEFAULT)."\n";
// $2y$10$xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
// For example:
// $2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a

// Usage 2:
$options = [
  'cost' => 11
];
$password_hash = password_hash($pwd, PASSWORD_BCRYPT, $options);
$hash = '$2y$11$UW55YQgTBIFQF8nvnSFtjOgx3.7j/bS6kmJGOzce72xNAA8c.C.u2';
echo "<br>bcrypt ";
echo $password_hash;

$pwd = 'Aatu1234';
if (password_verify ($pwd, $hash)) {
  echo "<br>match!";
} else {
  echo "<br>no match";
}*/
/*$pwd = 'Johannes123';

$salt = uniqid('', true);
$algo = '6'; // CRYPT_SHA512
$rounds = '5042';
$cryptSalt = '$'.$algo.'$rounds='.$rounds.'$'.$salt;

$hashedPassword2 = crypt($pwd, $cryptSalt);*/

/*if(hash_equals($hashedPassword, $hashedPassword2)) {
  echo "Passwords are the same";
} else {
  echo "Passwords do not match!";
}*/
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquerymodal/0.9.1/jquery.modal.min.js"></script>
     <title>Hacking the sh*t out of this web site</title>
   </head>
   <body>
     <form class="" action="pwd_testing.php" method="post">
       <input type="text" style="width: 250px;" name="input" placeholder="Enter your input here">
       <input type="submit" name="send" value="Send">
     </form>
     <label for="hack_text">Hack text: </label>
     <p name="hack_text"><?php echo htmlentities("<script>alert('You have been hacked! lol jk '); console.log(Cookies.get('notificationEnabled'));</script>"); ?></p>
     <?php
     $input1 = isset($_POST['input']);
     $input2 = htmlentities($_POST['input']);
     if (!isset($input1, $_POST['send'])) {
         echo "<br><h2>";
         echo "Output: " . $input1;
         echo "</h2>";
       }
       if("Ylönen" == "Ylönen") {
         echo "TRUE";
       } else {
         echo "FALSE";
       }
     ?>
   </body>
 </html>
