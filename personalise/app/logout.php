<?php 
include 'includes/dbConnection.php';
session_start();
session_destroy();
mysqli_close($con);
header('Location: index.php');
?>