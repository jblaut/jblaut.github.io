<?php
include 'includes/dbConnection.php';
$toRemove = $_GET['id'];

mysqli_query($con, "DELETE FROM user_favMovies WHERE faveMovieID = '$toRemove'");	
mysqli_close($con);
header("Location: settings.php");
?>