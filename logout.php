<?php 
session_start();
session_destroy();
echo "<script>alert('LOGOUT SUCCESSFULL!!!')</script>";
echo "<script>window.location='Login.php'</script>";
?>