<?php
  include "mainmenubar.php";
 ?>
 <main>
   <div class="wrapper-main">
     <section class="section-default">
       <h1>Reset your password.</h1>
       <p>An e-mail will be send to you with instructions on how to reset your password.</p>
       <form class="" action="includes/reset-request.inc.php" method="post">
         <input type="text" name="email" placeholder="Enter your e-mail address...">
         <button type="submit" name="reset-request-submit">Send</button>
       </form>
       <?php
         if(isset($_GET["reset"])) {
           if ($_GET["reset"] == "success") {
             echo '<p class="signupsuccess">Check your e-mail!</p>';
           }
           if ($_GET["reset"] == "mail-error") {
             echo '<p class="signuperror">Password reset could not be send.</p>';
           }
         }
        ?>
     </section>
   </div>
 </main>
 <?php
 include "footer.php";
  ?>
