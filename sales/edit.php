  <?php
  require_once 'C:xampp/htdocs/db-project/app/configDB.php';
  require_once 'C:xampp/htdocs/db-project/app/functions.php';
  require_once '../shared/header.php';
  require_once '../shared/navbar.php';

  $customerID = '';
  $productID = '';
  $employeeID = '';
  $quantity = '';
  $totalprice = '';

  $message='';
  $messagesuccess='';
  // Get the Sales department ID
  $salesDepartmentQuery = "SELECT id FROM   departments WHERE department = 'Sales'";
  $salesdepartment = $pdo->query($salesDepartmentQuery)->fetch(PDO::FETCH_ASSOC);
  $salesdepartment_id = $salesdepartment['id']; // Get the Sales department ID


  $customersQuery = "SELECT id, name FROM customers";
  $productsQuery = "SELECT id, title FROM products";
  $employeesQuery = "SELECT id, name FROM employees where department_id=$salesdepartment_id";
  $salesdepartment="SELECT id FROM departments WHERE department = 'Sales'";

  $customers = $pdo->query($customersQuery)->fetchAll();
  $products = $pdo->query($productsQuery)->fetchAll();
  $employees = $pdo->query($employeesQuery)->fetchAll();
  $department = $pdo->query($salesdepartment)->fetch();



  if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $selectsale = "SELECT * FROM sales WHERE id = $id";
    $sale = $pdo->prepare($selectsale);
    $sale->execute();
    $row = $sale->fetch(PDO::FETCH_ASSOC);
    $customerID = $row['customerID'];
    $productID = $row['productID'];
    $employeeID = $row['employeeID'];
    $quantity = $row['quantity'];
    $totalprice = $row['totalprice'];

  if (isset($_POST['update'])) {
    $customerID = $_POST['customerID'];
    $productID = $_POST['productID'];
    $employeeID = $_POST['employeeID'];
    $quantity = $_POST['quantity'];
    $totalprice = $_POST['totalprice'];
    
    if ($salesdepartment) {

        $checkEmployeeDepartmentQuery = "SELECT department_id FROM employees WHERE id = $employeeID";
        $selectemployee = $pdo->prepare($checkEmployeeDepartmentQuery);
        $selectemployee->execute();
        $employee=$selectemployee->fetch(PDO::FETCH_ASSOC);
        

        if ($employee) {
                
                $updatequery = "UPDATE  sales set customerID=$customerID, productID=$productID, employeeID=$employeeID, quantity=$quantity, totalprice=$totalprice where id=$id";
                $update = $pdo->prepare($updatequery);
                $update->execute();

                if ($update) {
                    path('');
                } else {
                    $message = 'Failed to add the sale.';
                }
            
        } else {
            $message = 'Employee not found.';
        }
    } else {
        $message = 'Sales department not found.';
    }
  }
  }



  ?>




  <div class="container col-4 pt-5">
      <h2 class="text-center text-light">Update Sale</h2>
      <div class="card border-0">
          <div class="card-body bg-dark text-light">
              <?php if (!empty($messagesuccess)): ?>
                  <div class="alert alert-success"><?= $messagesuccess ?></div>
              <?php endif; ?>
              <?php if (!empty($message)): ?>
                  <div class="alert alert-danger"><?= $message ?></div>
              <?php endif; ?>

              <form method="POST">
                  <div class="form-group col-md-12 mb-2">
                      <label for="employee">Select Employee</label>
                      <select id="employee" name="employeeID" class="form-control">
                          <option value="">Choose an employee</option>
                          <?php foreach ($employees as $employee): ?>
                              <option value="<?= $employee['id'] ?>" <?= $employeeID == $employee['id'] ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($employee['name']) ?>
                              </option>
                          <?php endforeach; ?>
                      </select>
                  </div>

                  <div class="form-group col-md-12 mb-2">
                      <label for="customer">Select Customer</label>
                      <select id="customer" name="customerID" class="form-control">
                          <option value="">Choose a customer</option>
                          <?php foreach ($customers as $customer): ?>
                              <option value="<?= $customer['id'] ?>" <?= $customerID == $customer['id'] ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($customer['name']) ?>
                              </option>
                          <?php endforeach; ?>
                      </select>
                  </div>

                  <div class="form-group col-md-12 mb-2">
                      <label for="product">Select Product</label>
                      <select id="product" name="productID" class="form-control">
                          <option value="">Choose a product</option>
                          <?php foreach ($products as $product): ?>
                              <option value="<?= $product['id'] ?>" <?= $productID == $product['id'] ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($product['title']) ?>
                              </option>
                          <?php endforeach; ?>
                      </select>
                  </div>

                  <div class="form-group col-md-12 mb-2">
                      <label for="quantity">Quantity</label>
                      <input type="number" value="<?= htmlspecialchars($quantity) ?>" id="quantity" name="quantity" class="form-control" required>
                  </div>

                  <div class="form-group col-md-12 mb-2">
                      <label for="totalprice">Total Price</label>
                      <input type="number" value="<?= htmlspecialchars($totalprice) ?>" id="totalprice" name="totalprice" class="form-control" required>
                  </div>

                  <div class="text-center">
                      <button class="btn btn-primary" name="update">Update Sale</button>
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