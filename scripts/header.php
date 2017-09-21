<?php
session_start();
if (!isset($_SESSION['lang'])) {
   $_SESSION['lang'] = 'lv';
}
$lang = $_SESSION['lang'];
include 'db_con.php';
function setActive($pageName) {
   global $page;
   if ($pageName === $page) {
      echo 'class="active"';
   }
}
?>
<!doctype html>
<html lang="<?php echo $lang; ?>">
  <head>
    <meta charset="utf-8">
    <title>Crochet toys</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="design/<?php echo $page;?>.css" type="text/css" />
    <meta content="http://alefers.lv/nika/design/og_image.jpg" property="og:image">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-93976471-1', 'auto');
      ga('send', 'pageview');
    </script>
  </head>
  <body>
    <div class="wrapper">
      <header class="header">
        <img src="design/logo_nika.png" class="logo" onclick="window.location.href = 'index.php'" alt="logo">
        <div class="social-lang-box">
          <div class="social">
            <a href="https://www.facebook.com/crochettoyslv/" class="fb" target="_blank"></a>
            <a href="https://www.instagram.com/crochettoys_lv/" class="in" target="_blank"></a></div>
          <div class="lang">
            <div class="lang_chg" data-lang="lv">LAT</div>
            <div class="lang_chg" data-lang="ru">RUS</div>
          </div>
        </div>
        <nav class="nav">
          <a href="index.php"<?php setActive('index');?>><?php if($lang == 'ru') {echo 'КАТАЛОГ';} else {echo 'KATALOGS';}?></a>
          <a href="aboutme.php"<?php setActive('abme');?>><?php if($lang == 'ru') {echo 'ОБО МНЕ';} else {echo 'PAR MANI';}?></a>
          <a href="paydelivery.php"<?php setActive('paydelivery');?>><?php if($lang == 'ru') {echo 'ОПЛАТА И ДОСТАВКА';} else {echo 'KĀ PASŪTĪT';}?></a>
          <a href="faq.php"<?php setActive('faq');?>><?php if($lang == 'ru') {echo 'ВОПРОСЫ И ОТВЕТЫ';} else {echo 'JAUTAJUMI UN ATBILDES';}?></a>
          <a href="contacts.php"<?php setActive('contacts');?>><?php if($lang == 'ru') {echo 'КОНТАКТЫ';} else {echo 'KONTAKTI';}?></a>
        </nav>
      </header>
      <div class="after-hdr-linegrey"></div>
      <script>
$(document).ready(function() {
  $('.after-hdr-linegrey').html('<span>' + $('.active').html() + '</span>');
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
