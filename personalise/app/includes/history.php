<?php 
include 'includes/dbConnection.php';
$user_id = $_GET['id'];
$history = "SELECT * FROM recommendationDB.ratings INNER JOIN recommendationDB.movie_info ON ratings.movie_id = movie_info.movie_id WHERE user_id = $user_id;";
$historyQuery = mysqli_query($con, $history);
?>