<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $deletequery="DELETE FROM `products` WHERE id=$id";
    $delete=mysqli_query($con,$deletequery);
    if($delete){
        path('products/list.php');
    }
}

$selectquery="SELECT * FROM `productswithcategories2` ";
$search='';
if(isset($_GET['search'])){
$search=$_GET['search'];
$selectquery="SELECT * FROM productswithcategories2 where title like '%$search%' or `description` like '%$search%'";

}



$select=mysqli_query($con,$selectquery);


$numofrows=mysqli_num_rows($select);
?>




    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">List All Products</h2>
      <div class="card border-0">

        <div class="card-body bg-dark text-light">        
          <form>
          <div class="input-group">
          <input placeholder="search" value="<?=$search?>" type="text" name="search" class="form-control form-control-lg">
          <button class="btn btn-info">search</button>
          <?php if(!empty($search)):?>
          <a href=<?=URL('products/list.php')?> class="btn btn-secondary">cancel</a>
          <?php endif;?>
        </div>
        </form>
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>title</th>
                <th>description</th>
                <th>price</th>
                <th>category</th>
                <th>actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- start of row -->
            <?php if ( $numofrows> 0) :?>
            <?php foreach($select as $index => $product): ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $product['title']?></td>
                <td><?= $product['description']?></td>
                <td><?= $product['price']?></td>
                <td><a class="text-reset" href="product_categories.php?category_id=<?= $product['cat_id'] ?>&category=<?=$product['category']?>"><?=$product['category']?></a></td>
                <td>
                  <a href="edit.php?edit=<?=$product['id']?>" class="btn btn-warning">Edit</a>
                  <a href="?delete=<?=$product['id']?>" name="delete" class="btn btn-danger">Delete</a>
                </td> 
              </tr>
            <?php endforeach;?>
            <?php else: ?>
              <tr>
                <td colspan="3" class="text-center">No data to show</td>
              </tr>
            <?php endif;?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    

<?php
require_once '../shared/footer.php';

?>