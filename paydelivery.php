<?php
$page = 'paydelivery';
include 'scripts/header.php';
$sql_pad = mysqli_query($db, "SELECT * FROM other WHERE id = 1");
if (mysqli_num_rows($sql_pad)) {
   $row_pad = mysqli_fetch_array($sql_pad);
   $pad_title = $row_pad['pad_title_' . $lang];
   $pad_txt = $row_pad['pad_txt_' . $lang];
} else {
   $pad_title = '';
   $pad_txt = '';
}
?>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAKNCRJ97SWzrkr7E_9QJng1oWRxE92AU"></script>
      <main>
        <div class="pd-map">
          <div id="gglmaps"></div>
        </div>
        <div class="pd-title">
          <?php echo $pad_title; ?>
        </div>
        <?php echo $pad_txt; ?>
      </main>
      <script>
function initialize() {
   var mapOptions = {
      zoom: 15,
      center: new google.maps.LatLng(56.899859, 24.084324)
   };
   var map = new google.maps.Map(document.getElementById('gglmaps'), mapOptions);
   var myLatLng = new google.maps.LatLng(56.899859, 24.084324);
   var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: 'Ozolciema 10/1',
      zIndex: 3
   });
}
$(document).ready(function() {
   initialize();
});
      </script>
<?php
include 'scripts/footer.php';
