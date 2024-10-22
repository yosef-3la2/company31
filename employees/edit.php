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
$errors=[];

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
        $name=filterstring($_POST['name']);
        $email=filterstring($_POST['email']);
        $department_id=$_POST['department_id'];
        $address=filterstring($_POST['address']);
        $phone=filterstring($_POST['phone']);
        $password=$_POST['password'];

        if(stringvalidation($name,4)){
          $errors[]="Employee name must be more than 4 characters";
        }
        
        if(stringvalidation($email,0)){
          $errors[]="Employee must enter an email";
        }
        
        if(stringvalidation($address,10)){
          $errors[]="Employee must enter an address";
        }
        
        if(stringvalidation($phone,11)){
          $errors[]="phone must be more than 10 digits";
        }

          $realname=$_FILES['image']['name'];
          $imagesize=$_FILES['image']['size'];
          $imgname="company31.com_".rand(0,30000)."_".time()."_".$realname;
          $tmpname=$_FILES['image']['tmp_name'];
          $location='uploads/'.$imgname;
          $oldimage='uploads/'.$row['image'];
          if($row['image']!='fake.webp') 
          {
          unlink($oldimage);
          }
          move_uploaded_file($tmpname,$location);
          if(imagevalidation($realname,$iamgesize,5)){
            $errors[]="Employee must enter an image and size must be less than 5 mb";
          }
          if(empty($errors)){
            $updatequery="UPDATE `employees` SET `name`='$name',`email`='$email',`department_id`=$department_id ,`address`='$address', phone='$phone',`password`= '$password',`image`='$imgname' WHERE id=$id";
            $update=mysqli_query($con,$updatequery);
            if($update){
                path('employees/list.php');
              }  
            }
       }


}


?>


    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">Add New Employee</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
        <?php if(!empty($errors)):?>
          <div class="alert alert-danger">
          <ul>
            <?php foreach($errors as $error): ?>
              <li><?=$error?></li>
            <?php endforeach;?>
          </ul>
        </div>
          <?php endif;?>
          <form method="POST" enctype="multipart/form-data">
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
                <div class="form-group col-12 mb-2">
                <label for="image" class="form-label"> Employee Image </label>
                <input
                  type="file"
                  class="form-control mb-1"
                  id="image"
                  name="image">
                  <img width="150" src="uploads/<?= $row['image']?>" alt="">
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