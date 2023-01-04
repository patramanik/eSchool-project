<?php
 session_start();
 unset($_SESSION['is_admin_login']);
 echo "<script> location.href='../index.php'; </script>";
?>