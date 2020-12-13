<?php
$title = 'Luvo';
?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <link rel="stylesheet" href="style.css">
   </head>
   <body>
     <nav>
      <div class="burger_menu">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
      </div>
       <h2><?php echo $title; ?></h2>
       <!-- <span>
         <a href="home.php">
           <img src="img/luvo_main_logo.png" alt="Luvo logo" id="logo">
         </a>
       </span> -->
       <div class="navigation-menu" id="menu_id">
         <ul>
           <li><a class="<?php if($mainpage=='home'){ echo 'active';} ?>" href="home.php" title="Home"><i class="glyphicon glyphicon-home"></i><p>Home</p></a></li>
           <li><a class="<?php if($mainpage=='usage'){ echo 'active';} ?>" href="usage.php" title="Usage"><i class="glyphicon glyphicon-stats"></i><p>Usage</p></a></li>
           <li><a class="<?php if($mainpage=='settings'){ echo 'active';} ?>" href="settings.php" title="Settings"><i class="glyphicon glyphicon-cog"></i><p>Settings</p></a></li>
           <li><a class="<?php if($mainpage=='logout'){ echo 'active';} ?>" href="profile_management/logout.php" title="Log Out"><i class="glyphicon glyphicon-log-out"></i><p>Log Out</p></a></li>
         </ul>
       </div>
     </nav>
    <script type="text/javascript">
        $(document).ready(function(){
          $("#search_profile").keyup(function(){
            $(document).scrollTop(0);
            var txt = $(this).val();
            if(txt != "") {
              $("#searchIcon").click(
                function(){
                  $(".search_bar").val('');
                }).css("cursor", "pointer");
                //QUERY SERVER SIDE FOR INFO FROM DB
              $.ajax({
                url: "fetch_array.php",
                method: "get",
                data:{search:txt},
                dataType:"text",
                success:function(data) {
                  $('.list').html(data);
                }
              });
            }
          });
          //MENU TAB STYLING FOR SEARCH BAR ANIMATION
          var $window = $(window);
          var windowsize = $window.width();
          $("#searchIcon").click(function(){
            $("#searchIcon").stop(true).css('display', 'none');
            $('#closeIcon').stop(true).css('display', 'block');
            $('#search_profile').stop(true).css('display', 'block');
            $('.top_nav_menu_button.search-box').css('width', 'auto');
          });
          $("#closeIcon").click(function(){
            $('#search_profile').css('display', 'none');
            $('.top_nav_menu_button.search-box').css('width', '41px');
            $('#closeIcon').css('display', 'none');
            $("#searchIcon").css('display', 'block');
          });
          /*************/
          $(".burger_menu").click(function(){
            $(this).toggleClass("change");
            $('nav ul').toggleClass("active");
          });
          const menu = $('nav ul');
           $(document).mouseup(e => {
              if (!menu.is(e.target)
              && menu.has(e.target).length === 0)
              {
                $(".burger_menu").removeClass("change");
                menu.removeClass("active");
             }
            });
        });
   </script>
  </body>
 </html>
