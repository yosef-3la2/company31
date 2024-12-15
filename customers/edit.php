<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$departmentquery="SELECT * FROM departments";
$departments=$pdo->prepare($departmentquery);
$departments->execute();

$name='';
$email='';
$department_id='';
$address='';
$phone='';
$errors=[];

if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $selectcustomers = "SELECT * FROM customers WHERE id = $id";
    $customer = $pdo->prepare($selectcustomers);
    $customer->execute();
    $row = $customer->fetch(PDO::FETCH_ASSOC);

    $name=$row['name'];
    $email=$row['email'];
    $address=$row['address'];
    $phone=$row['phone'];
    
    if(isset($_POST['update'])){
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
            $updatequery="UPDATE customers SET name='$name',email='$email',address='$address', phone='$phone' WHERE id=$id";
            $update=$pdo->prepare($updatequery);
            $update->execute(); 
            if($update){
                  path('customers/list.php');
                }  
              }
       }}



?>


    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">Add New Customer</h2>
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
                <label for="address" class="form-label"> Address </label>
                <input
                  type="text"
                  class="form-control"
                  value="<?=$address?>" 
                  id="address"
                  name="address"
                />
              </div>
            
              <div class="col-12 text-center">
                <button class="btn btn-warning" name="update">
                  Update Customer
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