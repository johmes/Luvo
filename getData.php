<?php

// configuration
session_start();
include "db_connect_budget.php";
$user_id = $_SESSION['user_id'];
$row = $_POST['row'];
$rowperpage = 4;

// selecting posts
$query = "SELECT * FROM budget WHERE admin = '$user_id' ORDER BY date_created DESC LIMIT ".$row.",".$rowperpage;
  $result = mysqli_query($conn, $query) or die(mysqli_error());
  $html = "";
if (mysqli_num_rows($result)  > 0) {
  $transactions = array();

  foreach($result as $row){
      $arr[$row['date_created']][] = $row;
  }
  krsort($transactions);
  //SPLIT TRANSACTIONS TO GROUPS BY DATE
  foreach ($arr as $date => $dates){
    ?>
    <!--<div class="summary_info">
      <p class="main_date"><?php //echo date('d.m.Y', strtotime($date)); ?></p>
      <p class="total_expenses">Total x €</p>
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
        $header = (empty($location)) ? $name : $name . ", " . $location;
        // Creating HTML structure
        $html .= "<div class='transaction' id='post_$id'>";
        $html .= "<div class='transaction_upper_header'>";
        $html .= "<div class='name'>
              <p title='$header'>
                <strong>$header</strong>
              </p>
            </div>
            <div class='transaction_top_right_corner'>
              <span class='category'>$category</span>
              <div class='dropdown' id='myDropdown_$id'>
                <span class='glyphicon glyphicon-option-horizontal' id='dots_$id'></span>
                  <div class='dropdown-content'>
                    <br>
                    <a href='?edit=$id'>Edit</a>
                    <hr>
                    <a href='?edit=$id'>More Information</a>
                    <hr>
                    <a id='delete_transaction_$id' href='db_connect_budget.php?delete=$id'>Delete</a>
                  </div>
                </div>
              </div>
            </div>
          <div class='price_header' style='text-align: center;'>
            <h3 style='float: left; margin: 25px 5px; color:$priceColor;'>$price €</h3>
          </div>";

        if ($file_dir != '') {
          $html .= "
            <div class='file_place' id='file_". $id ."'>
              <img src='$file_dir' style='float: left;
              border-radius: 9px; width: 88%; height: auto;'>
              </img>
            </div>
            <div>
              <img src='img/down-arrow.png' alt='Expand file' class='expand_file'
              style='display: visible;' id='down_arrow_$id'>
            </div>
            <div>
              <img src='img/up-arrow.png' alt='Expand file' class='expand_file'
              style='display: none;' id='up_arrow_$id'>
            </div>";
        } else {
          $html .= "
          <div class='file_place_default'>
          </div>";
          /*<img src='img/no-image.png' style='float: left; border-radius: 9px; width: 88%; height: auto;'>
          </img>*/
          }

        $html .= "<p>
          <span style='font-size: .8em; color: grey;'>" .
          date('d.m.Y', strtotime($date)) . "
          </span>
          </p>
        </div>
        ";
        $html .= '
        <script type="text/javascript">
        ';

        $html .= '
          $(document).ready(function(){
            var down_arrow = $("#down_arrow_'.$id.'");
            var up_arrow = $("#up_arrow_'.$id.'");
            var file = $("#file_'.$id.'");
            down_arrow.click(function() {
                file.css("height", "auto");
                up_arrow.css("display", "block");
                down_arrow.css("display", "none");
            });
            ';
            $html .= '
            up_arrow.click(function() {
              file.css("height", "100px");
              down_arrow.css("display", "block");
              up_arrow.css("display", "none");
            });
            ';
            $html .= '
            var transactionDots = $("#dots_'.$id.'");
            var dotsDropdown = $("#myDropdown_'.$id.'");
            var closeDropdown = $("#close_'.$id.'");
            ';
            $html .= '
            const $menu = $("#myDropdown_'.$id.'");
             $(document).mouseup(e => {
               console.log("At least something works!");
                if (!$menu.is(e.target)
                && $menu.has(e.target).length === 0)
                {
                  $menu.removeClass("is-active");
               }
              });
              ';
            $html .= '
             $(transactionDots).on("click", () => {
               console.log("Woohoo");
               $menu.toggleClass("is-active");
             });
             closeDropdown.click(function() {
               $menu.removeClass("is-active");
             });
          });
          ';
          $html .= '</script>';
      }
    }
    echo"<br>";
  }
  echo $html;
?>
