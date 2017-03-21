<?php 
session_start();

include 'includes/dbConnection.php';

$loggedIn = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'false';

$select = "SELECT * FROM users WHERE userID=" . $_SESSION['userID'] . ";";
$selectRunQuery = mysqli_query($con, $select);
$row = mysqli_fetch_array($selectRunQuery, MYSQLI_ASSOC);

if ($row['personFav'] != '') {
	$favouritePeople = explode(",",$row['personFav']);
	unset($_SESSION['noResultsPerson']);
} else {
	$_SESSION['noResultsPerson'] = "You have not added any people yet!";
}

if ($row['movieFav'] != '') {
	$favouriteMovies = explode(",",$row['movieFav']);
	unset($_SESSION['noResultsMovie']);
} else {
	$_SESSION['noResultsMovie'] = "You have not added any movies yet!";
}
?>
<!DOCTYPE html>
<html lang="en-gb">
<title>Customise - <?php echo $username; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<body>
<div class="j-intro">
  <!-- Navigation Bar -->
  <div class="w3-bar" id="myNavbar">
    <a class="w3-text-white w3-button" style="background-color:#283142"><b><i class="fa fa-arrows w3-margin-right"></i>Customise</b></a>
    <a href="index.php" class="w3-text-white j-hover-darkish-blue w3-button">Home</a>
    <a href="user-area.php" class="w3-text-white j-hover-darkish-blue w3-button" id="userarea">User Area</a>
    <a href="logout.php" id="loggedIn" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red w3-button" style="display:none">
      <i class="fa fa-user"></i>
    </a>
  </div>
  <!-- Navigation Bar -->
</div>
<div class="j-features-2">
  <div class="w3-container w3-content">
    <div class="w3-row">
			<h2 class="w3-center w3-margin-bottom">Favourite People</h2>
      <div class="j-search-border j-overflow" id='people'>
				<?php
					if (isset($_SESSION['noResultsPerson'])) {
						echo "<h3 class='w3-center j-middle-noresults'>" . $_SESSION['noResultsPerson'] . "</h3>";
					} else {
						foreach ($favouritePeople as $person) {
							include 'includes/favouritePeople.php';
						}
					}
				?>
      </div>
    </div>
  </div>
</div>

<div class="j-features-1">
  <div class="w3-container w3-content">
    <div class="w3-row">
			<h2 class="w3-center w3-margin-bottom">Favourite Movies</h2>
      <div class="j-search-border2 j-overflow" id='movies'>
        <?php
					if (isset($_SESSION['noResultsMovie'])) {
						echo "<h3 class='w3-center j-middle-noresults'>" . $_SESSION['noResultsMovie'] . "</h3>";
					} else {
						foreach ($favouriteMovies as $movie) {
							include 'includes/favouriteMovies.php';
						}
					}
				?>
      </div>
    </div>
  </div>
</div>

<div class="j-features-2">
  <div class="w3-container w3-content">
    <div class="w3-row">
			<h2 class="w3-center w3-margin-bottom">Top Movies per Your Favourite Genres</h2>
      <div class="j-search-border" id='genres'>
				
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
<script src="scripts/main.js"></script>
<script>
var loggedIn = <?php echo json_encode($loggedIn); ?>;
var username = <?php echo json_encode($username); ?>;

if (loggedIn == 'true') {
  $('#userarea').text('Dashboard');
  $('#userarea').attr('href', 'dashboard.php');
}
</script>
<script src="scripts/loggedIn.js"></script>
</html>
