<?php
session_start();
if ($_POST['login'] === 'Veronika' && $_POST['pass'] === 'Bueverova') {
   $_SESSION['admin'] = true;
   header('location: ../crochettoys_admin/catalog_add.php');
} else {
   $_SESSION['login_error'] = true;
   header('location: ../nikaadmin.php');
}