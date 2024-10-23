<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';
auth(2);

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $deletequery="DELETE FROM `departments` WHERE id=$id";
    $delete=mysqli_query($con,$deletequery);
    if($delete){
        path('department/list.php');
    }
}



$selectquery="SELECT * FROM `departments` ";
$select=mysqli_query($con,$selectquery);


$numofrows=mysqli_num_rows($select);
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
              <!-- start of row -->
            <?php if ( $numofrows> 0) :?>
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