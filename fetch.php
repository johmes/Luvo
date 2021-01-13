<?php
$conn = mysqli_connect("localhost", "root", "") or die("Couldn't connect to the server!");
mysqli_select_db($conn, "usersection") or die("This database could not be found!");
$output = '';
$userquery = mysqli_query($conn, "SELECT * FROM users WHERE firstname LIKE '" . $_GET['search'] ."%'") or die("The query couldn't find match from the database!");

if (mysqli_num_rows($userquery)  > 0) {
  echo "<h4 align='center'>Result</h4>";
  while($row = mysqli_fetch_array($userquery, MYSQLI_ASSOC)) {
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    echo "<li class='resultList'><a href='#profile'>" . $firstname . " " . $lastname . "</a></li>";
  }
} else {
  echo "<h4 align='center'>No Result</h4>";
}
?>
