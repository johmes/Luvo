<?php

  // configuration
  session_start();
  include_once 'config.php';
  date_default_timezone_set ('Europe/Helsinki');
  if (!isset($_SESSION['loggedin'])) {
    header('location: profile_management/login.php');
    exit();
  }
  $user_id = $_SESSION["user_id"];
  $mainpage = 'home';
  $title = "Luvo";
   ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <title><?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <!-- <link rel="icon" href="img/Luvo_logo.png">
    <link rel="apple-touch-icon" href="img/Luvo_logo.png"> -->
    <link rel="manifest" href="manifest.webmanifest">
    <style media="screen">
      .primitive_post {
        margin: 10px;
        padding: 8px 12px;
        border: 1px solid black;
      }
      .main_content {
        position: absolute;
        top: 56px;
        width: 100%;
        display: inline-block;
      }
    </style>
  </head>
  <body>
    <div>
      <?php include "sort_list.php"; ?>
    </div>
    <div class="top_nav_menu_button search-box">
        <!--textarea for search-->
        <input class="search_bar" id="search_profile" type="text" placeholder="Search..." name="q">
        <!--search button at right side-->
        <span id="closeIcon" class="fa fa-close"></span>
        <span id="searchIcon" class="fa fa-search"></span>
      </div>
    <!-- MAIN INFO BOX -->
    <div class="main_content">
      <div class="transaction" id="data_info_array" style='float: left; display: inherit;'>
        <div class="data_info_array_content">
          <?php
              //GET TIME
              /* This sets the $time variable to the current hour in the 24 hour clock format */
              $time = date("H");
              $date = $_SESSION['dob'];
              /* Set the $timezone variable to become the current timezone */
              $timezone = date("e");

              if (date('m-d', strtotime($date)) == date('m-d')) {
                echo "<h2>Happy Birthday " . htmlspecialchars($_SESSION['firstname']) . "! 🎂</h2>";
              } else {
                /* If the time is less than 1200 hours, show good morning */
                if ($time < "12") {
                  echo "<h2>Good morning, " . htmlspecialchars($_SESSION['firstname']) . "</h2>";
                } else
                /* If the time is grater than or equal to 1200 hours, but less than 1700 hours, so good afternoon */
                if ($time >= "12" && $time < "17") {
                  echo "<h2>Good day, " . htmlspecialchars($_SESSION['firstname']) . "</h2>";
                } else
                /* Should the time be between or equal to 1700 and 1900 hours, show good evening */
                if ($time >= "17" && $time < "19") {
                  echo "<h2>Good afternoon, " . htmlspecialchars($_SESSION['firstname']) . "</h2>";
                } else
                /* Finally, show good night if the time is greater than or equal to 1900 hours */
                if ($time >= "19") {
                  echo "<h2>Good evening, " . htmlspecialchars($_SESSION['firstname']) . "</h2>";
                }
              }

            $result = mysqli_query($conn, "SELECT SUM(price) as total, SUM(abs(price)) as all_usage FROM budget WHERE admin = '$user_id'") or die("Could not connect to database...");
              if (mysqli_num_rows($result) > 0) {
                while($row = $result->fetch_assoc()):
                $total = $row['total'];
                $all_usage = $row['all_usage']-$total;
            endwhile;
            }
            if($total != 0){
              echo "<h3><span style='margin-top: 25px; color: #52BE80; float: right;'>" . htmlspecialchars($total) . "€</span></h3>";
            } else {
              echo "<h3><span style='margin-top: 25px; color: #52BE80; float: right;'>0.00€</span></h3>";
            }
          ?>
        </div>
      </div>
      <!--LIST OF TRANSACTIONS-->
      <div class="list">
        <h1>Overview</h1>
        <hr />
        <?php
        $rowperpage = 4;

        // counting total number of posts
        $allcount_query = "SELECT count(*) as allcount FROM budget WHERE admin = '$user_id'" or die("All count query not working");
        $allcount_result = mysqli_query($conn, $allcount_query) or die("All count result not working");
        $allcount_fetch = mysqli_fetch_array($allcount_result) or die("All count fetch not working");
        $allcount = $allcount_fetch['allcount'];

          $result = mysqli_query($conn, "SELECT * FROM budget WHERE admin = '$user_id' ORDER BY date_created DESC LIMIT 0, $rowperpage") or die(mysqli_error($conn));

          if (mysqli_num_rows($result) > 0) {
            /*echo '<pre>';
            print_r(mysqli_fetch_assoc($result));
            echo '</pre>';*/
            $transactions = array();
            //LOOP THROUGH RESULTS ARRAY GROUP THEM INTO NEW ARRAY BASED ON UID AS ARRAY KEY

              //$transactions[] = $row;
            foreach($result as $row){
                $arr[$row['date_created']][] = $row;
            }
            //SORT ARR ARRAY BASED ON DESCENDING DATE
            krsort($transactions);
            //SPLIT TRANSACTIONS TO GROUPS BY DATE
            foreach ($arr as $date => $dates){
              ?>
              <!--<div class="summary_info">
                <p class="main_date"><?php //echo date('d.m.Y', strtotime($date)); ?></p>
                <p class="total_expenses"><?php //echo $dates['price']; ?> €</p>
              </div>-->
              <?php
                foreach($dates as $row){
                  $id = $row['id'];
                  $name = $row['name'];
                  $price = $row['price'];
                  $date = $row['date_created'];
                  $location = $row['location'];
                  $category = $row['category'];
                  $file_dir = $row['file_dir'];
                  $priceColor = ($price > 0) ? "#52BE80" : "#f0ad4e";
                  include "post.php";
                }
                echo"<br>";
            }
              //}
            /*while($row = mysqli_fetch_array($result)) {
                $id = $row['id'];
                $name = $row['name'];
                $price = $row['price'];
                $date = $row['date_created'];
                $location = $row['location'];
                $category = $row['category'];
                $file_dir = $row['file_dir'];
                //IF PRICE BELOW 0, ORANGE. IF ABOVE 0, GREEN.
                $priceColor = ($price > 0) ? "#52BE80" : "#f0ad4e";
              include "post.php";
            }*/
          } else {
            ?>
            <div style="width: 100%;">
                <img src="img/empty_list_transparent.png" alt="Nothing here..." style="text-align: center; margin: auto; width: 50%;">
            </div>
            <?php
          }
           ?>
           <h3 class="load-more"></h3>
             <input type="hidden" id="row" value="0">
             <input type="hidden" id="all" value="<?php echo htmlspecialchars($allcount); ?>">

             <!--<div class="footer_shadow" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0), rgba(133, 146, 158,0.4)); position: fixed; bottom: 0; width: 100%; height: 130px;">
           </div>-->
             <!--<div class="action_footer" style="margin-top: 10px; color: grey; padding: 15px; width: 100%; height: 130px;">
               <p style='text-align: center; font-size: 1.3em;'>No older actions</p>
             </div>-->
             <!--TEST VERSION-->
             <!--<div class="primitive_post">
               <h1>Name: <?php //echo $name; ?></h1><br>
               <h3>Price: <?php //echo $price; ?></h3><br>
               <p>Date: <?php //echo $date; ?></p>
             </div>-->
      </div>
    </div>
    <!--NOTIFICATION-->
    <div class="notification" style="
      position: fixed;
      width: 100%;
      float: left;
      color: black;
      font-size: 1em;
      text-align: center;
      background-color: transparent;
      opacity: 1;
      padding: 0px 10px;
      bottom: 0;
    ">
      <h4 id="scroll_notification">Go back to start</h4>
    </div>
    <!--NEW TRANSACTION BUTTON-->
    <div>
      <img src="img/add_red.png" alt="Add New" class="open_add_purchase">
      <!--<input type="button" class="open_add_purchase" name="open" value="New">-->
    </div>
    <!--NEW TRANSACTION FORM-->
    <div class="modal">
      <div class="add_purchase">
        <span class="close">&times;</span>
        <h2 style="text-align: center;">Create Transaction</h2>
        <form action="db_connect_budget.php" method="post" enctype="multipart/form-data">
          <!--TRANSACTION TYPE-->
          <div class="radio_selection">
            <!--INCOME-->
            <div>
              <input type="radio" class="radio" id="income" name="type" value="i">
              <label for="income">Income*</label>
            </div>
            <!--EXPENSE-->
            <div>
              <input type="radio" class="radio" id="expense" name="type" value="e">
              <label for="expense">Expense*</label>
            </div>
          </div>
          <!--PURCHASE NAME-->
          <div class="form-group">
            <input type="text" class="form-control" name="purchase_name" placeholder="Name*" maxlength="35" required>
          </div>
          <!--LOCATION-->
          <div class="form-group">
            <input type="text" class="form-control" name="location_name" placeholder="Location" maxlength="25">
          </div>
          <!--CATEGORIES-->
          <div class="form-group">
            <input list="categories" class="form-control" name="category" id="category" placeholder="Category*" required>
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
              <option value="Payment">
              <option value="Recieved Payment">
              <option value="Transportation">
              <option value="Presents">
              <option value="Charity">
              <option value="Other">
            </datalist>
          </div>
          <!--PRICE-->
          <div class="form-group">
            <label for="purchase_price">Amount*</label>
            <input type="number" id="purchase_price" class="form-control" name="purchase_price" min="-9999" max="9999" placeholder="0,00 €" step=".01" required>
          </div>
          <!--DATE-->
          <div class="form-group">
            <label for="bday">Event date*</label>
            <input type="date" class="form-control" id="datePicker" name="date_created" value="<?php echo htmlspecialchars(date('Y-m-d')); ?>" required>
            <span class="validity"></span>
          </div>
          <!--FILE-->
          <div class="form-group">
            <label for="receipt">Receipt</label>
            <input type="file" name="file" value="receipt">
          </div>
          <input type="hidden" name="admin_id" value="<?php echo htmlspecialchars($_SESSION["user_id"]); ?>">
          <!--SUBMIT-->
          <input type="submit" name="submit" class="btn btn-primary" value="Save">
        </form>
      </div>
    </div>

  <script type='text/javascript'>
  $(document).ready(function() {
    $('.open_add_purchase').click(function() {
      $('.modal').css('display', 'block');
      $('.add_purchase').css('display', 'block');
      $(this).css('display', 'none');
    });
    $('.close').click(function() {
      $('.modal').css('display', 'none');
      $('.add_purchase').css('display', 'none');
      $('.open_add_purchase').css('display', 'block');
    });

    $(this).scrollTop(0);

    // Load more data
    //$('.load-more').click(function(){
    $(window).scroll(function(){
      if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
        var row = Number($('#row').val());
        var allcount = Number($('#all').val());
        var rowperpage = 4;

        //CHECK IF ALLCOUNT IS ODD AND ADD 1 TO SHOW ALL TRANSACTIONS IN TIMELINE.
        if (allcount % 2 === 0) { row; }
        else { row = row + 1; }

        console.log('"Load more" was clicked... ');
        console.log("Initial row: " + row);
        console.log("Initial allcount: " + allcount);
        row = row + rowperpage;

        if(row <= allcount) {
          console.log("Allcount (" + allcount + ") is greater than row (" + row + ").");
          $("#row").val(row);
          $.ajax({
            url: "getData.php",
            type: "post",
            data: {row:row},
            beforeSend:function() {
              $(".load-more").text("Loading...");
              console.log("Quering database... ");
            },
            success: function(response) {
              console.log("Data successfully loaded from database!");
              // Setting little delay while displaying new content
              setTimeout(function() {
                // appending posts after last post with class="post"
                $(".transaction:last").after(response).show().fadeIn("slow");
                var rowno = row + rowperpage;
                console.log("Rowno is now " + rowno);
                // checking row value is greater than allcount or not
                if (rowno > allcount) {
                  // Change the text
                  $('.load-more').text("No older actions");
                  console.log('%c End of row! ', 'color: #5FFA2C');
                } else {
                  $(".load-more").text("More");
                  console.log('%c Not end of row. ', 'color: #FAF02C');
                }
              }, 450);
            }
          });
        }
      }
    });
  $(window).scroll(function() {
    var notification = $('#scroll_notification');
    var window = $("html, window");
    clearTimeout($.data(this, 'scrollTimer'));
    if($(window).scrollTop() >= 150) {
      $.data(this, 'scrollTimer', setTimeout(function() {
        notification.fadeIn("350");
        console.log("Haven't scrolled in 1400ms!");
      }, 1400));
      notification.fadeOut("400");
    };
    var timeout = setTimeout(function() {
    notification.click(function(){
      var body = $("html, body");
      $('html,body').stop(true, false).animate({scrollTop: $('#data_info_array').offset().top - 55}, 200); //, 'swing'
      clearTimeout(timeout);
    });
  }, 200);
});
});

  </script>
  </body>
</html>
