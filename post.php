<?php $header = (empty($location)) ? $name : $name . ", " . $location; ?>
<div class='transaction' id='post_<?php echo $id; ?>'>
 <div class='transaction_upper_header'>
   <div class='name' title="<?php echo $header; ?>">
     <strong>
       <?php echo $header; ?>
     </strong>
   </div>
   <div class="transaction_top_right_corner">
     <span class='category'><?php echo $category; ?></span>
     <div class="dropdown" id="myDropdown_<?php echo $id; ?>">
       <span class="glyphicon glyphicon-option-horizontal" id="dots_<?php echo $id; ?>"></span>
       <div class="dropdown-content">
         <div class="dropdown_tail"></div>
         <a href="edit.php?edit=<?php echo bin2hex($id); ?>" title="Edit">Edit</a>
         <hr>
         <a href="?info=<?php echo $id; ?>" title="More">More</a>
         <hr>
         <a class="danger" id="delete_transaction_<?php echo $id; ?>" href="db_connect_budget.php?delete=<?php echo $id; ?>" title="Delete transaction">Delete</a>
       </div>
     </div>
   </div>
 </div>
 <div class='price_header' style='text-align: center;'>
   <h3 style='float: left; margin: 25px 5px; color:<?php echo $priceColor; ?>'>
     <?php echo $price . " €"; ?>
   </h3>
 </div>
 <?php
 if ($file_dir != "") {
   echo "<div class='file_place' id='file_$id'>
     <img src='" . $file_dir ."' style='float: left; border-radius: 9px; width: 88%; height: auto;'>
     </img>
   </div>
   <div>
     <img src='img/down-arrow.png' alt='Expand file' class='expand_file' style='display: visible;' id='down_arrow_$id'>
   </div>
   <div>
     <img src='img/up-arrow.png' alt='Expand file' class='expand_file' style='display: none;' id='up_arrow_$id'>
   </div>";
 } else {
   echo "<div class='file_place_default'>
   </div>";
 }
 ?>
 <p>
 <span style='font-size: .8em; color: grey;'>
   <?php echo date('d.m.Y', strtotime($date)); ?>
 </span>
 </p>
</div>
<script type="text/javascript">
 $(document).ready(function(){
   var down_arrow = $('#down_arrow_<?php echo $id; ?>');
   var up_arrow = $('#up_arrow_<?php echo $id; ?>');
   var file = $('#file_<?php echo $id; ?>');
   down_arrow.click(function() {
       file.css('height', 'auto');
       up_arrow.css('display', 'block');
       down_arrow.css('display', 'none');
   });
   up_arrow.click(function() {
     file.css('height', '100px');
     down_arrow.css('display', 'block');
     up_arrow.css('display', 'none');
   });
   $('#delete_transaction_<?php echo $id; ?>').on('click', () => {
     if (window.confirm("Do you really want to delete transaction?")) {
       return true;
     } else {
       event.preventDefault();
       return false;
     }
  });
   //SHOW FUNCTIONS DROPDOWN
   var transactionDots = $('#dots_<?php echo $id; ?>');
   var dotsDropdown = $('#myDropdown_<?php echo $id; ?>');
   var closeDropdown = $('#close_<?php echo $id; ?>');

   const $menu = $(dotsDropdown);
    $(document).mouseup(e => {
       if (!$menu.is(e.target) // if the target of the click isn't the container...
       && $menu.has(e.target).length === 0) // ... nor a descendant of the container
       {
         $menu.removeClass('is-active');
      }
     });

    $(transactionDots).on('click', () => {
      $menu.toggleClass('is-active');
    });
    closeDropdown.click(function() {
      $menu.removeClass('is-active');
    });
  });
</script>
