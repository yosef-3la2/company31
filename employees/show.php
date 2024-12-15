<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$departmentquery="SELECT * FROM departments";
$departments=$pdo->prepare($departmentquery);
$departments->execute();


if(isset($_GET['show'])){
    $id=$_GET['show'];
    $selectemployee="SELECT * from employees_departments_view WHERE id=$id";
    $emps=$pdo->prepare($selectemployee);
    $emps->execute();
    
    $row = $emps->fetch(PDO::FETCH_ASSOC);
    $name=$row['name'];
    $email=$row['email'];
    $department=$row['department'];
    $address=$row['address'];
    $phone=$row['phone'];

  }


?>


    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">Employee: <?=$row['name']?></h2>
      <div class="card border-0 mx-auto" style="width: 300px;" >
       
      <img src="uploads/<?=$row['image']?>" alt="" class="img-fluid">
       
      <div class="card-body bg-dark text-light">
            <div class="card-title"></div>
            <p>Email: <?=$row['email']?></p>
            <p>department: <?=$row['department']?></p>
            <p>address: <?=$row['address']?></p>
            <p>phone: <?=$row['phone']?></p>
        </div>
      </div>
    </div>


<?php
require_once '../shared/footer.php';

?>