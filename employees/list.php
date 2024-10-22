<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once 'C:xampp/htdocs/company/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $select="SELECT `image` FROM employees where id=$id";
    $selectone=mysqli_query($con,$select);
    $image=mysqli_fetch_assoc($selectone);
    $location="uploads/".$image['image'];
    $deletequery="DELETE FROM `employees` where id=$id";
    $delete=mysqli_query($con,$deletequery);
    if($delete){
      if($image['image']!="fake.webp"){
        unlink($location);}
        path('employees/list.php');
    }
}

$selectquery="SELECT * from `employeeswithdepartments`;";
$select=mysqli_query($con,$selectquery);
$numofrows=mysqli_num_rows($select);
?>

    <div class="container pt-5">
      <h2 class="text-center text-light">List All Employees:<?=$numofrows?></h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>Employee</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <th>department</th>
                <th>actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- start of row -->
               <?php if($numofrows>0):?>
               <?php foreach($select as $index => $employees ):?>
              <tr>
                <td><?= $index+1 ?></td>
                <td><?= $employees['name']?></td>
                <td><?= $employees['email']?></td>
                <td><?= $employees['phone']?></td>
                <td><?= $employees['address']?></td>
                <td><?= $employees['department']?></td>
                <td>
                  <a href="show.php?show=<?=$employees['id']?>" class="btn btn-info">Show</a>
                  <a href="edit.php?edit=<?=$employees['id']?>" class="btn btn-warning">Edit</a>
                  <a href="?delete=<?=$employees['id']?>" name="delete" class="btn btn-danger">Delete</a>
                </td>
                <?php endforeach;?>
            <?php else: ?>
              <tr>
                <td colspan="3" class="text-center">No data to show</td>
              </tr>
            <?php endif;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


<?php
require_once '../shared/footer.php';

?>