<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Teacher Profile');
define('PAGE', 'profile');
include('./teaInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['tea_is_login'])){
  $teaEmail = $_SESSION['teaLogEmail'];
 } else {
  echo "<script> location.href='../teacher.php'; </script>";
 }

 $sql = "SELECT * FROM teacher WHERE tea_email='$teaEmail'";
 $result = $conn->query($sql);
 if($result->num_rows == 1){
 $row = $result->fetch_assoc();
 $teaId = $row["tea_id"];
 $teaName = $row["tea_name"]; 
 $teaOcc = $row["tea_occ"];
 $teaImg = $row["tea_img"];

}

 if(isset($_REQUEST['updateteaNameBtn'])){
  if(($_REQUEST['teaName'] == "")){
   // msg displayed if required field missing
   $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   $teaName = $_REQUEST["teaName"];
   $teaOcc = $_REQUEST["teaOcc"];
   $tea_image = $_FILES['teaImg']['name']; 
   $tea_image_temp = $_FILES['teaImg']['tmp_name'];
   $img_folder = '../image/tea/'. $tea_image; 
   move_uploaded_file($tea_image_temp, $img_folder);
   $sql = "UPDATE teacher SET tea_name = '$teaName', tea_occ = '$teaOcc', tea_img = '$img_folder' WHERE tea_email = '$teaEmail'";
   if($conn->query($sql) == TRUE){
   // below msg display on form submit success
   $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
   } else {
   // below msg display on form submit failed
   $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
      }
    }
 }

?>
 <div class="col-sm-6 mt-5">
  <form class="mx-5" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="teaId">Teacher ID</label>
      <input type="text" class="form-control" id="teaId" name="teaId" value=" <?php if(isset($teaId)) {echo $teaId;} ?>" readonly>
    </div>
    <div class="form-group">
      <label for="teaEmail">Email</label>
      <input type="email" class="form-control" id="teaEmail" value=" <?php echo $teaEmail ?>" readonly>
    </div>
    <div class="form-group">
      <label for="teaName">Name</label>
      <input type="text" class="form-control" id="teaName" name="teaName" value=" <?php if(isset($teaName)) {echo $teaName;} ?>">
    </div>
    <div class="form-group">
      <!-- teadent doesnt mean school teadent it also means learner -->
      <label for="teaOcc">Occupation</label>
      <input type="text" class="form-control" id="teaOcc" name="teaOcc" value=" <?php if(isset($teaOcc)) {echo $teaOcc;} ?>">
    </div>
    <div class="form-group">
      <label for="teaImg">Upload Image</label>
      <input type="file" class="form-control-file" id="teaImg" name="teaImg">
    </div>
    <button type="submit" class="btn btn-primary" name="updateteaNameBtn">Update</button>
    <?php if(isset($passmsg)) {echo $passmsg; } ?>
  </form>
 </div>

 </div> <!-- Close Row Div from header file -->

 <?php
include('./teaInclude/footer.php'); 
?>