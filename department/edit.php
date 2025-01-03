  <?php
  require_once 'C:xampp/htdocs/db-project/app/configDB.php';
  require_once 'C:xampp/htdocs/db-project/app/functions.php';
  require_once '../shared/header.php';
  require_once '../shared/navbar.php';


  $department='';
  if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $selectquery="SELECT * FROM departments where id= $id";
    $deps = $pdo->query($selectquery);
    
    $row = $deps->fetch(PDO::FETCH_ASSOC);
            
    $department=$row['department'];
    if(isset($_POST['department'])){
      $department=$_POST['department'];
      $updatequery="UPDATE departments set department='$department' where id=$id";
      $update=$pdo->prepare($updatequery);
      $update->execute(); 
      if($update){
        path('department/list.php');
      }
      }
    }
  


  ?>

      <div class="container col-6 pt-5">
        <h2 class="text-center text-light">Update Department</h2>
        <div class="card border-0">
          <div class="card-body bg-dark text-light">
          <?php if(!empty($message)):?>
            <div class="alert alert-success">
              <p class="fs-4 mb-0"><?=$message ?></p>
            </div>
            <?php endif; ?>
            <form method="POST">
              <div class="form-group mb-2">
                <label for="department" class="form-label"> Department </label>
                <input
                  value="<?=$department?>"
                  type="text"
                  class="form-control"
                  id="department"
                  name="department"
                />
              </div>
              <div class="text-center">
                <button class="btn btn-warning">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>



  <?php
  require_once '../shared/footer.php';

  ?>