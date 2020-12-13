<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <style media="screen">
    body {
      margin-left: 15px;
    }
  </style>
  <body>

  </body>
</html>
<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM budget WHERE admin = '1' ORDER BY date_created DESC") or die(mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
  echo '<pre>';
  print_r(mysqli_fetch_assoc($result));
  echo '</pre>';

  /*TEMP ARRAY TO HOLD NEW SORTING*/
  $arr = array();

  //LOOP THROUGH RESULTS ARRAY GROUP THEM INTO NEW ARRAY BASED ON UID AS ARRAY KEY
  foreach($result as $row){
      $arr[$row['date_created']][] = $row;
  }

  //SORT ARR ARRAY BASED ON DESCENDING DATE
  krsort($arr);

  echo 'HERE IS NEW ARRAY STRUCTURE<br />';
  //PRINT OUT THE ARR ARRAY SO YOU CAN SEE NEW STRUCTURE
  echo '<pre>';
  print_r($arr);
  echo '</pre>';

  echo "<h1>Total of " . mysqli_num_rows($result) . " records were found.</h1>";
  //LOOP THROUGH NEW ARRAY TO CREATE YOUR DISPLAY
  foreach ($arr as $date => $dates){
      echo '<h2>'.date('d.m.Y', strtotime($date)).'</h2>';
      foreach($dates as $b){
          echo '<p">'.$b['name'].', '.$b['price'].'€</p>';
      }
      echo"<br>";
  }
}else {
  echo "No result";
}


/*if (mysqli_num_rows($result) > 0) {
  $counter = 1;
  $lastDate = '';
  foreach($result as $row){
      $arr[$row['date']][] = $row;
  }
  while($row = mysqli_fetch_array($result)) {
    $date = $row['date_created'];
    while($date != $lastDate) {
      echo "<h1>" . $date . "</h1>";
      echo "<p>Ostos " . $counter . "</p>";
      $lastDate = $row['date_created'];
      break;
    }
    $counter++;
  }
} else {
  echo "No result";
}*/
//MULTIDIMENSIONAL ARRAY OF dates FROM EXAMPLE
$results = array(
    array('id' =>1, 'uid'=> 20, 'date' => '2020-11-12'),
    array('id' =>2, 'uid'=> 20, 'date' => '2020-11-12'),
    array('id' =>1, 'uid'=> 21, 'date' => '2020-11-12'),
    array('id' =>2, 'uid'=> 21, 'date' => '2020-10-11'),
    array('id' =>1, 'uid'=> 22, 'date' => '2020-10-11'),
    array('id' =>2, 'uid'=> 22, 'date' => '2020-11-15')
);

/*echo 'HERE IS ORIGINAL ARRAY STRUCTURE<br />';
echo '<pre>';
print_r($results);
echo '</pre>';*/

//TEMP ARRAY TO HOLD NEW SORTING
$arr = array();

//LOOP THROUGH RESULTS ARRAY GROUP THEM INTO NEW ARRAY BASED ON UID AS ARRAY KEY
foreach($results as $row){
    $arr[$row['date']][] = $row;
}

//SORT ARR ARRAY BASED ON KEY VALUE ASCENDING... so keys are 20, 21, 22, etc...
ksort($arr);

/*echo 'HERE IS NEW ARRAY STRUCTURE<br />';
//PRINT OUT THE ARR ARRAY SO YOU CAN SEE NEW STRUCTURE
echo '<pre>';
print_r($arr);
echo '</pre>';*/

//echo "HERE IS THE GROUP YOU ARE CURRENTLY DISPLAYING<br />";
//LOOP THROUGH NEW ARRAY TO CREATE YOUR DISPLAY
/*foreach ($arr as $uidGroup => $dates){
    echo 'Group - '.$uidGroup.'<br />';
    foreach($dates as $b){
        echo '<div class="dagens_kampe_kupon">ID: '.$b['id'].' - date: '.$b['date'].'</div>';
    }
}*/

 ?>
