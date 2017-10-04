<?php
$page = 'faq';
include 'scripts/header.php';
function printP($string) {
  $lines = explode("\n", $string);
  foreach ($lines as $value) {
    if ($value !== '') {
      echo "<p>$value</p>";
    }
  }
}
?>
      <main>
<?php
$sql_faq = mysqli_query($db, "SELECT faq_id, faq_title_$lang AS title, faq_txt_$lang AS txt FROM faq ORDER BY faq_pos");
if (mysqli_num_rows($sql_faq)) {
  while ($row_faq = mysqli_fetch_array($sql_faq)) {?>
        <article class="question">
          <img class="q-img" src="/faq/<?php echo $row_faq['faq_id'];?>.jpg">
          <div class="q-box">
            <h2><?php echo $row_faq['title'];?></h2>
            <?php printP($row_faq['txt']);?>
          </div>
        </article>
<?php }}?>
      </main>
<?php
include 'scripts/footer.php';