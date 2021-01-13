<?php
include 'includes/config.inc.php';

$rowperpage = 5;

// counting total number of posts
$allcount_query = "SELECT count(*) as allcount FROM budget";
$allcount_result = mysqli_query($conn,$allcount_query);
$allcount_fetch = mysqli_fetch_array($allcount_result);
$allcount = $allcount_fetch['allcount'];

$feedquery = mysqli_query($conn, "SELECT * FROM budget WHERE name LIKE '%" . $_GET['search'] ."%'
  OR location LIKE '%" . $_GET['search'] ."%' ORDER BY date_created DESC")
  or die("The query couldn't find match from the database!");

if (mysqli_num_rows($feedquery)  > 0) {
  $result = mysqli_query($conn, "SELECT SUM(price) as total FROM budget") or die(mysqli_error($conn));
  while($row = mysqli_fetch_array($feedquery, MYSQLI_ASSOC)):
    $id = $row['id'];
    $name = $row['name'];
    $price = $row['price'];
    $date = $row['date_created'];
    $location = $row['location'];
    $category = $row['category'];
    $file_dir = $row['file_dir'];

    $priceColor = ($price > 0) ? "#52BE80" : "#f0ad4e";
    include "post.php";
  endwhile;
} else {
  ?>
  <div class="no_result_base" style="width: 100%; text-align: center;">
      <img src="img/empty_list_blue.png" alt="Nothing here..." class="no_result">
  </div>
  <?php
}
 ?>
