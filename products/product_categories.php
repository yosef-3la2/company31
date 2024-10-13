<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';




if(isset($_GET['category_id'])){
$id=$_GET['category_id'];
$category=$_GET['category'];
$selectquery="SELECT * FROM productswithcategories2 where cat_id=$id";
$select=mysqli_query($con,$selectquery);
$numofrows=mysqli_num_rows($select);
}


?>




    <div class="container col-6 pt-5">
      <div class="card border-0">
          <div class="card-body bg-dark text-light">        
            <h2 class="text-center">All products of this category: <?=$category?></h2>
          
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>title</th>
                <th>description</th>
                <th>price</th>
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