<?php

include "includes/page-init.inc.php";
$user_id = $_SESSION["user_id"];
$title = "Edit transaction | Luvo";
$transactionId = htmlentities(mysqli_real_escape_string($conn, $_GET['edit']));



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="img/Luvo_logo.png">
  <meta name="theme-color" content="#fff">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Budget App For Keeping Your Financial Life Easy.">
  <script src="jquery-3.5.1.min.js"></script>
  <script type="text/javascript" src="script.js"></script>
  <link rel="canonical" href="http://luvo.dev"/>
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="apple-touch-icon" href="img/Luvo_logo.png">
  <link rel="manifest" href="manifest.webmanifest">
  <title><?php echo $title; ?></title>
  <style media="screen">
    .form-group {
      width: 100%;
    }
  </style>
</head>
  <body>
    <?php
    include "includes/mainbar.inc.php";
    ?>
    <div class="main">
    <?php
    if (empty($transactionId)) {
      echo "Could not validate your request!";
    } else {
      if (ctype_xdigit($transactionId) !== false) {
        $transactionId = hex2bin($transactionId);

        // QUERY DATA BASED ON TRANSACTION ID
        $sql = "SELECT * FROM budget WHERE id=? AND admin=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          echo "There was an error!" . mysqli_error($conn);
          exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $transactionId, $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($result)) {
              $name = $row['name'];
              $location = $row['location'];
              $caterogy = $row['category'];
              $price = $row['price'];
              $date = $row['date_created'];
            }

     ?>
    <form rel='async' action="edit_db.php" method="POST">
      <div class="form-group">
        <h4>Edit Transaction</h4>
        <label for="edit_title">Title</label>
        <input class="form-control" type="text" name="edit_title" value="<?php echo $name; ?>" required>
      </div>
      <div class="form-group">
        <label for="edit_location">Payee</label>
        <input class="form-control" type="text" name="edit_location" value="<?php echo $location; ?>" required>
      </div>
      <div class="form-group">
        <label for="edit_category">Category</label>
        <input list="categories" class="form-control" name="edit_category" id="category" value="<?php echo $caterogy; ?>" required>
        <datalist id="categories">
          <option value="Grocery">
          <option value="Food and Drink">
          <option value="Salary">
          <option value="Studies">
          <option value="Clothes">
          <option value="Free time">
          <option value="Electronics">
          <option value="Beauty and Cosmetics">
          <option value="Health and Drugs">
          <option value="Bill">
          <option value="Debt and Loan">
          <option value="Investment and Stocks">
          <option value="Payment">
          <option value="Rent">
          <option value="Recieved Payment">
          <option value="Transportation">
          <option value="Presents">
          <option value="Charity">
          <option value="Other">
        </datalist>
      </div>
      <div class="form-group">
        <label for="edit_price">Price</label>
        <input class="form-control" type="number" name="edit_price" value="<?php echo $price; ?>" min="-9999" max="9999" placeholder="0,00 €" step=".1"  required>
      </div>
      <div class="form-group">
        <label for="bday">Event date</label>
        <input type="date" class="form-control" id="datePicker" name="date_created" value="<?php echo date('Y-m-d', strtotime($date)); ?>" required>
        <span class="validity"></span>
      </div>
      <input type="hidden" name="transaction_id" value="<?php echo $transactionId; ?>">
      <div class="form-group">
        <div id="show_settings">
          <input class="form-control-button edit_form_btn" type="submit" name="submit_edit" value="Save Changes" />
          <input class="form-control-button cancel" type="button" name="cancel_edit" value="Cancel" onClick="window.location='/index.php';" />
        </div>
      </div>
    </form>
    <?php
    }
    mysqli_close($conn);
  } else {
    echo "Something went wrong... Try again later.";
    }
  }
  ?>
  </div>
  <?php
  include "footer.php";
   ?>
  </body>
</html>
