<?php
  session_start();
  
  $loggedIn = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'false';
  $error = isset($_SESSION['registerError']) ? $_SESSION['registerError'] : false;
  $user_id = isset($_SESSION['registerError']) ? $_SESSION['userID'] : '';
?>
<!DOCTYPE html>
<html lang="en-gb">
<title>Personalise - Home</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">

<body>
<div class="j-intro">
  <!-- Navigation Bar -->
  <div class="w3-bar" id="myNavbar">
    <a class="w3-text-white logo-button" style="background-color:#283142"><b><i class="fa fa-code w3-margin-right"></i>Personalise</b></a>
    <a href="logout.php" id="loggedIn" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red w3-button" style="display:none">
      <i class="fa fa-user"></i>
    </a>
  </div>
  <!-- Navigation Bar -->

  <div class="w3-container w3-content j-search-box-small">
    <div class="w3-row">
      <div class="w3-col m1">
        <br>
      </div>
      <div class="w3-col m10">
        <div class="j-search-border">
          <h2>Welcome to the personalisation service!</h2>
          Here you'll be able to create your own account,
          <br>
          Search for movies you've seen and rate them.
          <br>
          Then just sit back and relax as the movies you should watch next are picked for you!
        </div>
      </div>
    </div>
  </div>
</div>
<div class="j-features-1">
  <div class="w3-container w3-content">
    <div class="w3-row">
      <div class="j-login-border">
      <h3>Login/Register</h3>
      <h6 id='error' class="w3-text-red w3-hide"></h6>
      <form id="loginForm" method="post" action="login.php">
        <div class="w3-row-padding" style="margin:0 -16px;">
          
          <div class="w3-quarter w3-margin-top-small">
            <label class="w3-label">Username:</label>
          </div>
          <div class="w3-threequarter">
            <input class="w3-input w3-border" type="text" placeholder="Username" name="username" required>
          </div>
          
          <div class="w3-quarter w3-margin-top-large registeronly">
            <label class="w3-label">E-mail:</label>
          </div>
          <div class="w3-threequarter w3-margin-top registeronly">
            <input class="w3-input w3-border" type="email" name="email" placeholder="E-mail">
          </div>
          
          <div class="w3-quarter w3-margin-top-large">
            <label class="w3-label">Password:</label>
          </div>
          <div class="w3-threequarter w3-margin-top">
            <input class="w3-input w3-border" type="password" id="password" name="password" placeholder="Password" required>
          </div>
          
          <div class="w3-quarter w3-margin-top-large registeronly">
            <label class="w3-label">Confirm Password:</label>
          </div>
          <div class="w3-threequarter w3-margin-top registeronly">
            <input class="w3-input w3-border" type="password" id="confirmPassword" placeholder="Confirm Password">
          </div>
          
        </div>
        <div class="w3-margin-top">
          <button class="w3-btn w3-dark-grey" id="loginButton" onclick="login()" type="button" style="display:none">Login</button>
          <button class="w3-btn w3-dark-grey" id="loginButtonSubmit" type="submit">Login</button>
          <button class="w3-btn w3-dark-grey" id="registerButton" onclick="openRegister()" type="button">Register</button>
          <button class="w3-btn w3-dark-grey" id="registerButtonSubmit" onclick="validatePassword()" type="submit" style="display:none">Register</button>
        </div>
        <!-- <div class="w3-margin-top">
          <a href="" id="forgottenpassword">Forgotten Password</a>
        </div> -->
      </form>
      </div>
    </div>
  </div>
</div>
<footer>
  <div class="w3-center">
    Created by J. Blaut
  </div>
</footer>
</body>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="scripts/main.js"></script>
<script>
var loggedIn = <?php echo json_encode($loggedIn); ?>;
var username = <?php echo json_encode($username); ?>;
console.log(loggedIn);
if (loggedIn == 'true') {
  $('#userarea').text('Dashboard');
  $('#userarea').attr('href', 'dashboard.php');
  $('#profileNav').show();
}
</script>
<script>
var error = <?php echo json_encode($error); ?>;
var password = document.getElementById('password');
var confirmPassword = document.getElementById('confirmPassword');

function openRegister() {
  $('.registeronly').show();
  $('#loginButton').show();
  $('#loginButtonSubmit').hide();
  $('#registerButtonSubmit').show();
  $('#registerButton').hide();
  // $('#forgottenpassword').hide();
  $('#loginForm').attr('action', "register.php");
}

function login() {
  $('.registeronly').hide();
  $('#loginButton').hide();
  $('#loginButtonSubmit').show();
  $('#registerButtonSubmit').hide();
  $('#registerButton').show();
  // $('#forgottenpassword').show();
  $('#loginForm').attr('action', "login.php");
}

if (error != 'false') {
  $('#error').html(error).show();
}

function validatePassword() {
  if (password.value != confirmPassword.value) {
    confirmPassword.setCustomValidity("Passwords don't match!");
  } else {
    confirmPassword.setCustomValidity('');
  }
}
</script>
<script src="scripts/loggedIn.js"></script>
</html>
