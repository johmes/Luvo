<?php
  //configuration
  include 'config.php';

  if(isset($_POST['submit'])) {
    $type = isset($_POST['type']) ? $_POST['type'] : null;
    $name = isset($_POST['purchase_name']) ? $_POST['purchase_name'] : null;
    $location = isset($_POST['location_name']) ? $_POST['location_name'] : null;
    $category = isset($_POST['category']) ? $_POST['category'] : null;
    $price = isset($_POST['purchase_price']) ? $_POST['purchase_price'] : null;
    $date_created = isset($_POST['date_created']) ? $_POST['date_created'] : null;
    $admin_id = isset($_POST['admin_id']) ? $_POST['admin_id'] : null;

    $name = htmlentities(mysqli_real_escape_string($conn, $name));
    $location = htmlentities(mysqli_real_escape_string($conn, $location));
    $price = htmlentities(mysqli_real_escape_string($conn, $price));

    $name = stripcslashes($name);
    $location = stripcslashes($location);
    $price = stripcslashes($price);
    $price = ($type != 'i' && $price >= 0) ? -$price : $price;
    $file = $_FILES['file'];
    $target_fileName = $file['name'];
    $target_fileTmpName = $file['tmp_name'];
    $target_fileSize = $file['size'];
    $target_fileError = $file['error'];
    $target_fileType = $file['type'];

    //define which extensions are allowed
    $target_fileExt = explode('.', $target_fileName);
    $target_fileActualExt = strtolower(end($target_fileExt));
    $allowed = array('jpeg', 'jpg', 'png', 'pdf', 'gif');

    if (in_array($target_fileActualExt, $allowed)) {
      if ($target_fileError === 0) {
        if ($target_fileSize < 3000000) {
          if($target_fileActualExt != 'pdf') {
            $target_fileNameNew = "receipt" . uniqid('', true) .
            "." . $target_fileActualExt;
            $target_fileDir = "uploads/" . $target_fileNameNew;
            move_uploaded_file($target_fileTmpName, $target_fileDir);
          } else {
            if ($result == 0) {
              $target_fileNameNew = "receipt" . uniqid('', true) .
              ".jpg";
              $target_fileDir = "uploads/" . $target_fileNameNew;
              move_uploaded_file($target_fileTmpName, $target_fileDir);
            } else {
              echo "There was a problem! Try again later.";
            }
          }
        } else {
          echo "Your file is too big! Max file size is 3 Mb.";
        }
      } else {
        echo "There was an error uploading your file!";
      }
    } else {
      echo "File type is not supported :(";
    }

    $query = "INSERT INTO budget (type, name, location, category, price, file_dir, date_created, admin)
     VALUES('$type', '$name', '$location', '$category', '$price', '$target_fileDir', '$date_created', '$admin_id')";
     mysqli_query($conn, $query);
     header("location: home.php");
     exit();
  }
  if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM budget WHERE id = $id") or die($conn->error());
    header("location: home.php");
    exit();
  }
 ?>
