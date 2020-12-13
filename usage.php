<?php
$mainpage = 'usage';
$title= 'Luvo - Usage';
// configuration
include_once 'config.php';
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('location: profile_management/login.php');
  exit();
}
$user_id = $_SESSION["user_id"];
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
    <link rel="icon" href="img/Luvo_logo.png">
    <style media="screen">
      .pieContainer {
        position: relative;
        display: block;
        float: left;
        margin: 15px 5px;
        width: 150px;
        height: 150px;
      }

      .pieBackground {
        position: relative;
        border-radius: 75px;
        /* width: 150px;
        height: 150px;
        box-shadow: 0px 0px 4px rgba(0,0,0,0.5); */
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
        font-size: 20px;
        margin-left: 30px;
        padding-left: 20px;
        color: white;
        margin-bottom: 20px;
      }
      h4 {
        height: auto;
      }
      .grapgh_base {
        position: relative;
        text-align: center;
        width: 50%;
        float: left;
        padding: 0;
        margin: 0;
      }
      .grapgh_base a {
        color: var(--color);
      }
    </style>
    <script type="text/javascript">
      //USAGE PAGE SCRIPT
      $(document).ready(function(){
        var numCategoryArray = [
          "35",
          "3",
          "12",
          "15",
          "23"
        ];
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
        var totalArrayCount = 0;
        var slice = 0;
        var position = 0;
        for(var i = 0; i < numCategoryArray.length; i++){
          if(parseInt(numCategoryArray[i])) {
            totalArrayCount += parseInt(numCategoryArray[i]);
          } else {
            totalArrayCount = 0;
          }
        }

        for(var i = 0; i < numCategoryArray.length; i++){
          var iPlusOne = i + 1;
          var id = `link_${iPlusOne}`;
          var formerId = '';
          const cssId = `pieSlice${iPlusOne}`;
          const pie = `#${cssId} .pie`;

          slice = (parseInt(numCategoryArray[i])/totalArrayCount)*360;
          //Fetch each slice to diagram.
          $('.pieBackground').append(`<div id="${cssId}" title="${iPlusOne}"
          class="hold"><div class="pie" style="background-color: ${categoryColor[i]};">
          </div></div>`);

          //DEFINE THE POSITION OF THE SLICE
          if (i <= (numCategoryArray.length-1)) {
            document.getElementById(cssId).style.transform = `rotate(${position}deg)`;
            console.log(i+"position: " +position+"deg");
          } else {
            document.getElementById(cssId).style.transform = `rotate(${slice}deg)`;
            console.log(i+"position: " +position+"deg");
          }

          //DEFINE THE RADIUS OF THE SLICE
          const classPie = document.querySelector(`${pie}`);
          if (i <= (numCategoryArray.length-1)) {
            classPie.style.transform = `rotate(${slice}deg)`;
            console.log(`Slice normaalisti ${slice}`)
          } else {
            classPie.style.transform = `rotate(${slice}deg)`;
            console.log(`Slice lopussa ${slice}`)
          }


          //console.log(i+"slice: " + slice+"deg");
          console.log("cssId: "+cssId);
          // var jqueryCssId = `#${cssId}`;
          // var jqueryFormer = '';
          // if (i >= 1) {
          //   if ($(jqueryCssId).offsetLeft == $(jqueryFormer).offsetLeft || $(jqueryCssId).offsetRight == $(jqueryFormer).offsetRight) {
          //     console.log(`${$(jqueryCssId).offsetLeft} ${$(jqueryFormer).offsetLeft} ${$(jqueryCssId).offsetRight} ${$(jqueryFormer).offsetRight}`);
          //   }
          // }
          position += slice;
          formerId = cssId;
        }
        console.log(position);
        document.getElementById('content').innerHTML = `<b>Purchases<br><span style="font-size: 1.3em;">${totalArrayCount}</span></b>`;
      });
    </script>
  </head>
  <body>
    <div>
      <?php include "sort_list.php"; ?>
    </div>
    <div class="main" style='float: left; display: inline-block; margin: 55px 15px;'>
      <h1>Usage</h1>
      <div class="transaction">
        <h3>This year 2459.60€</h3>
      </div>
      <div class="transaction">
        <h3>Budget this month 500€</h3>
        <p style="margin: 10px 15px;">Left for this month 120€</p>
      </div>
      <div class="transaction">
        <h3>Categories</h3>
          <div class="grapgh_base">
            <a href="#Month">
              <h4>December</h4>
              <div class="pieContainer">
                <div class="pieBackground"></div>
                <div class="innerCircle"><div class="content" id="content"><b>Purchases<br><span style="font-size: 1.3em;">00</span></b></div></div>
              </div>
            </a>
          </div>
        <div class="grapgh_base">
          <a href="#Year">
            <h4>2020</h4>
            <div class="pieContainer">
              <div class="pieBackground"></div>
              <div id="pie2Slice1" title="1" class="hold">
                <div class="pie"></div>
            </div>
            <div id="pie2Slice2" title="2" class="hold">
              <div class="pie"></div>
            </div>
              <div class="innerCircle"><div class="content" id="content"><b>Purchases<br><span style="font-size: 1.3em;">258</span></b></div></div>
            </div>
          </a>
        </div>
        </div>
      </div>
    </div>
  </body>
</html>
