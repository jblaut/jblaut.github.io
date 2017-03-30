<?php
session_start();
include 'includes/dbConnection.php';
 
$selectedValue = $_POST['genres'];
$userID = $_SESSION['userID'];


$matchGenre = "SELECT * FROM user_favGenre WHERE userID='$userID';";
$result = mysqli_query($con, $matchGenre);

if (mysqli_num_rows($result) > 0) {
  $updateQuery = "UPDATE user_favGenre SET genreID=" . $selectedValue . " WHERE UserID=" . $userID . ";";
  $update = mysqli_query($con, $updateQuery);
} else if (mysqli_num_rows($result) <= 0) {
  $insertQuery = "INSERT INTO user_favGenre(userID, genreID) VALUES ($userID, $selectedValue);";
  $insert = mysqli_query($con, $insertQuery);
}

mysqli_close($con);
header('Location: settings.php');
?>