<?php
$page = 'aboutme';
include 'scripts/header.php';
$sql_abme = mysqli_query($db, "SELECT * FROM other WHERE id = 1");
if (mysqli_num_rows($sql_abme)) {
   $row_abme = mysqli_fetch_array($sql_abme);
   $abme = $row_abme['abme_' . $lang];
} else {
   $abme = '';
}
?>
<div id="context">
   <div id="abme_box">
      <img src="design/abme.jpg">
<?php
$lines = explode("\n", $abme);
foreach ($lines as $value) {
   if ($value !== '') {
      echo "<p>$value</p>";
   }
}
?>
   </div>
   <div id="before_footer"></div>
</div>
<?php
include 'scripts/footer.php';