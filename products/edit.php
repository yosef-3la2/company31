<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once 'C:xampp/htdocs/db-project/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$categoriesquery="SELECT * FROM categories";
$category=$pdo->prepare($categoriesquery);
$category->execute();

$title='';
$description='';
$price='';
$category_id='';
$image='';
$errors=[];
if(isset($_GET['edit'])){
  $id=$_GET['edit'];
  $selectquery="SELECT * FROM products where id=$id";
  $cats = $pdo->query($selectquery);
  $row = $cats->fetch(PDO::FETCH_ASSOC);
  $title=$row['title'];
  $description=$row['description'];
  $price=$row['price'];
  $category_id=$row['category_id'];
  $image=$row['image'];
  if(isset($_POST['update'])){
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


    if ($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE) {
           
      $imgname = $row['image'];
      } else {
        $realname=$_FILES['image']['name'];
        $tmpname=$_FILES['image']['tmp_name'];
        $imgname=rand(0,100000).time().$realname;
        $imgsize=$_FILES['image']['size'];
        $location='uploads/'.$imgname;
        move_uploaded_file($tmpname,$location);

      }



    if(empty($errors)){
      $updatequery="UPDATE products set title='$title',description='$description',price=$price,category_id=$category_id,image='$imgname' where id=$id";
      $update=$pdo->prepare($updatequery);
      $update->execute(); 
      if($update){
        path('products/list.php');
      }
    }

    
  }
}

?>

<div class="container col-6 pt-5">
    <h2 class="text-center text-ligh t">Update Product</h2>
    <div class="card border-0">
        <div class="card-body bg-dark text-light">
            <form method="POST" enctype="multipart/form-data">
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
                                <input value="<?=$title?>" type="text" class="form-control" id="title" name="title" />
                            </div>
                    </div>
                    <div class="form-group  mb-2">
                        <label for="description" class="form-label"> description </label>
                        <textarea rows='1' type="text" class="form-control" id="description"
                            name="description"><?= $description?></textarea>
                        <div class="form-group  mb-2">
                            <label for="price" class="form-label"> price </label>
                            <input value="<?=$price?>" type="text" class="form-control" id="price" name="price" />
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

                            <div class="form-group col-12 mb-2">
                                <label for="image" class="form-label"> Product Image </label>
                                <input type="file" class="form-control mb-1" id="image" name="image">
                                <img width="150" src="uploads/<?= $row['image']?>" alt="">
                            </div>
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