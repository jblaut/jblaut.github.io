<?php
session_start();
 
include 'includes/dbConnection.php';
$searchQuery = $_REQUEST['movieTitle'];
$search = "SELECT * FROM recommendationDB.movie_info WHERE movie_title LIKE '%$searchQuery%'";
$searchQuery = mysqli_query($con, $search);

while ($searchMovies = mysqli_fetch_array($searchQuery, MYSQLI_ASSOC)){
	$movies[] = array('title' => $searchMovies['movie_title'], 'id' => $searchMovies['movie_id']);
}

$_SESSION['results'] = $movies;
header('Location: ' . substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
?>