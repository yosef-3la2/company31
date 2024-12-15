<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$message='';
if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $delete_sale_query="DELETE FROM sales WHERE productID=$id";
    $delete_s=$pdo->prepare($delete_sale_query);
    $delete_s->execute(); 
    $deletequery="DELETE FROM products WHERE id=$id";
    $delete=$pdo->prepare($deletequery);
    $delete->execute(); 
    

      if($delete&&$delete_s){
        path('products/list.php');
      }
    
}

$selectquery="SELECT * FROM  products_categories_view ";
$search='';
if(isset($_GET['search'])){
$search=$_GET['search'];
$selectquery="SELECT * FROM products_categories_view where title like '%$search%' or description like '%$search%'";

}

if(isset($_GET['asc'])){
  if(!isset($_GET['orderBy'])){
      $message="please select a column to order by";
  }
  else{
      $order=$_GET['orderBy'];
      $selectquery="SELECT * FROM products_categories_view ORDER BY $order ASC";

  }

}

if(isset($_GET['desc'])){
  if(!isset($_GET['orderBy'])){
      $message="please select a column to order by";
  }
  else{
      $order=$_GET['orderBy'];
      $selectquery="SELECT * FROM products_categories_view ORDER BY $order DESC";

  }

}

$select=$pdo->prepare($selectquery);
$select->execute(); 



?>




    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">List All Products</h2>
      <div class="card border-0">

        <div class="card-body bg-dark text-light">        
          <form>
          <div class="input-group">
          <input placeholder="search by title or description" value="<?=$search?>" type="text" name="search" class="form-control form-control-lg">
          <button class="btn btn-info">search</button>
          <?php if(!empty($search)):?>
          <a href=<?=URL('products/list.php')?> class="btn btn-secondary">cancel</a>
          <?php endif;?>
          </div>
          <div>
            <form>
              <div class="row align-items-center">
                <div class="col-md-8 mb-3">
                  <div>
                    <label class="mb-2" for="orderBy">Order By</label>
                  </div>
                  <select name="orderBy" id="orderBy" class="form-select">
                    <option disabled selected>Choose...</option>
                    <option value="title">title</option>
                    <option value="price">price</option>
                  </select>
                </div>
                <div class="col-md-6 mb-1">
                  <button class="btn btn-info" name="asc">Ascending</button>
                  <button class="btn btn-info" name="desc">Descending</button>
                  <a href=<?=URL('products/list.php')?> class="btn btn-secondary">cancel</a>
                </div>
                
                <h5 class="text-danger"><?=$message?></h5>
          </form>
        </div>
        </form>
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>title</th>
                <th>image</th>
                <th>description</th>
                <th>price</th>
                <th>category</th>
                <th>actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- start of row -->
          
            <?php foreach($select as $index => $product): ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $product['title']?></td>
                <td><img width="50" src="uploads/<?= $product['image']?>" alt=""></td>
                <td><?= $product['description']?></td>
                <td><?= $product['price']?></td>
                <td><a class="text-reset" href="product_categories.php?category_id=<?= $product['category_id'] ?>&category=<?=$product['category']?>"><?=$product['category']?></a></td>
                <td>
                  <a href="edit.php?edit=<?=$product['id']?>" class="btn btn-warning">Edit</a> 
                  <a href="?delete=<?=$product['id']?>" name="delete" class="btn btn-danger">Delete</a>
                 
                </td> 
              </tr>
            <?php endforeach;?>
           
            </tbody>
          </table>
        </div>
      </div>
    </div>


    

<?php
require_once '../shared/footer.php';

?>








