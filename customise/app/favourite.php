<?php 
session_start();

include 'includes/dbConnection.php';

$userID = $_SESSION['userID'];
$addFave = $_GET['id'];

$personID = preg_match("/^nm/",$addFave);
$movieID = preg_match("/^tt/",$addFave);

if ($personID == 1) {
	// adding Person Fave
	$selectQueryPerson = "SELECT personFav FROM users WHERE userID = " . $userID . ";";
	$rowPerson = mysqli_fetch_array(mysqli_query($con, $selectQueryPerson), MYSQLI_ASSOC);

	if ($rowPerson['personFav'] != "") {
		$newFaves = $rowPerson['personFav'] . ', ' . $addFave;
	} else {
		$newFaves = $addFave;
	}
	
	$column = 'personFav';
} else if ($movieID == 1) {
	// adding Movie Fave
	$selectQueryMovie = "SELECT movieFav FROM users WHERE userID = " . $userID . ";";
	$rowMovie = mysqli_fetch_array(mysqli_query($con, $selectQueryMovie), MYSQLI_ASSOC);
	
	if ($rowMovie['movieFav'] != "") {
		$newFaves = $rowMovie['movieFav'] . ',' . $addFave;
	} else {
		$newFaves = $addFave;
	}
	
	$column = 'movieFav';
}

$update = "UPDATE users SET " . $column . "='" . $newFaves . "' WHERE userID=" . $userID . ";";
mysqli_query($con, $update);
mysqli_close($con);

header('Location: dashboard.php');
?>