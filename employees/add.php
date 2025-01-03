<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once 'C:xampp/htdocs/db-project/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$departmentquery="SELECT * FROM departments";
$departments=$pdo->prepare($departmentquery);
$departments->execute();
$errors=[];
$message='';
$imgname='fake.webp';
if(isset($_POST['submit'])){
$name=filterstring($_POST['name']);
$email=filterstring($_POST['email']);
$department_id=$_POST['department_id'];
$address=filterstring($_POST['address']);
$phone=filterstring($_POST['phone']);
$password=sha1($_POST['password']);


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


if(!empty($_FILES['image']['name'])){
$realname=$_FILES['image']['name'];
$imgname="db-project31.com_".rand(0,30000)."_".time()."_".$realname;
$tmpname=$_FILES['image']['tmp_name'];
$location='uploads/'.$imgname;
move_uploaded_file($tmpname,$location);
}else{
  $imgname='fake.webp';
}




if(empty($errors)){
$insertquery="INSERT INTO employees(name,email,department_id,address,phone,password,image) values('$name','$email',$department_id,'$address','$phone','$password','$imgname')";
$insert=$pdo->prepare($insertquery);
$insert->execute();
if($insert){
    $message='Employee added successfully';
}
}
}

?>


    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">Add New Employee</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
          <!-- Start Of Event -->
        <?php if(!empty($message)):?>
          <div class="alert alert-success">
            <p class="fs-4 mb-0"><?=$message ?></p>
          </div>
          <?php endif;?>
        <?php if(!empty($errors)):?>
          <div class="alert alert-danger">
          <ul>
            <?php foreach($errors as $error): ?>
              <li><?=$error?></li>
            <?php endforeach;?>
          </ul>
        </div>
          <?php endif;?>
          <!-- End of Event -->
          <form method="POST" enctype="multipart/form-data">
            <div class="row">
              <div class="form-group col-md-6 mb-2">
                <label for="name" class="form-label"> Name </label>
                <input type="text" class="form-control" id="name" name="name" />
              </div>
              <div class="form-group col-md-6 mb-2">
                <label for="email" class="form-label"> Email </label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                />
              </div>
              <div class="form-group col-md-6 mb-2">
                <label for="phone" class="form-label"> Phone </label>
                <input
                  type="text"
                  class="form-control"
                  id="phone"
                  name="phone"
                />
              </div>
              <div class="form-group col-md-6 mb-2">
                <label for="password" class="form-label"> Password </label>
                <input
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
                  <option value="<?= $department['id']?>"><?= $department['department']?></option>>
                  <?php endforeach;?>
                </select>
              </div>
             
                <div class="form-group col-12 mb-2">
                <label for="image" class="form-label"> Employee Image </label>
                <input
                  type="file"
                  class="form-control"
                  id="image"
                  name="image">
                </div>
            
              <div class="col-12 text-center">
                <button class="btn btn-primary" name="submit">
                  Add Employee
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