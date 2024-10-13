<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once 'C:xampp/htdocs/company/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$categoriesquery="SELECT * FROM `categories`";
$category=mysqli_query($con,$categoriesquery);

// $category='';
// if(isset($_GET['edit'])){
//   $id=$_GET['edit'];
//   $select="SELECT * FROM `categories` where id= $id";
//   $selectone=mysqli_query($con,$select);
//   $row=mysqli_fetch_assoc($selectone);
//   $category=$row['category'];
//   if(isset($_POST['category'])){
//     $category=$_POST['category'];
//     $updatequery="UPDATE categories set category='$category' where id=$id";
//     $update=mysqli_query($con,$updatequery);
//     if($update){
//       path('categories/list.php');
//     }
//   }
// }
$title='';
$description='';
$price='';
$category_id='';

if(isset($_GET['edit'])){
  $id=$_GET['edit'];
  $select="SELECT * FROM products where id=$id";
  $selectone=mysqli_query($con,$select);
  $row=mysqli_fetch_assoc($selectone);
  $title=$row['title'];
  $description=$row['description'];
  $price=$row['price'];
  $category_id=$row['category_id'];
  if(isset($_POST['update'])){

    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category_id=$_POST['category_id'];
    $updatequery="UPDATE products set title='$title',`description`='$description',price=$price,category_id=$category_id where id=$id";
    $update=mysqli_query($con,$updatequery);
    if($update){
      path('products/list.php');
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
        <div class="card-body bg-dark text-light">
        <?php if(!empty($message)):?>
          <div class="alert alert-success">
            <p class="fs-4 mb-0"><?=$message ?></p>
          </div>
          <?php endif; ?>
          <form method="POST">
            <div class="form-group  mb-2">
              <label for="title" class="form-label"> title </label>
              <input
                value="<?=$title?>"
                type="text"
                class="form-control"
                id="title"
                name="title"
              />
            </div>
          </div>
          <div class="form-group  mb-2">
            <label for="description" class="form-label"> description </label>
            <input
              value="<?=$description?>"
              type="text"
              class="form-control"
              id="description"
              name="description"
            />
            <div class="form-group  mb-2">
              <label for="price" class="form-label"> price </label>
              <input
                value="<?=$price?>"
                type="text"
                class="form-control"
                id="price"
                name="price"
              />
            </div>
            <div class="form-group  mb-2">
            <label for="category_id" class="form-label"> Category </label>
              <select name="category_id" id="category_id" class="form-select">
                <?php foreach($category as $categories):?>
                  <?php if($category_id==$categories['id']):?>
                <option selected value="<?=$categories['id']?>"><?=$categories['category']?></option>
                <?php else:?>
                <option value="<?=$categories['id']?>"><?=$categories['category']?></option>
                <?php endif;?>
                <?php endforeach;?>
              </select>
            </div>
            <div class="text-center">
              <button class="btn btn-warning" name="update">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


<?php
require_once '../shared/footer.php';

?>