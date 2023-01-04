<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Catagory');
define('PAGE', 'catagory');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 if(isset($_REQUEST['CatagorySubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['categoryName'] == "") ){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $categoryName = $_REQUEST['categoryName'];
  
    $sql = "INSERT INTO categorycourse (categoryName) VALUES ('$categoryName')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Catagory Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Catagory </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Catagory</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="categoryName">Catagory Name</label>
      <input type="text" class="form-control" id="categoryName" name="categoryName">
    </div>
    
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="CatagorySubmitBtn" name="CatagorySubmitBtn">Submit</button>
      <a href="Catagory.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>

</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>