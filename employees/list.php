<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once 'C:xampp/htdocs/db-project/app/functions.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $select="SELECT image FROM employees where id= :id";
    $img = $pdo->prepare($select);
    $img->execute([':id' => $id]);
    $image = $img->fetch(PDO::FETCH_ASSOC);

    $location="uploads/".$image['image'];
    $deletequery="DELETE FROM employees where id=$id";
    $emp_delete=$pdo->prepare($deletequery);
    $emp_delete->execute();
    if($emp_delete){
        path('employees/list.php');
    }
}

$selectquery="SELECT * from employees_departments_view  ";
$select=$pdo->prepare($selectquery);
$select->execute();
?>

    <div class="container pt-5">
      <h2 class="text-center text-light">List All Employees:</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>Employee</th>
                <th>email</th>
                <th>phone</th>
                <th>address</th>
                <th>department</th>
                <th>actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- start of row -->
               <?php foreach($select as $index => $employees ):?>
              <tr>
                <td><?= $index+1 ?></td>
                <td><?= $employees['name']?></td>
                <td><?= $employees['email']?></td>
                <td><?= $employees['phone']?></td>
                <td><?= $employees['address']?></td>
                <td><?= $employees['department']?></td>
                <td>
                  <a href="show.php?show=<?=$employees['id']?>" class="btn btn-info">Show</a>
                  <a href="edit.php?edit=<?=$employees['id']?>" class="btn btn-warning">Edit</a>
                  <a href="?delete=<?=$employees['id']?>" name="delete" class="btn btn-danger">Delete</a>
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