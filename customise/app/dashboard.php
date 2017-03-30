<?php 
session_start();

include 'includes/dbConnection.php';

$loggedIn = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'false';

$userID = $_SESSION['userID'];

$selectPeople = "SELECT personID, personName FROM user_favPeople WHERE userID=" . $_SESSION['userID'] . ";";
$selectPeopleRunQuery = mysqli_query($con, $selectPeople);

if (mysqli_num_rows($selectPeopleRunQuery) > 0) {
	while($rowPeople = mysqli_fetch_array($selectPeopleRunQuery, MYSQLI_ASSOC)) {
		$favouritePeople[] = array($rowPeople['personID']);
	}
} else if (mysqli_num_rows($selectPeopleRunQuery) <= 0) {
	$errorPeople = "You have not added any people yet!";
}

$selectMovies = "SELECT movieID, movieName FROM user_favMovies WHERE userID=" . $_SESSION['userID'] . ";";
$selectMoviesRunQuery = mysqli_query($con, $selectMovies);

if (mysqli_num_rows($selectMoviesRunQuery) > 0) {
	while($rowMovies = mysqli_fetch_array($selectMoviesRunQuery, MYSQLI_ASSOC)) {
		$favouriteMovies[] = array($rowMovies['movieID']);
	}
} else if (mysqli_num_rows($selectMoviesRunQuery) <= 0) {
	$errorMovies = "You have not added any movies yet!";
}

if ($loggedIn == 'false') {
	header('Location: index.php');
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
			<h2 class="w3-center w3-margin-bottom">Favourite People</h2>
      <div class="j-search-border j-overflow" id='people'>
				<?php
					if (isset($errorPeople)) {
						echo "<h3 class='w3-center j-middle-noresults'>" . $errorPeople . "</h3>";
					} else {
						echo '<div class="w3-center j-spinner-padding-small" id="loadingIcon">';
						echo '<i class="fa fa-refresh fa-spin" style="font-size:48px"></i>';
						echo '</div>';
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
					if (isset($errorMovies)) {
						echo "<h3 class='w3-center j-middle-noresults'>" . $errorMovies . "</h3>";
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
			<h2 class="w3-center w3-margin-bottom">Top Movies per Your Favourite Genre</h2>
      <div class="j-search-border j-overflow" id='genres'>
				<?php
					$getGenres = "SELECT genreName FROM genres INNER JOIN user_favGenre ON genres.genreID = user_favGenre.genreID WHERE userID = $userID;";
					$runGetGenresQuery = mysqli_query($con, $getGenres);

					if (mysqli_num_rows($runGetGenresQuery) == 1) {
						$rowGenres = mysqli_fetch_array($runGetGenresQuery, MYSQLI_ASSOC);
						$string = file_get_contents("includes/response.json");
						$json_a = json_decode($string, true);
						$movies = $json_a['data']['movies'];
						
						for ($x = 0; $x < sizeof($movies); $x++) {
							$genres = $movies[$x]['genres'];
							foreach ($genres as $genre) {
								if ($genre == $rowGenres['genreName']) {
									echo "<div class='w3-row w3-margin-top'>";
									echo "<div class='w3-col m6 w3-center'>";
									echo "<h4 class='w3-center'>" . $json_a['data']['movies'][$x]['title'] . "</h4>" ;
									echo "<img src='" . $json_a['data']['movies'][$x]['urlPoster'] . "' width=150px>";
									echo "</div>";
									echo "<div class='w3-col m6'>";
									echo "<p>" . $json_a['data']['movies'][$x]['simplePlot'] . "</p>" ;
									echo "<a href='" . $json_a['data']['movies'][$x]['urlIMDB'] . "' class='w3-btn' target='_blank'>More</a>" ;
									echo "</div>" ;
									echo "</div>";
									echo "<hr class='divider'>";
								}
							}
						}
					} else if (mysqli_num_rows($runGetGenresQuery) <= 0) {
						$errorGenres = "You have not selected any genres yet!";
						echo "<h3 class='w3-center j-middle-noresults'>" . $errorGenres . "</h3>";
					}
				?>
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
	$('#settings').show();
}
</script>
<script src="scripts/loggedIn.js"></script>
</html>
