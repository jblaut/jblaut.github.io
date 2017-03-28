<?php 
include 'includes/dbConnection.php';
$user_id = $_GET['id'];
$user = "SELECT * FROM recommendationDB.users WHERE user_id = $user_id;";
$userQuery = mysqli_query($con, $user);
$userInfo = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
?>