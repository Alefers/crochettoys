<?php
$page = 'catalog';
include 'scripts/header.php';
$cat_id = 0;
$cat_count = 0;
if (isset($_GET['c'])) {
  $cat_id = intval($_GET['c']);
  if ($cat_id) {
    $cat_sql = mysqli_query($db, "SELECT  cat_$lang AS title, cat_show_price FROM catalog WHERE cat_id = $cat_id");
    $cat_count = mysqli_num_rows($cat_sql);
    $cat_row = mysqli_fetch_array($cat_sql);
  }
}
?>
      <main>
        <nav class="cat-nav">
<?php
$cat_menu_sql = mysqli_query($db, "SELECT cat_id, cat_$lang AS title FROM catalog ORDER BY cat_pos");
if (mysqli_num_rows($cat_menu_sql)) {
  while ($cat_menu_row = mysqli_fetch_array($cat_menu_sql)) {
    if ($cat_id == $cat_menu_row['cat_id']) {
      $active = ' class="cat-nav-active"';
    } else {
      $active = '';
    }?>
          <a href="/catalog.php?lang=<?php echo $lang;?>&c=<?php echo $cat_menu_row['cat_id'];?>"<?php echo $active;?>><?php echo $cat_menu_row['title'];?></a>
<?php }}?>
        </nav>
        <section class="section">
          <h2 class="cat-title">
<?php
if ($cat_count) {
  echo $cat_row['title'];
} else {
  echo 'Запрашиваемый вами каталог не существует.';
}
?>
          </h2>
          <div class="cat-item-box">
<?php
if ($cat_count) {
  $item_sql = mysqli_query($db, "SELECT i_id, i_title_$lang AS i_title, i_price FROM items WHERE cat_id = $cat_id AND i_show = 1");
  if (mysqli_num_rows($item_sql)) {
    while ($item_row = mysqli_fetch_array($item_sql)) {
      $item_id = $item_row['i_id'];
      $img_sql = mysqli_query($db, "SELECT img_id FROM item_img WHERE i_id = $item_id AND img_main = 1");
      $img = 0;
      if (mysqli_num_rows($img_sql)) {
        $img_row = mysqli_fetch_array($img_sql);
        $img = $img_row['img_id'];
      }
?>
            <a class="cat-item" href="/description.php?lang=<?php echo $lang;?>&c=<?php echo $cat_id;?>&i=<?php echo $item_id;?>">
              <img src="/catalog/<?php echo $img;?>.jpg" alt="<?php echo $item_row['i_title'];?>">
              <h3>
                <?php echo $item_row['i_title'];?>
              </h3>
<?php if ($cat_row['cat_show_price']) { ?>
              <div>€ <?php echo $item_row['i_price'];?></div>
<?php }?>
            </a>
<?php
    }
  } else {
      echo 'Этот раздел на данный момент пуст';
  }
}
?>
          </div> 
        </section>
      </main>
<?php
include 'scripts/footer.php';