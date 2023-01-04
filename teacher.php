<?php 
  include('./dbConnection.php');
  // Header Include from mainInclude 
  include('./mainInclude/teacherheader.php'); 
?>
    <div class="container-fluid "> <!-- Start Course Page Banner -->
      <div class="row">
        <img src="./image/teacherbanner.jpg" alt="courses" style="height: 700px;; width:100%; object-fit:cover; box-shadow:10px;"/>
      </div> 
      <div class="vid-content" >
        <h1 class="my-content">Welcome to eSchool</h1>
        <small class="my-content">Learn and Implement</small>
        <br />
        <?php    
              if(!isset($_SESSION['tea_is_login'])){
                echo '<a class="btn btn-danger mt-3" href="#" data-toggle="modal" data-target="#teaRegModalCenter">Get Started</a>';
              } else {
                echo '<a class="btn btn-primary mt-3" href="teacher/teacherProfile.php">My Profile</a>';
              }
          ?> 
    </div> <!-- End Course Page Banner -->



<?php 
// Contact Us
include('./contact.php'); 
?> 

<?php 
  // Footer Include from mainInclude 
  
  include('./mainInclude/footer.php'); 
?> 
 
