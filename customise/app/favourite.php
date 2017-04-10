<?php
session_start();

include 'includes/dbConnection.php';

$userID = $_SESSION['userID'];
$addFave = $_GET['id'];
$name = $_GET['name'];
$name = preg_replace("/[\s_]+/", " ", $name);

$personID = preg_match("/^nm/",$addFave);
$movieID = preg_match("/^tt/",$addFave);

if ($personID == 1) {
	$newEntry = "INSERT INTO user_favPeople (userID, personID, personName) VALUES ($userID, '$addFave', '$name');";
	mysqli_query($con, $newEntry);
	mysqli_close($con);
} else if ($movieID == 1) {
	$newEntry = "INSERT INTO user_favMovies (userID, movieID, movieName) VALUES ($userID, '$addFave', '$name');";
	mysqli_query($con, $newEntry);
	mysqli_close($con);
}

header('Location: dashboard.php');
?>
