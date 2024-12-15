<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once './shared/header.php';
require_once './shared/navbar.php';




$message='';
if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $deletequery="DELETE FROM sales WHERE id=$id";
    $delete=$pdo->prepare($deletequery);
    $delete->execute(); 
    if($delete){
        path('');
    }
}

$selectquery="SELECT * FROM  sales_data ";
$search='';
if(isset($_GET['search'])){
$search=$_GET['search'];
$selectquery="SELECT * FROM sales where title like '%$search%' or description like '%$search%'";

}

$selectquery="SELECT * FROM  sales_data ";
$search='';
if(isset($_GET['search'])){
$search=$_GET['search'];
$selectquery="SELECT * FROM sales_data where CustomerName like '%$search%' or ProductTitle like '%$search%'";

}


$select=$pdo->prepare($selectquery);
$select->execute(); 



?>

<div class="container">
  <h1 class="display-1 text-center">Welcome to our market</h1>
</div>

<div class="container ">
  <h1 class=" text-light">Sales</h1>


</div>

<div class="container col-10 pt-5">
  <h2 class="text-center text-light">List All The Sales</h2>
  <div class="card border-0">

    <div class="card-body bg-dark text-light">        
      <form>
      <div class="input-group">
      <input placeholder="search by customerName or Product" value="<?=$search?>" type="text" name="search" class="form-control form-control-lg">
      <button class="btn btn-secondary">search</button>
      <a href="<?=URL('sales/add.php')?>"class="btn btn-primary">Add new sale</a>
      <?php if(!empty($search)):?>
      <a href=<?=URL('')?> class="btn btn-secondary">cancel</a>
      <?php endif;?>
      </div>
      <div>
    </div>
    </form>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Product Title</th>
            <th>Employee Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Sale Date</th>
            <th>actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- start of row -->
      
        <?php foreach($select as $index => $sales): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $sales['CustomerName']?></td>
            <td><?= $sales['ProductTitle']?></td>
            <td><?= $sales['EmployeeName']?></td>
            <td><?= $sales['quantity']?></td>
            <td><?= $sales['totalprice']?></td>
            <td><?= $sales['saledate']?></td>
            <td>
              
              <a href="sales/edit.php?edit=<?=$sales['id']?>" class="btn btn-warning">Edit</a> 
              <a href="?delete=<?=$sales['id']?>" name="delete" class="btn btn-danger">Delete</a>
              
            </td> 
          </tr>
        <?php endforeach;?>
        
        </tbody>
      </table>
    </div>
  </div>
</div>




<?php

require_once './shared/footer.php';
?>


