<?php
$teaId=0;
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Lessons');
define('PAGE', 'lessons');
include('./teaInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['tea_is_login'])){
  $teaId = $_SESSION['tea_id'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 ?>

<div class="col-sm-9 mt-5  mx-3">
  
  <?php
  $coursId=$_GET['course_id'];
  //$teaId=$_GET['tea_id'];
          $sql = "SELECT * FROM lesson WHERE course_id = {$coursId} AND tea_id={$teaId}";
          $result = $conn->query($sql);
          echo '<table class="table">
            <thead>
              <tr>
              <th scope="col">Lesson ID</th>
              <th scope="col">Lesson Name</th>
              <th scope="col">Lesson Link</th>
              <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>';
              while($row = $result->fetch_assoc()){
                echo '<tr>';
                echo '<th scope="row">'.$row["lesson_id"].'</th>';
                echo '<td>'. $row["lesson_name"].'</td>';
                echo '<td>'.$row["lesson_link"].'</td>';
                echo '<td><form action="editlesson.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["lesson_id"] .'><input type="hidden" name="course_id" value='.$coursId.'><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button></form>
                <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["lesson_id"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
              </tr>';
              }
              echo '</tbody>
             </table>';


        if(isset($_REQUEST['delete'])){
         $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
         if($conn->query($sql) === TRUE){
           // echo "Record Deleted Successfully";
           // below code will refresh the page after deleting the record
           echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
           } else {
             echo "Unable to Delete Data";
           } 
     } 
    
  ?>
  
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
 </div>  <!-- div Row close from header -->
 <div><a class="btn btn-danger box float-right" href="addLesson.php?course_id=<?php echo $coursId; ?>"><i class="fas fa-plus fa-2x"></i></a></div>
</div> 
 
</div>  <!-- div Conatiner-fluid close from header -->
<?php
include('./teaInclude/footer.php'); 
?>