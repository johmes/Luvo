<?php
$title = 'Luvo';
?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
   </head>
   <body>
     <nav>
       <?php if(isset($_SESSION['loggedin'])) { ?>
        <div class="burger_menu">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
      <?php } ?>
       <h2><?php echo $title; ?></h2>
       <?php if(isset($_SESSION['loggedin'])) { ?>
         <div class="navigation-menu" id="menu_id">
           <ul>
             <li><a class="<?php if($mainpage=='home'){ echo 'active';} ?>" href="index.php" title="Home"><i class="glyphicon glyphicon-home"></i><p>Home</p></a></li>
             <li><a class="<?php if($mainpage=='usage'){ echo 'active';} ?>" href="usage.php" title="Usage"><i class="glyphicon glyphicon-stats"></i><p>Usage</p></a></li>
             <li><a class="<?php if($mainpage=='settings'){ echo 'active';} ?>" href="settings.php" title="Settings"><i class="glyphicon glyphicon-cog"></i><p>Settings</p></a></li>
             <li><a class="<?php if($mainpage=='logout'){ echo 'active';} ?>" href="logout.php" title="Log Out"><i class="glyphicon glyphicon-log-out"></i><p>Log Out</p></a></li>
           </ul>
         </div>
       <?php } ?>
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
          const menu = $('nav ul');
          const burger = $(".burger_menu");
          burger.click(function(){
            burger.toggleClass("change");
            menu.toggleClass("active");
          });
          // $(document).mouseup(e => {
          //    if (!menu.is(e.target) && menu.has(e.target).length === 0 || menu.is(e.target)) {
          //      burger.removeClass("change");
          //      menu.removeClass("active");
          //    }
          //  });

        });
   </script>
  </body>
 </html>
