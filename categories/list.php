<?php
require_once 'C:xampp/htdocs/company/app/configDB.php';
require_once '../shared/header.php';
require_once '../shared/navbar.php';

if(isset($_GET['delete']))
{
    $id=$_GET['delete'];
    $deletequery="DELETE FROM `categories` WHERE id=$id";
    $delete=mysqli_query($con,$deletequery);
    if($delete){
        path('categories/list.php');
    }
}



$selectquery="SELECT * FROM `categories` ";
$select=mysqli_query($con,$selectquery);


$numofrows=mysqli_num_rows($select);
?>




    <div class="container col-6 pt-5">
      <h2 class="text-center text-light">List All Categories</h2>
      <div class="card border-0">
        <div class="card-body bg-dark text-light">
          <table class="table table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>category</th>
                <th>actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- start of row -->
            <?php if ( $numofrows> 0) :?>
            <?php foreach($select as $index => $category): ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $category['category']?></td>
                <td>
                  <a href="edit.php?edit=<?=$category['id']?>" class="btn btn-warning">Edit</a>
                  <a href="?delete=<?=$category['id']?>" name="delete" class="btn btn-danger">Delete</a>
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