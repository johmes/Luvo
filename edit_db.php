<?php
include "includes/page-init.inc.php";

if(isset($_POST['submit_edit'])){
  $transaction_id = htmlentities(mysqli_real_escape_string($conn, $_POST['transaction_id']));
  $name = htmlentities(mysqli_real_escape_string($conn, $_POST['edit_title']));
  $location = htmlentities(mysqli_real_escape_string($conn, $_POST['edit_location']));
  $price = htmlentities(mysqli_real_escape_string($conn, $_POST['edit_price']));
  $category = htmlentities(mysqli_real_escape_string($conn, $_POST['edit_category']));
  $date_created = $_POST['date_created'];
  $admin_id = $_SESSION["user_id"];
  $last_changed = date("Y-m-d H:i:s");


  // UPDATE TRANSACTION DATA
  $sql = "UPDATE budget SET name = ?, location = ?, category = ?, price = ?, date_created = ?, last_modified = ? WHERE id = ? AND admin = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "There was an error!" . mysqli_error($conn);
    //exit();
  } else {
      mysqli_stmt_bind_param($stmt, "ssssssss", $name, $location, $category, $price, $date_created, $last_changed, $transaction_id, $admin_id);
      // mysqli_stmt_execute($stmt);
      // $result = mysqli_stmt_get_result($stmt);
      if($stmt->execute()) {
        header('location: https://luvo.dev/index.php?edit=success');
      } else {
        header('location: https://luvo.dev/index.php?edit=failed');
      }
    }
    mysqli_close($conn);
  }

 ?>
