<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once 'C:xampp/htdocs/db-project/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';


$errors=[];
$message='';
if(isset($_POST['submit'])){
$name=filterstring($_POST['name']);
$email=filterstring($_POST['email']);
$address=filterstring($_POST['address']);
$phone=filterstring($_POST['phone']);


if(stringvalidation($name,4)){
  $errors[]="Customer name must be more than 4 characters";
}

if(stringvalidation($email,0)){
  $errors[]="Customer must enter an email";
}

if(stringvalidation($address,10)){
  $errors[]="Customer must enter an address";
}

if(stringvalidation($phone,11)){
  $errors[]="phone must be more than 10 digits";
}



if(empty($errors)){
  
$insertquery="INSERT INTO customers(name,email,address,phone) values('$name','$email','$address','$phone')";
$insert=$pdo->prepare($insertquery);
$insert->execute();
if($insert){
    $message='Customer added successfully';
}
}
}

?>


    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">Add New Customer</h2>
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
                <label for="address" class="form-label"> Address </label>
                <input
                  type="text"
                  class="form-control"
                  id="address"
                  name="address"
                />
              </div>
                <div class="col-12 text-center">
                <button class="btn btn-primary" name="submit">
                  Add Customer
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