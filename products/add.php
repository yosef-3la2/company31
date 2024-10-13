<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$categoriesquery="SELECT * FROM `categories`";
$category=mysqli_query($con,$categoriesquery);

$message='';
if(isset($_POST['submit'])){
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $category_id=$_POST['category_id'];
    $insertquery="INSERT INTO `products` VALUES(NULL,'$title','$description',$price,$category_id)";
    $insert=mysqli_query($con,$insertquery);
if($insert){
    $message='Added Successfully';
}
}

?>

    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">Add New Product</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
        <?php if(!empty($message)):?>
          <div class="alert alert-success">
            <p class="fs-4 mb-0"><?=$message ?></p>
          </div>
          <?php endif; ?>
          <form method="POST">
            <div class="row"><div class="form-group col-mid-6 col-12 mb-2">
              <label for="title" class="form-label"> title </label>
              <input
                type="text"
                class="form-control"
                id="title"
                name="title"
              />
            </div>
            <div class="row"><div class="form-group col-mid-6 col-12 mb-2">
              <label for="description" class="form-label"> Description </label>
              <textarea
                rows='1'
                type="text"
                class="form-control"
                id="description"
                name="description"
              ></textarea>
            </div>
            <div class="row"><div class="form-group col-mid-6 col-12 mb-2">
              <label for="price" class="form-label"> Price </label>
              <input
                type="text"
                class="form-control"
                id="price"
                name="price"
              />
            </div>
            <div class="row"><div class="form-group col-mid-6 col-12 mb-2">
              <label for="category_id" class="form-label"> Category </label>
              <select name="category_id" id="category_id" class="form-select">
                <?php foreach($category as $categories):?>
                <option value="<?=$categories['id']?>"><?=$categories['category']?></option>
                <?php endforeach;?>
              </select>
            </div>
            <div class="text-center">
              <button class="btn btn-primary" name="submit">Add Product</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>



<?php
require_once '../shared/footer.php';

?>