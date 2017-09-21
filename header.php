<?php
session_start();
if (!isset($_SESSION['lang'])) {
   $_SESSION['lang'] = 'lv';
}
$lang = $_SESSION['lang'];
include 'db_con.php';
function setActive($char) {
   global $page;
   if ($char === $page) {
      echo 'class="active"';
   }
}
?>
<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Crochet toys</title>
      <link rel="stylesheet" href="design/maincss.css" type="text/css" />
      <meta content="http://alefers.lv/nika/design/og_image.jpg" property="og:image">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   </head>
   <body>
      <script>
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         ga('create', 'UA-93976471-1', 'auto');
         ga('send', 'pageview');
       </script>
      <div id="main">
         <div id="header">
            <div id="ll_box">
               <img src="design/logo_nika.png" id="logo" onclick="window.location.href = 'index.php'">
               <div id="social">
                 <a href="https://www.facebook.com/crochettoyslv/" id="fb" target="_blank"></a>
                 <a href="https://www.instagram.com/crochettoys_lv/" id="in" target="_blank"></a>
               </div>
               <div id="lang"><div class="lang_chg" data-lang="lv">LAT</div><div class="lang_chg" data-lang="ru">RUS</div></div>
               <div style="clear: both;"></div>
            </div>
            <div id="hdr_menu">
               <a href="index.php"<?php setActive('i');?>><?php if($lang == 'ru') {echo 'КАТАЛОГ';} else {echo 'KATALOGS';}?></a>
               <a href="aboutme.php"<?php setActive('a');?>><?php if($lang == 'ru') {echo 'ОБО МНЕ';} else {echo 'PAR MANI';}?></a>
               <a href="paydelivery.php"<?php setActive('p');?>><?php if($lang == 'ru') {echo 'ОПЛАТА И ДОСТАВКА';} else {echo 'KĀ PASŪTĪT';}?></a>
               <a href="faq.php"<?php setActive('f');?>><?php if($lang == 'ru') {echo 'ВОПРОСЫ И ОТВЕТЫ';} else {echo 'JAUTAJUMI UN ATBILDES';}?></a>
               <a href="contakts.php"<?php setActive('c');?>><?php if($lang == 'ru') {echo 'КОНТАКТЫ';} else {echo 'KONTAKTI';}?></a>
            </div>
            <div class="grey_line gl_txt"></div>
         </div>
         <script>
            $(document).ready(function() {
               $('.gl_txt').html($('.active').html());
            });
            $('.lang_chg').click(function() {
               $.post(
                  "scripts/lang.php",
                  {lang: $(this).data('lang')},
                  function(data) {
                     if (parseInt(data)) {
                        location.reload();
                     }
                  }
               );
            });
         </script>
