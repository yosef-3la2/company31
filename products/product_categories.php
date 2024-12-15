<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';



if(isset($_GET['category_id'])){
$id=$_GET['category_id'];
$category=$_GET['category'];
$selectquery="SELECT * FROM products_categories_view where category_id=$id";
$select=$pdo->prepare($selectquery);
$select->execute(); 

}


?>




    <div class="container col-6 pt-5">
      <div class="card border-0">
          <div class="card-body bg-dark text-light">        
            <h2 class="text-center">All products of '<?=$category?>' category</h2>
          
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>title</th>
                <th>image</th>
                <th>description</th>
                <th>price</th>
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