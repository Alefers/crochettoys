<?php
$page = 'description';
include 'scripts/header.php';
$item_count = 0;
$cat_id = 0;
$item_id = 0;
if (isset($_GET['c']) && isset($_GET['i'])) {
   $cat_id = intval($_GET['c']);
   $item_id = intval($_GET['i']);
   if ($cat_id && $item_id) {
      $item_sql = mysqli_query($db, "SELECT i_title_$lang AS i_title, i_$lang AS i_txt, i_price, i_term_from, i_term_to, i_size_$lang AS i_size FROM items WHERE i_id = $item_id AND cat_id = $cat_id AND i_show = 1");
      $item_count = mysqli_num_rows($item_sql);
      $cat_sql = mysqli_query($db, "SELECT cat_show_price FROM catalog WHERE cat_id = $cat_id");
      $cat_row = mysqli_fetch_array($cat_sql);
   }
}
if ($lang == 'lv') {
   $w1 = 'Apraksts';
   $w2 = 'Izmēri';
   $w3 = 'Izgatavošanas laiks';
   $w4 = 'Materiāli';
   $w5 = 'Pasūtījumu pieņemšana pa tālruni:';
   $w6 = 'Sīkāka informācija sadaļā';
   $w7 = 'Kā pasūtīt';
} else {
   $w1 = 'Описание';
   $w2 = 'Размеры';
   $w3 = 'Срок изготовления';
   $w4 = 'Материалы';
   $w5 = 'Заказы принимаются по телефону:';
   $w6 = 'Более подробная информация в разделе';
   $w7 = 'Оплата и доставка';
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
          <a href="catalog.php?c=<?php echo $cat_menu_row['cat_id'];?>"<?php echo $active?>><?php echo $cat_menu_row['title'];?></a>
<?php if ($cat_menu_row['cat_id'] == $cat_id) {
        $item_menu_sql = mysqli_query($db, "SELECT i_id, i_title_$lang AS i_title FROM items WHERE cat_id = $cat_id AND i_show = 1");
        if (mysqli_num_rows($item_menu_sql)) {?>
          <ul class="cat-subnav">
<?php            while ($item_menu_row = mysqli_fetch_array($item_menu_sql)) {?>
            <li><a href="description.php?c=<?php echo $cat_id;?>&i=<?php echo $item_menu_row['i_id'];?>"><?php echo $item_menu_row['i_title'];?></a></li>
<?php   }?>
          </ul>
<?php }
      }
   }
}
?>
        </nav>
        <section class="section">
<?php
if ($item_count) {
  $item_row = mysqli_fetch_array($item_sql);
?>
          <h1>
            <?php echo $item_row['i_title'];?>
          </h1>
<?php
  if ($cat_row['cat_show_price']) {?>
          <h2>
            € <?php echo $item_row['i_price'];?>
          </h2>
<?php   
}
$img_sql = mysqli_query($db, "SELECT * FROM item_img WHERE i_id = $item_id ORDER BY img_main");
$img_count = mysqli_num_rows($img_sql);
if ($img_count) {?>
          <div class="des-images-box">
<?php
  $img_row = mysqli_fetch_array($img_sql);?>
            <img class="des-ib" src="catalog/<?php echo $img_row['img_id'];?>.jpg" alt="<?php echo $item_row['i_title'];?>">
<?php
  if ($img_count > 1) {?>
            <div class="des-ib-links">
              <img class="des-is" src="catalog/<?php echo $img_row['img_id'];?>.jpg" alt="<?php echo $item_row['i_title'];?>">
<?php
      while ($img_row = mysqli_fetch_array($img_sql)) {?>
              <img class="des-is" src="catalog/<?php echo $img_row['img_id'];?>.jpg" alt="<?php echo $item_row['i_title'];?>">
<?php }?>
            </div>
<?php }}?>
          </div>
      <div class="des-like-btns"></div>
      <div class="des-txt">
        <h3><?php echo $w1;?></h3>
<?php
$lines = explode("\n", $item_row['i_txt']);
foreach ($lines as $value) {
  if ($value !== '') { ?>
        <p><?php echo $value;?></p>
<?php }
}
?>
      </div>
      <div class="des-info-box clearfix">
        <div class="des-info">
          <h3><?php echo $w2;?></h3>
          <?php echo $item_row['i_size'];?> 
        </div>
        <div class="des-info">
          <h3><?php echo $w3;?></h3>
          От <?php echo $item_row['i_term_from'];?> до <?php echo $item_row['i_term_to'];?> дней
        </div>
      </div>
      <div class="des-info-box">
        <h3><?php echo $w4;?></h3>
<?php
$con_sql = mysqli_query($db, "SELECT consist.con_$lang as txt FROM item_con, consist WHERE i_id = $item_id AND item_con.con_id = consist.con_id");
if (mysqli_num_rows($con_sql)) {
   $chck_list = '';
   while ($con_row = mysqli_fetch_array($con_sql)) {
      $chck_list .= $con_row['txt'] . ', ';
   }
   echo trim($chck_list, ', ');
}
?>
      </div>
      <div class="des-info-box">
         <div class="des-phone">
            <?php echo $w5;?> <a href="tel: +37125534036">+371 25 534 036</a>
         </div>
         <div class="des-buy">
            <?php echo $w6;?> <a href="paydelivery.php">"<?php echo $w7;?>"</a>
         </div>
      </div>
<?php
} else {
   echo '<div id="des_title">Данный товар удалён или никогда не существовал.<br>Выберите в меню существующие в наличии позиции.</div>';
}
?>      
        </section>
      </main>
      <script>
$('.des-is').click(function() {
  $('.des-ib').attr('src', $(this).attr('src'));
});
      </script>
<?php
if ($cat_id) {
   echo '<a href="catalog.php?c=' . $cat_id . '" class="back_btn"></a>';
} else {
   echo '<a href="index.php" class="back_btn"></a>';
}
include 'scripts/footer.php';
