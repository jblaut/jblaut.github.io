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
	$_SESSION['userID'] = $row['user_id'];
	$_SESSION['registerError'] = '';
	header('Location: profile.php?id=' . $row['user_id']);
} else if (mysqli_num_rows($result) == 0) {
	$_SESSION['logged_in'] = 'false';
	$_SESSION['registerError'] = "Incorrect username or password.";
	header('Location: index.php?');
}

mysqli_close($con);
?>