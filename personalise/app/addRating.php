<?php 
session_start();
include 'includes/dbConnection.php';

$movieTitle = $_REQUEST['movieTitle'];
$rate = $_REQUEST['rate'];
$userID = $_REQUEST['userID'];

$movie = "SELECT movie_id FROM recommendationDB.movie_info WHERE movie_title = '$movieTitle';";
$movieQuery = mysqli_query($con, $movie);
$movieInfo = mysqli_fetch_array($movieQuery, MYSQLI_ASSOC);

$movieID = $movieInfo['movie_id'];

$addRating = "INSERT INTO recommendationDB.ratings (user_id,movie_id,rating) VALUE ($userID, $movieID, $rate);";
mysqli_query($con, $addRating);
header('Location: profile.php?id='.$userID);
?>