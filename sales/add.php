<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once 'C:xampp/htdocs/db-project/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';


$message='';
$messagesuccess='';
// Get the Sales department ID
$salesDepartmentQuery = "SELECT id FROM departments WHERE department = 'Sales'";
$salesdepartment = $pdo->query($salesDepartmentQuery)->fetch(PDO::FETCH_ASSOC);
$salesdepartment_id = $salesdepartment['id']; // Get the Sales department ID


$customersQuery = "SELECT id, name FROM customers";
$productsQuery = "SELECT id, title FROM products";
$employeesQuery = "SELECT id, name FROM employees";
// $employeesQuery = "SELECT id, name FROM employees where department_id=$salesdepartment_id";


$customers = $pdo->query($customersQuery)->fetchAll();
$products = $pdo->query($productsQuery)->fetchAll();
$employees = $pdo->query($employeesQuery)->fetchAll();
$department = $pdo->query($salesDepartmentQuery)->fetch();


if (isset($_POST['submit'])) {
  $customerID = $_POST['customer'];
  $productID = $_POST['product'];
  $employeeID = $_POST['employee'];
  $quantity = $_POST['quantity'];
  $totalprice = $_POST['totalprice'];



  $checkEmployeeDepartmentQuery = "SELECT department_id FROM employees WHERE id = $employeeID";
  $employee = $pdo->query($checkEmployeeDepartmentQuery)->fetch(PDO::FETCH_ASSOC);
  $insertquery = "INSERT INTO sales (customerID, productID, employeeID, quantity, totalprice) 
                  VALUES ($customerID, $productID, $employeeID, $quantity, $totalprice)";
  $insert = $pdo->prepare($insertquery);
  $insert->execute();

  if ($insert) {
      $messagesuccess = 'Sale added successfully';
  } else {
      $message = 'Failed to add the sale.';
  }
}


?>





    <div class="container col-4 pt-5">
      <h2 class="text-center text-light">Add New Sale</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
          <!-- Start Of Event -->
        <?php if(!empty($messagesuccess)):?>
          <div class="alert alert-success">
            <p class="fs-4 mb-0"><?=$messagesuccess ?></p>
          </div>
          <?php endif;?>
        <?php if(!empty($message)):?>
          <div class="alert alert-danger">
            <p class="fs-4 mb-0"><?=$message ?></p>
          </div>
          <?php endif;?>
        


          <form method="POST" enctype="multipart/form-data">
            
          <div class="form-group col-md-12 mb-2">
            <label for="employee">Select Employee</label>
            <select id="employee" name="employee" style="width: 100%">
              <option value="">Choose an employee</option>
              <?php foreach ($employees as $employee): ?>
                
                <option value="<?= $employee['id'] ?>"><?= $employee['name'] ?></option>
              <?php endforeach; ?>
            </select>
            </div>
          
            <div class="form-group col-md-12 mb-2">
                <label for="customer">Select Customer</label>
                <select id="customer" name="customer" style="width: 100%">
                  <option value="">Choose a customer</option>
                  <?php foreach ($customers as $customer): ?>
                    <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>


              <div class="form-group col-md-12 mb-2">
                  <label for="product">Select Product</label>
                    <select id="product" name="product" style="width: 100%">
                      <option value="">Choose a product</option>
                      <?php foreach ($products as $product): ?>
                        <option value="<?= $product['id'] ?>"><?= $product['title'] ?></option>
                      <?php endforeach; ?>
                    </select>
              </div>



              <div class="form-group col-md-12 mb-2">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" required>
              </div>

              <div class="form-group col-md-12 mb-2">
                <label for="totalprice">Total Price</label>
                <input type="number" id="totalprice" name="totalprice" required>
              </div>

              <div class="col-12 text-center">
                <button class="btn btn-primary" name="submit">
                  Add Sale
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
    $(document).ready(function() {
      // Initialize Select2 on each of the select elements
      $('#customer').select2({
        placeholder: "Search for a customer",
        allowClear: true
      });
      
      $('#product').select2({
        placeholder: "Search for a product",
        allowClear: true
      });
      
      $('#employee').select2({
        placeholder: "Search for an employee",
        allowClear: true
      });
    });
  </script>

<?php
require_once '../shared/footer.php';

?>