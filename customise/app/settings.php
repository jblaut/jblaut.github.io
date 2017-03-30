<?php
session_start();
include 'includes/dbConnection.php';

$loggedIn = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'false';
$userID = $_SESSION['userID'];

$selectGenre = "SELECT genreID FROM user_favGenre WHERE userID=$userID";
$selectGenreQuery = mysqli_query($con, $selectGenre);
$rowGenres = mysqli_fetch_array($selectGenreQuery, MYSQLI_ASSOC);

$userGenreID = isset($rowGenres['genreID']) ? $rowGenres['genreID'] : null;
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
    <a href="settings.php" class="w3-text-white j-hover-darkish-blue w3-button" id="settings" style='display:none;'>Settings</a>
    <a href="logout.php" id="loggedIn" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red w3-button" style="display:none">
      <i class="fa fa-user"></i>
    </a>
  </div>
  <!-- Navigation Bar -->
</div>
<div class="j-features-2">
  <div class="w3-container w3-content">
    <div class="w3-row">
			<h2 class="w3-center w3-margin-bottom">Remove People</h2>
			<?php 
				$selectPeople = "SELECT favePersonID, personID, personName FROM user_favPeople WHERE userID=" . $_SESSION['userID'] . ";";
				$selectPeopleRunQuery = mysqli_query($con, $selectPeople);

				if (mysqli_num_rows($selectPeopleRunQuery) > 0) {
					while($rowPeople = mysqli_fetch_array($selectPeopleRunQuery, MYSQLI_ASSOC)) {
						echo "<div class='w3-col m6 w3-center'>";
						echo $rowPeople['personName'];
						echo "</div>";
						echo "<div class='w3-col m6 w3-center'>";
						echo "<a href='deletePerson.php?id=" . $rowPeople['favePersonID'] . "' class='w3-btn w3-theme w3-margin-left'>Remove</a>";
						echo "</div>";
						echo "<br><hr>";
					}
				} else if (mysqli_num_rows($selectPeopleRunQuery) <= 0) {
					$errorPeople = "You have not added any people yet!";
          echo "<h3 class='w3-center'>" . $errorPeople . "</h3>";
				}
			?>
    </div>
  </div>
</div>

<div class="j-features-1">
  <div class="w3-container w3-content">
    <div class="w3-row">
			<h2 class="w3-center w3-margin-bottom">Remove Movies</h2>
			<?php
				$selectMovies = "SELECT faveMovieID, movieID, movieName FROM user_favMovies WHERE userID=" . $_SESSION['userID'] . ";";
				$selectMoviesRunQuery = mysqli_query($con, $selectMovies);

				if (mysqli_num_rows($selectMoviesRunQuery) > 0) {
					while($rowMovies = mysqli_fetch_array($selectMoviesRunQuery, MYSQLI_ASSOC)) {
						echo "<div class='w3-col m6 w3-center'>";
						echo $rowMovies['movieName'];
						echo "</div>";
						echo "<div class='w3-col m6 w3-center'>";
						echo "<a href='deleteMovie.php?id=" . $rowMovies['faveMovieID'] . "' class='w3-btn w3-theme w3-margin-left'>Remove</a>";
						echo "</div>";
						echo "<br><hr>";
					}
				} else if (mysqli_num_rows($selectMoviesRunQuery) <= 0) {
					$errorMovies = "You have not added any movies yet!";
          echo "<h3 class='w3-center'>" . $errorMovies . "</h3>";
				}
			?>
    </div>
  </div>
</div>

<div class="j-features-2">
  <div class="w3-container w3-content">
    <div class="w3-row w3-center">
			<h2 class="w3-center w3-margin-bottom">Edit Genre</h2>
			<form action='updateGenre.php' method="post">
				<select class="selectGenres" id="genres" name="genres">
          <option value='info' disabled>Select a genre</option>
					<?php
						$selectGenres = "SELECT * FROM genres;";
						$selectGenresQuery = mysqli_query($con, $selectGenres);
						
						while($rowGenres = mysqli_fetch_array($selectGenresQuery, MYSQLI_ASSOC)) {
							echo "<option value='" . $rowGenres['genreID'] . "'>" . $rowGenres['genreName'] . "</option>";
						}
					?>
				</select>
				<br><br>
				<button class='w3-btn'>Submit</button>
			</form>
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
var genre = <?php echo json_encode($userGenreID); ?>;
console.log(genre);
if (loggedIn == 'true') {
  $('#userarea').text('Dashboard');
  $('#userarea').attr('href', 'dashboard.php');
  $('#settings').show();
}

if (genre != null) {
	$("#genres").val(genre);
} else {
  $("#genres").val('info');
}
</script>
<script src="scripts/loggedIn.js"></script>
</html>
