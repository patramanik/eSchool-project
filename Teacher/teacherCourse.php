<?php
$teaId=0;
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'TeacherCourse');
define('PAGE', 'teacherCourse');
include('./teaInclude/header.php'); 
include_once('../dbConnection.php');

 if(isset($_SESSION['tea_is_login'])){
  $teaLogEmail = $_SESSION['teaLogEmail'];
  $s=" SELECT tea_id from teacher where tea_email='$teaLogEmail'";
  $r=$conn->query($s);
  while ($row1 = $r->fetch_assoc()) {
    $teaId=$row1['tea_id'];
  }
  $_SESSION['tea_id']=$teaId;
  // $teaId = mysqli_fetch_array($r);
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
?>

<div class="col-sm-9 mt-5">
    <!--Table-->
    <p class=" bg-dark text-white p-2">List of Courses</p>
    <?php
      $sql = "SELECT * FROM course where tea_id=$teaId";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
       echo '<table class="table">
       <thead>
        <tr>
         <th scope="col">Course ID</th>
         <th scope="col">Name</th>
         <th scope="col">Catagory Name</th>
         <th scope="col">Action</th>
        </tr>
       </thead>
       <tbody>';
        while($row = $result->fetch_assoc()){
          echo '<tr>';
          echo '<th scope="row">'.$row["course_id"].'</th>';
          echo '<td>'. $row["course_name"].'</td>';
          $Name="";
          $s="SELECT categoryName from categorycourse where categoryId={$row['categoryId']}";
          $r=$conn->query($s);
          while ($row1 = $r->fetch_assoc()) {
            $Name=$row1['categoryName'];
          }
          echo '<td>'.$Name.'</td>';
          $link="lessons.php?course_id={$row['course_id']}";
          echo '<td><a href='."$link".' class="d-inline"><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-plus"></i></button></a> 
          
          
          <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["course_id"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
         </tr>';
        }

        echo '</tbody>
        </table>';
      } else {
        echo "0 Result";
      }
      if(isset($_REQUEST['delete'])){
       $sql = "DELETE FROM course WHERE course_id = {$_REQUEST['id']}";
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
 </div>  <!-- div Row close from header -->
 <div><a class="btn btn-danger box float-right" href="addCourse.php"><i class="fas fa-plus fa-2x"></i></a></div>
</div>  <!-- div Conatiner-fluid close from header -->

 <?php
include('./teaInclude/footer.php'); 
?>