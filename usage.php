<?php
include "includes/page-init.inc.php";
include "includes/config.inc.php";
$user_id = $_SESSION["user_id"];
$mainpage = 'usage';
$title= 'Usage | Luvo';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="canonical" href="http://luvo.dev/<?php echo $mainpage; ?>.php"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="apple-touch-icon" href="img/Luvo_logo.png">
    <link rel="manifest" href="manifest.webmanifest">
    <title><?php echo $title; ?></title>
    <style media="screen">
      .pieContainer {
        position: relative;
        display: block;
        margin: 15px auto;
        width: 150px;
        height: 150px;
      }

      .pieBackground {
        position: relative;
        border-radius: 75px;
      }

      .pie {
        transition: all 1s;
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 75px;
        clip: rect(0px, 75px, 150px, 0px);
      }
      #pie2Slice1 .pie {
        transform: rotate(0deg);
      }
      #pie2Slice1 {
        transform: rotate(180deg);
        background-color: rgba(27,69,139,0.7);
      }
      #pie2Slice2 .pie {
        transform: rotate(180deg);
      }
      #pie2Slice2 {
        transform: rotate(360deg);
        background-color: rgba(26,255,241,0.7);
      }

      .hold {
        position: absolute;
        width: 150px;
        height: 150px;
        border-radius: 75px;
        clip: rect(0px, 150px, 150px, 75px);
      }

      .innerCircle {
        position: absolute;
        width: 120px;
        height: 120px;
        background-color: var(--background-color);
        border-radius: 60px;
        top: 15px;
        left: 15px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1);
        color: var(--color);
      }
      .innerCircle .content {
        position: absolute;
        display: block;
        width: 120px;
        top: 30px;
        left: 0;
        text-align: center;
        font-size: 14px;
      }

      h1 {
        //font-size: 20px;
        //margin-left: 30px;
        padding-left: 20px;
        color: var(--color);
        margin-bottom: 20px;
      }
      h4 {
        height: auto;
      }
      .grapgh_base {
        position: relative;
        display: block;
        text-align: center;
        width: 200px;
        float: left;
        margin: 0 31.5px;
        padding: 0;
      }
      .grapgh_base a {
        color: var(--color);
      }
      .main_usage .glyphicon {
        position: relative;
        display: flex;
        width: 28px;
        float: right;
        font-size: 16px;
        justify-content: space-around;
      }
      .glyphicon:hover {
        cursor: pointer;
      }
      .innerCircle .content span {
        width: 20px;
        text-align: left;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
      }
    </style>
  </head>
  <body>
    <div>
      <?php include "mainmenubar.php"; ?>
    </div>
    <?php
    $currentMonth = date("n");
    $currentMonthLong = date("F");
    $currentMonthShort = date("M");
    $currentYear = date("Y");

    // BASED ON YEAR
    $sql = "SELECT * FROM budget WHERE admin=? AND YEAR(date_created)=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "There was an error!" . mysqli_error($conn);
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "si", $user_id, $currentYear);
      mysqli_stmt_execute($stmt);
      $categoryArray = array();
      $arrayThisYear = array();
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        foreach($row as $val) {
         if(empty($row[4])) { continue; }
         $arrayThisYear[] = $row[4];
        }
      }
      // 4) count the number of occurences
      $categories = array_count_values($arrayThisYear);
      $total_caterogies = array_sum($categories)/10;

    }
    //BASED ON MONTH AND YEAR
    $sql = "SELECT * FROM budget WHERE admin=? AND YEAR(date_created)=? AND MONTH(date_created)=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "There was an error!" . mysqli_error($conn);
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "sii", $user_id, $currentYear, $currentMonth);
      mysqli_stmt_execute($stmt);
      $arrayThisMonth = array();
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        foreach($row as $val) {
         if(empty($row[4])) { continue; }
         $arrayThisMonth[] = $row[4];
        }
      }
      $categoriesThisMonth = array_count_values($arrayThisMonth);
      $totalCategoriesThisMonth = array_sum($categoriesThisMonth)/10;

      echo "Month " . $currentMonth . "<br>";
      foreach($categoriesThisMonth as $name=>$qty) {
        $qty = $qty/10;
        echo $name.' - '.$qty.'<br />';
      }
      echo "Total: " . $totalCategoriesThisMonth;
    }
    mysqli_close($conn);


     ?>
    <div class="main_usage" style='float: left; display: inline-block; margin: 55px 15px;'>
      <h1>Usage</h1>
      <hr />
      <div class="transaction monthly">
        <h3>This month 349,67€</h3>
        <a href="#" title="Dec. 2019"><p style="margin: 10px 15px;">-11,34% from <?php echo $currentMonthShort . " " . $currentYear-1; ?></p></a>
      </div>
      <div class="transaction year">
        <h3>This year 2459.60€</h3>
        <a href="#" title="2019"><p style="margin: 10px 15px;">+121,43% from 2019</p></a>
      </div>
      <div class="transaction monthly budget">
        <h3>Budget this month 500€</h3>
        <i class="glyphicon glyphicon-edit" title="Edit budget"></i>
        <a href="#" title="<?php echo $currentMonthLong; ?>"><p style="margin: 10px 15px;">Left for this month 120,80€</p></a>
      </div>
      <div class="transaction stats">
        <h3>Categories</h3>
          <div class="grapgh_base">
            <a href="#Month">
              <h4><?php echo $currentMonthLong; ?></h4>
              <div class="pieContainer">
                <div class="pieBackground"></div>
                <div class="innerCircle"><div class="content" id="content"><b>Purchases<br><span class="value" style="font-size: 1.3em;"><?php echo $totalCategoriesThisMonth; ?></span></b></div></div>
              </div>
            </a>
          </div>
        <div class="grapgh_base">
          <a href="#Year">
            <h4><?php echo $currentYear; ?></h4>
            <div class="pieContainer">
              <div class="pieBackground"></div>
              <div id="pie2Slice1" class="hold">
                <div class="pie"></div>
            </div>
            <div id="pie2Slice2" class="hold">
              <div class="pie"></div>
            </div>
              <div class="innerCircle"><div class="content" id="content"><b>Purchases<br><span class="value" style="font-size: 1.3em;"><?php echo $total_caterogies; ?></span></b></div></div>
            </div>
          </a>
        </div>
        </div>
      </div>
      <div>
        <?php include "footer.php"; ?>
      </div>
      <script type="text/javascript">
        //USAGE PAGE SCRIPT
        $(document).ready(function(){
          const categoriesArray = JSON.parse(`<?= json_encode($categories) ?>`);
          const categoriesArrayMonth = JSON.parse(`<?= json_encode($categoriesThisMonth) ?>`);

          function sumCategoryArray(array) {
            var arraySum = 0;
            for(var el in array) {
              if(array.hasOwnProperty(el)) {
                arraySum += parseFloat(array[el]/3);
              }
            }
            return arraySum;
          }


          var categoryArraySummed = sumCategoryArray(categoriesArray);
          var categoryArraySummedMonth = sumCategoryArray(categoriesArrayMonth);
          var categoryColor = [
            "rgba(27,69,139,0.7)",
            "rgba(26,255,241,0.7)",
            "rgba(248,0,0,0.7)",
            "rgba(240,128,0,0.7)",
            "rgba(143,0,0,0.7)",
            "rgba(8,240,0,0.7)",
            "rgba(160,64,0,0.7)",
            "rgba(255,215,0,0.7)"
          ];
          var slice = 0;
          var position = 0;
          var amount = Array();
          var category = Array();
          var amountMonth = Array();
          var categoryMonth = Array();

          const pushArray = function(array, pushTo, pushToTwo) {
            for(key in array) {
               if(array.hasOwnProperty(key)) {
                 pushTo.push(array[key]/3);
               }
             }
             for(key in array) {
               if(array.hasOwnProperty(key)) {
                pushToTwo.push(key);
              }
            }
          }
          pushArray(categoriesArray, amount, category);
          pushArray(categoriesArrayMonth, amountMonth, categoryMonth);


          for(var i = 0; i < amount.length; i++){
            var iPlusOne = i + 1;
            var id = `link_${iPlusOne}`;
            var formerId = '';
            const cssId = `pieSlice${iPlusOne}`;
            const pie = `#${cssId} .pie`;

            slice = (parseInt(amount[i])/categoryArraySummed)*360;
            //Fetch each slice to diagram.
            $('.pieBackground').append(`<div id="${cssId}" title="${category[i]} | ${iPlusOne}"
            class="hold"><div class="pie" style="background-color: ${categoryColor[i]};">
            </div></div>`);

            //DEFINE THE POSITION OF THE slice
            if (i <= (amount.length-1)) {
              document.getElementById(cssId).style.transform = `rotate(${position}deg)`;
              console.log(i+"position: " +position+"deg");
            } else {
              document.getElementById(cssId).style.transform = `rotate(${slice}deg)`;
              console.log(i+"position: " +position+"deg");
            }

            //DEFINE THE RADIUS OF THE slice
            const classPie = document.querySelector(`${pie}`);
            if (i <= (amount.length-1)) {
              classPie.style.transform = `rotate(${slice}deg)`;
              console.log(`slice normaalisti ${slice}`)
            } else {
              classPie.style.transform = `rotate(${slice}deg)`;
              console.log(`slice lopussa ${slice}`)
            }

            console.log("cssId: "+cssId);
            position += slice;
            formerId = cssId;
          }
        });
      </script>
  </body>
</html>
