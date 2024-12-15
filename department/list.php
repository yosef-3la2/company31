<?php
require_once 'C:xampp/htdocs/db-project/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';


if(isset($_GET['delete']))
{
  $id=$_GET['delete'];

  $delete_emp_query="DELETE FROM employees WHERE department_id=$id";
  $emp_delete=$pdo->prepare($delete_emp_query);
  $emp_delete->execute();

  $id=$_GET['delete'];
  $delete_dep_query="DELETE FROM departments WHERE id=$id";
  $dep_delete=$pdo->prepare($delete_dep_query);
  $dep_delete->execute();
  
  if($dep_delete && $emp_delete){
      path('department/list.php');
  }
}



$selectquery="SELECT * FROM departments;";
$select=$pdo->prepare($selectquery);
$select->execute();
?>




    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">List All Departments</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>department</th>
                <th>actions</th>
              </tr>
            </thead>
            <tbody>
             
            <?php foreach($select as $index => $department): ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $department['department']?></td>
                <td>
                  <a href="edit.php?edit=<?=$department['id']?>" class="btn btn-warning">Edit</a>
                  <a href="?delete=<?=$department['id']?>" name="delete" class="btn btn-danger">Delete</a>
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