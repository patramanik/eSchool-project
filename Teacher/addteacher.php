<?php 
if(!isset($_SESSION)){ 
  session_start(); 
}
include_once('../dbConnection.php');

// setting header type to json, We'll be outputting a Json data
header('Content-type: application/json');

// Checking Email already Registered
if(isset($_POST['teaemail']) && isset($_POST['checkemail'])){
  $teaemail = $_POST['teaemail'];
  $sql = "SELECT tea_email FROM teacher WHERE tea_email='".$teaemail."'";
  $result = $conn->query($sql);
  $row = $result->num_rows;
  echo json_encode($row);
  }
 
  // Inserting or Adding New teacher
  if(isset($_POST['teasignup']) && isset($_POST['teaname']) && isset($_POST['teaemail']) && isset($_POST['teapass'])){
    $teaname = $_POST['teaname'];
    $teaemail = $_POST['teaemail'];
    $teapass = $_POST['teapass'];
    $sql = "INSERT INTO teacher(tea_name, tea_email, tea_pass) VALUES ('$teaname', '$teaemail', '$teapass')";
    if($conn->query($sql) == TRUE){
      echo json_encode("OK");
    } else {
      echo json_encode("Failed");
    }
  }

  // teacher Login Verification
  if(!isset($_SESSION['tea_is_login'])){
    if(isset($_POST['checkLogemail']) && isset($_POST['teaLogEmail']) && isset($_POST['teaLogPass'])){
      $teaLogEmail = $_POST['teaLogEmail'];
      $teaLogPass = $_POST['teaLogPass'];
      $sql = "SELECT tea_email, tea_pass FROM teacher WHERE tea_email='".$teaLogEmail."' AND tea_pass='".$teaLogPass."'";
      $result = $conn->query($sql);
      $row = $result->num_rows;
      
      if($row === 1){
        $_SESSION['tea_is_login'] = true;
        $_SESSION['teaLogEmail'] = $teaLogEmail;
        echo json_encode($row);
      } else if($row === 0) {
        echo json_encode($row);
      }
    }
  }

?>