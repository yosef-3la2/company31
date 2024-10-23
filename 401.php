<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once 'C:xampp/htdocs/company/app/functions.php';
require_once './shared/header.php';
require_once './shared/navbar.php';

?>


  <div class="container text-center py-5  text-light">
    <img src="<?= URL('assets/images/401.jpg')?>" alt="" class="img-fluid mb-3">
    <div>
      <a href="<?= URL('login.php')?>" class="btn btn-info">تسجيل الدخول</a>
    </div>
  
  </div>

  <?php
require_once './shared/footer.php';

?>