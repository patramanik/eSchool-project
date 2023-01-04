<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Teacher');
define('PAGE', 'teacher');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 if(isset($_REQUEST['newTeaSubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['tea_name'] == "") || ($_REQUEST['tea_email'] == "") || ($_REQUEST['tea_pass'] == "") || ($_REQUEST['tea_occ'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $tea_name = $_REQUEST['tea_name'];
   $tea_email = $_REQUEST['tea_email'];
   $tea_pass = $_REQUEST['tea_pass'];
   $tea_occ = $_REQUEST['tea_occ'];

    $sql = "INSERT INTO teacher (tea_name, tea_email, tea_pass, tea_occ) VALUES ('$tea_name', '$tea_email', '$tea_pass', '$tea_occ')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Student Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Student </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Teacher</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="tea_name">Name</label>
      <input type="text" class="form-control" id="tea_name" name="tea_name">
    </div>
    <div class="form-group">
      <label for="tea_email">Email</label>
      <input type="text" class="form-control" id="tea_email" name="tea_email">
    </div>
    <div class="form-group">
      <label for="tea_pass">Password</label>
      <input type="text" class="form-control" id="tea_pass" name="tea_pass">
    </div>
    <div class="form-group">
      <label for="tea_occ">Occupation</label>
      <input type="text" class="form-control" id="tea_occ" name="tea_occ">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="newTeaSubmitBtn" name="newTeaSubmitBtn">Submit</button>
      <a href="teacher.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>