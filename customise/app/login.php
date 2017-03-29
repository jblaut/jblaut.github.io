<?php 
session_start();

include 'includes/dbConnection.php';

$username = $_REQUEST['username'];
$password = md5($_REQUEST['password']);

$matchUser = "SELECT * FROM users WHERE userName = '$username' AND userPassword = '$password';";
$result = mysqli_query($con, $matchUser);

if (mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$_SESSION['logged_in'] = 'true';
	$_SESSION['username'] = $username;
	$_SESSION['userID'] = $row['userID'];
	header('Location: dashboard.php');
} else if (mysqli_num_rows($result) <= 0) {
	$_SESSION['logged_in'] = 'false';
	$_SESSION['registerError'] = "Incorrect username or password.";
	header('Location: user-area.php');
}

mysqli_close($con);
?>