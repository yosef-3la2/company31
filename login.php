<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once 'C:xampp/htdocs/company/app/functions.php';
require_once './shared/header.php';
require_once './shared/navbar.php';

$error='';
if(isset($_POST['signin'])){
    $email=$_POST['email'];
    $password=sha1($_POST['password']);
    $searchquery="SELECT * FROM `employees` WHERE email='$email' and `password`='$password'";
    $search=mysqli_query($con,$searchquery);
    if(mysqli_num_rows($search)==1){
        $emp=mysqli_fetch_assoc($search);
        $_SESSION['employee']=[
          'id' => $emp['id'],
          'name' => $emp['name'],
          'email' => $emp['email'],
          'image' => $emp['image'],
          'phone' => $emp['phone'],
          'address' => $emp['address'],
          'department_id' => $emp['department_id']
        ];
        path('');
    }else{
        $error='data not found'; 
    }
    
}
?>




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card bg-secondary text-light shadow">
            <?php if(!empty($error)):?>
          <div class="alert alert-danger">
            <p class="fs-4 mb-0"><?=$error ?></p>
          </div>
          <?php endif;?>
            <h3 class="text-center mb-4">Sign In</h3>
          <div class="card-body">
            <form method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control bg-dark text-light border-0" id="email" placeholder="Enter email" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control bg-dark text-light border-0" id="password" placeholder="Enter password" required>
              </div>

              <button type="submit" class="btn btn-primary w-100" name="signin">Sign In</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
require_once './shared/footer.php';

?>