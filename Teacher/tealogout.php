<?php
 session_start();
 unset($_SESSION['tea_is_login']);
 echo "<script> location.href='../index.php'; </script>";
?>