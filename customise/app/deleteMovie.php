<?php
include 'includes/dbConnection.php';
$toRemove = $_GET['id'];

if (substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1) != 'settings.php') {
	header("Location: index.php");
	die();
}

mysqli_query($con, "DELETE FROM user_favMovies WHERE faveMovieID = '$toRemove'");
mysqli_close($con);
header("Location: settings.php");
?>
