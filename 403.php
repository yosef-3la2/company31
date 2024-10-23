<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once 'C:xampp/htdocs/company/app/functions.php';
require_once './shared/header.php';
require_once './shared/navbar.php';

auth(2,3)
?>



  <div class="container text-center py-5  text-light">
    <img src="<?= URL('assets/images/403.jpg')?>" alt="" class="img-fluid mb-3">
    <a href="<?= URL('index.php')?>" class="btn btn-info">الصفحة الرئيسية</a>

  </div>

  <?php

require_once './shared/footer.php';
?>

