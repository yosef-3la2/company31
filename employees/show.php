<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$departmentquery="SELECT * FROM `departments`";
$departments=mysqli_query($con,$departmentquery);


if(isset($_GET['show'])){
    $id=$_GET['show'];
    $selectemployee="SELECT * FROM `employees` WHERE id=$id";
    $selectone=mysqli_query($con,$selectemployee);
    $row=mysqli_fetch_assoc($selectone);
    $name=$row['name'];
    $email=$row['email'];
    $department_id=$row['department_id'];
    $address=$row['address'];
    $phone=$row['phone'];
    $password=$row['password'];


}


?>


    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">Employee:<?=$row['name']?></h2>
      <div class="card border-0 mx-auto" style="width: 300px;" >
      <img src="https://static.vecteezy.com/system/resources/previews/020/120/848/original/user-icon-fake-photo-sign-profile-button-simple-style-social-media-poster-background-symbol-user-brand-logo-design-element-user-t-shirt-printing-for-sticker-free-vector.jpg " alt="" class="img-fluid">
        <div class="card-body bg-dark text-light">
            <div class="card-title"></div>
            <p>Email: <?=$row['email']?></p>
            <p>department_id: <?=$row['department_id']?></p>
            <p>address: <?=$row['address']?></p>
            <p>phone: <?=$row['phone']?></p>
        </div>
      </div>
    </div>

<?php
require_once '../shared/footer.php';

?>