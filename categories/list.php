<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $delete_product_query="DELETE FROM products WHERE category_id=$id";
    $product_delete=$pdo->prepare($delete_product_query);
    $product_delete->execute();

    $id=$_GET['delete'];
    $delete_cat_query="DELETE FROM categories WHERE id=$id";
    $cat_delete=$pdo->prepare($delete_cat_query);
    $cat_delete->execute();
    
    if($cat_delete && $product_delete){
        path('categories/list.php');
    }
}



$selectquery="SELECT * FROM categories ";
$select=$pdo->prepare($selectquery);
$select->execute();
?>




    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">List All Categories</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>category</th>
                <th>actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- start of row -->
            
            <?php foreach($select as $index => $category): ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $category['category']?></td>
                <td>
                  <a href="edit.php?edit=<?=$category['id']?>" class="btn btn-warning">Edit</a>
                  <a href="?delete=<?=$category['id']?>" name="delete" class="btn btn-danger">Delete</a>
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