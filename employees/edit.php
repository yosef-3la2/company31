<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$departmentquery="SELECT * FROM `departments`";
$departments=mysqli_query($con,$departmentquery);

$name='';
$email='';
$department_id='';
$address='';
$phone='';
$password='';

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $selectemployee="SELECT * FROM `employees` WHERE id=$id";
    $selectone=mysqli_query($con,$selectemployee);
    $row=mysqli_fetch_assoc($selectone);
    $name=$row['name'];
    $email=$row['email'];
    $department_id=$row['department_id'];
    $address=$row['address'];
    $phone=$row['phone'];
    $password=$row['password'];
    if(isset($_POST['update'])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $department_id=$_POST['department_id'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $password=$_POST['password'];
        $updatequery="UPDATE `employees` SET `name`='$name',`email`='$email',`department_id`=$department_id ,`address`='$address', phone='$phone',`password`= '$password' WHERE id=$id";
        $update=mysqli_query($con,$updatequery);
        if($update){
            path('employees/list.php');
          }       
    }


}


?>


    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">Add New Employee</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
          <form method="POST">
            <div class="row">
              <div class="form-group col-md-6 mb-2">
                <label for="name" class="form-label"> Name </label>
                <input type="text" value="<?=$name?>" class="form-control" id="name" name="name" />
              </div>
              <div class="form-group col-md-6 mb-2">
                <label for="email" class="form-label"> Email </label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  value="<?=$email?>" 
                  name="email"
                />
              </div>
              <div class="form-group col-md-6 mb-2">
                <label for="phone" class="form-label"> Phone </label>
                <input
                 value="<?=$phone?>" 
                  type="text"
                  class="form-control"
                  id="phone"
                  name="phone"
                />
              </div>
              <div class="form-group col-md-6 mb-2">
                <label for="password" class="form-label"> Password </label>
                <input
                 value="<?=$password?>" 
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                />
              </div>
              <div class="form-group col-md-6 mb-2">
                <label for="address" class="form-label"> Address </label>
                <input
                  type="text"
                  class="form-control"
                  value="<?=$address?>" 
                  id="address"
                  name="address"
                />
              </div>
              <div class="form-group col-md-6 mb-2">
                <label for="department" class="form-label"> department </label>
                <select
                  name="department_id"
                  id="department"
                  class="form-select"
                >
                <?php foreach($departments as $department): ?>
                <?php if($department_id==$department['id']): ?>
                  <option selected value="<?= $department['id']?>"><?= $department['department']?></option>>
                  <?php else:?>
                    <option value="<?= $department['id']?>"><?= $department['department']?></option>>
                    <?php endif;?>
                  <?php endforeach;?>
                </select>
              </div>
              <div class="col-12 text-center">
                <button class="btn btn-warning" name="update">
                  Update Employee
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

<?php
require_once '../shared/footer.php';

?>