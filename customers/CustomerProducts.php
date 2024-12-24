<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';




if(isset($_GET['customer_id'])){
$id=$_GET['customer_id'];
$customer=$_GET['customer'];
$selectquery="SELECT * FROM CustomerProducts where customer_id=$id";
$select=$pdo->prepare($selectquery);
$select->execute(); 

}


?>




    <div class="container col-9 pt-5">
      <div class="card border-0">
          <div class="card-body bg-dark text-light">        
            <h2 class="text-center">All purchases of <?=$customer?></h2>
          
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Price</th>

              </tr>
            </thead>
            <tbody>
              <!-- start of row -->
            
            <?php foreach($select as $index => $purchase): ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $purchase['ProductName']?></td>
                <td><?= $purchase['Quantity']?></td>
                <td><?= $purchase['TotalPrice']?></td>
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