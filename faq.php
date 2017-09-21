<?php
$page = 'faq';
include 'scripts/header.php';
?>
<div id="context">
   <div id="faq_table">
<?php
$sql_faq = mysqli_query($db, "SELECT faq_id, faq_title_$lang AS title, faq_txt_$lang AS txt FROM faq ORDER BY faq_pos");
$count = mysqli_num_rows($sql_faq);
$num = 0;
if ($count) {
   if ($count === 1) {
      $row_faq = mysqli_fetch_array($sql_faq);
      echo '<div class="question">
               <div class="q_box">
                  <img class="low_width to_right" src="faq/' . $row_faq['faq_id'] . '.jpg">
                  <h3>' . $row_faq['title'] . '</h3>';
      $lines = explode("\n", $row_faq['txt']);
      foreach ($lines as $value) {
         if ($value !== '') {
            echo "<p>$value</p>";
         }
      }
      echo '   </div>
               <div class="q_box normal_width">
                  <img src="faq/' . $row_faq['faq_id'] . '.jpg">
               </div>
            </div>';
   }
   if ($count > 1) {
      $flag = false;
      while ($row_faq = mysqli_fetch_array($sql_faq)) {
         $num++;
         echo '<div class="question">';
         if ($flag) {
            echo '<div class="q_box normal_width"><img src="faq/' . $row_faq['faq_id'] . '.jpg"></div>';
         }
         echo '<div class="q_box">';
         if ($flag) {
            echo '<img class="low_width to_left" src="faq/' . $row_faq['faq_id'] . '.jpg">';
         } else {
            echo '<img class="low_width to_right" src="faq/' . $row_faq['faq_id'] . '.jpg">';
         }
         echo '<h3>' . $row_faq['title'] . '</h3>';
         $lines = explode("\n", $row_faq['txt']);
         foreach ($lines as $value) {
            if ($value !== '') {
               echo "<p>$value</p>";
            }
         }
         echo '</div>';
         if (!$flag) {
            echo '<div class="q_box normal_width"><img src="faq/' . $row_faq['faq_id'] . '.jpg"></div>';
            $flag = true;
         } else {
            $flag = false;
         }
         echo '</div>';
         if ($num !== $count) {
            echo '<div class="q_hr"></div>';
         }
      }
   }
}
?>
   </div>
</div>
<?php
include 'scripts/footer.php';
