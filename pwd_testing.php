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
