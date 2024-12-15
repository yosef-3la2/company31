<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once 'C:xampp/htdocs/db-project/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$category='';
if(isset($_GET['edit'])){
  $id=$_GET['edit'];
  $selectquery="SELECT * FROM categories where id= $id";
  $cats = $pdo->query($selectquery);
  $row = $cats->fetch(PDO::FETCH_ASSOC);
  $category=$row['category'];
  if(isset($_POST['category'])){
    $category=$_POST['category'];
    $updatequery="UPDATE categories set category='$category' where id=$id";
    $update=$pdo->prepare($updatequery);
    $update->execute(); 
    if($update){
      path('categories/list.php');
    }
  }
}




?>

    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">Update Category</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
        <?php if(!empty($message)):?>
          <div class="alert alert-success">
            <p class="fs-4 mb-0"><?=$message ?></p>
          </div>
          <?php endif; ?>
          <form method="POST">
            <div class="form-group mb-2">
              <label for="category" class="form-label"> Category </label>
              <input
                value="<?=$category?>"
                type="text"
                class="form-control"
                id="category"
                name="category"
              />
            </div>
            <div class="text-center">
              <button class="btn btn-warning">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>



<?php
require_once '../shared/footer.php';

?>