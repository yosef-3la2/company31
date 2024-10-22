<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once 'C:xampp/htdocs/company/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$categoriesquery="SELECT * FROM `categories`";
$category=mysqli_query($con,$categoriesquery);

$message='';
$errors=[];
if(isset($_POST['submit'])){
    $title=filterstring($_POST['title']);
    $description=filterstring($_POST['description']);
    $price=$_POST['price'];
    $category_id=$_POST['category_id'];

    if(stringvalidation($title,4)){
      $errors[]="product title must be atleast 4 characters ";
    }

    if(stringvalidation($description,10)){
      $errors[]="product description must be atleast 10 characters ";
    }

    $realname=$_FILES['image']['name'];
    $tmpname=$_FILES['image']['tmp_name'];
    $imgname=rand(0,100000).time().$realname;
    $imgsize=$_FILES['image']['size'];
    $location='uploads/'.$imgname;

    if(imagevalidation($realname,$imgsize,5)){
      $errors[]="product image is required and must be less than 5 mb";
    }


    if(empty($errors)){
      move_uploaded_file($tmpname,$location); 
      $insertquery="INSERT INTO `products` VALUES(NULL,'$title','$description',$price,$category_id,'$imgname')";
      $insert=mysqli_query($con,$insertquery);
      if($insert){
          $message='Added Successfully';
        }
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
                    <div class="form-group col-mid-6 col-12 mb-2">
                        <label for="title" class="form-label"> title </label>
                        <input type="text" class="form-control" id="title" name="title" />
                    </div>

                    <div class="row">
                        <div class="form-group col-mid-6 col-12 mb-2">
                            <label for="description" class="form-label"> Description </label>
                            <textarea rows='1' type="text" class="form-control" id="description"
                                name="description"></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col-mid-6 col-12 mb-2">
                                <label for="price" class="form-label"> Price </label>
                                <input type="number" class="form-control" id="price" name="price" />
                            </div>

                            <div class="row">
                                <div class="form-group col-mid-6 col-12 mb-2">
                                    <label for="category_id" class="form-label"> Category </label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        <?php foreach($category as $categories):?>
                                        <option value="<?=$categories['id']?>"><?=$categories['category']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                                <div class="form-group col-12 mb-2">
                                    <label for="image" class="form-label"> Product Image </label>
                                    <input type="file" class="form-control" id="image" name="image">
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