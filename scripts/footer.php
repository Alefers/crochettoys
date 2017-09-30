      <footer class="footer">
        <div class="after-hdr-linegrey"></div>
        <p>
<?php
$sql_ftr = mysqli_query($db, "SELECT * FROM other WHERE id = 1");
if (mysqli_num_rows($sql_ftr)) {
   $row_ftr = mysqli_fetch_array($sql_ftr);
   $ftr = $row_ftr['ftr_' . $lang];
} else {
   $ftr = '';
}
echo $ftr;
?>
        </p>
      </footer>
<?php
if (isset($_SESSION['admin'])) {
   echo '<div class="logout">
            ВЫЙТИ
         </div>
         <script>
            $(".logout").click(function() {
               $.post(
                  "scripts/logout.php",
                  {logout: 1},
                  function() {
                     location.reload();
                  }
               );
            });
         </script>';
}
?>
    </div>  <!-- .wrapper end -->
  </body>
</html>