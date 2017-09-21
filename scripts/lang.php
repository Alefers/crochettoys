<?php
session_start();
if ($_POST['lang'] == 'lv' || $_POST['lang'] == 'ru') {
   $_SESSION['lang'] = $_POST['lang'];
   echo 1;
} else {
   echo 0;
}