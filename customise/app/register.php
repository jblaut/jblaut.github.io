<?php 
	session_start();

	include 'includes/dbConnection.php';
	
	$username = $_REQUEST['username'];
	$email = $_REQUEST['email'];
	$password = md5($_REQUEST['password']);
	
	$currentUsers = "SELECT * FROM users;";
	$result = mysqli_query($con, $currentUsers);
	
	while($row = mysqli_fetch_array($result)) {
		if ($username == $row['userName']) {
			$_SESSION['registerError'] = 'Username already exists.';
			header('Location: user-area.php');
			die();
		} else if ($email == $row['userEmail']) {
			$_SESSION['registerError'] = 'E-mail is already being used.';
			header('Location: user-area.php');
			die();
		}
	}
	
	$newUserQuery = "INSERT INTO users (userName, userEmail, userPassword) VALUES ('" . $username . "', '" . $email . "', '" . $password . "');";
	mysqli_query($con, $newUserQuery);
	
	$select = "SELECT * FROM users WHERE userName = '$username' AND userEmail = '$email';";
	$selectRunQuery = mysqli_query($con, $select);
	$row = mysqli_fetch_array($selectRunQuery, MYSQLI_ASSOC);

	$_SESSION['logged_in'] = 'true';
	$_SESSION['username'] = $username;
	$_SESSION['userID'] = $row['userID'];
	
	mysqli_close($con);
	
	header('Location: index.php');
?>