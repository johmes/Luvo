<?php
if(isset($_POST['submit'])) {
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
        $target_fileNameNew = "receipt" . uniqid('', true) .
        "." . $target_fileActualExt;
        $target_fileDir = "uploads/" . $target_fileNameNew;
        move_uploaded_file($target_fileTmpName, $target_fileDir);
        echo "
        <div id='uploadedFile' style='font-family: Helvetica; text-align: center;'>
          <img src='". $target_fileDir ."' alt='Upload' style='width: 400px; height: auto;'></img>
          <p>File Name: " . $target_fileNameNew . "</p>
          <p>File Size: " .
            $target_fileSize
           . "</p>
        </div>
        ";
        //header("Location: savefile.php?success");
      } else {
        echo "Your file is too big! Max file size is 3 Mb.";
      }
    } else {
      echo "There was an error uploading your file!";
    }
  } else {
    echo "File type is not supported :(";
  }
}
/*
if ($target_fileSize >= 1073741824) {
    $target_fileSize = number_format($target_fileSize / 1073741824, 2) . ' GB';
}
elseif ($target_fileSize >= 1048576) {
    $target_fileSize = number_format($target_fileSize / 1048576, 2) . ' MB';
}
elseif ($target_fileSize >= 1024) {
    $target_fileSize = number_format($target_fileSize / 1024, 2) . ' KB';
}
elseif ($target_fileSize > 1) {
    $target_fileSize = $target_fileSize . ' bytes';
}
elseif ($target_fileSize == 1) {
    $target_fileSize = $target_fileSize . ' byte';
}
else {
    $target_fileSize = '0 bytes';
}*/
 ?>
