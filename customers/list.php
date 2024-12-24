<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once 'C:xampp/htdocs/db-project/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

$salesquery = "SELECT id,customerid FROM Sales  ";
$sales = $pdo->prepare($salesquery);
$sales->execute();

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    

    // $delete_sales_query="DELETE FROM sales where customerid=$id";
    // $sale_delete=$pdo->prepare($delete_sales_query);
    // $sale_delete->execute();
    $delete_customer_query="DELETE FROM customers where id=$id";
    $customer_delete=$pdo->prepare($delete_customer_query);
    $customer_delete->execute();
    
}

$selectquery="SELECT * from customers ";
$select=$pdo->prepare($selectquery);
$select->execute();
?>

    <div class="container pt-5">
      <h2 class="text-center text-light">List All Customers:</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>Customers</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <th>actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- start of row -->
               <?php foreach($select as $index => $customers ):?>
              <tr>
                <td><?= $index+1 ?></td>
                <td><a class="text-reset" href="CustomerProducts.php?customer_id=<?= $customers['id'] ?>&customer=<?=$customers['name']?>"><?=$customers['name']?></a></td>
                <td><?= $customers['email']?></td>
                <td><?= $customers['phone']?></td>
                <td><?= $customers['address']?></td>
                <td>
                  <a href="edit.php?edit=<?=$customers['id']?>" class="btn btn-warning">Edit</a>
                  <a href="?delete=<?=$customers['id']?>" name="delete" class="btn btn-danger">Delete</a>
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