<?php
$page = 'index';
include 'scripts/header.php';
?>
      <main>
<?php
$sql_cat = mysqli_query($db, "SELECT cat_id, cat_$lang AS title FROM catalog ORDER BY cat_pos");
if (mysqli_num_rows($sql_cat)) {
  while ($row_cat = mysqli_fetch_array($sql_cat)) {
    $cat_id = $row_cat['cat_id'];
?>
      <a class="section" href="catalog.php?c=<?php echo $cat_id; ?>">
        <img class="sec-img" src="catalog/cat_photo/<?php echo $cat_id; ?>.jpg" alt="crochet toy: <?php echo $row_cat['title']; ?>">
        <div class="sec-title"><?php echo $row_cat['title']; ?></div>
      </a>
<?php
   }
}
?>
      </main>
<?php
include 'scripts/footer.php';