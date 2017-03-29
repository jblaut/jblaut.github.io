<?php 
session_start();

$loggedIn = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'false';
$user_id = $_GET['id'];

if ($loggedIn == 'false') {
  header('Location: index.php');
} 

// $urlJourney = substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1);
// 
// if ($urlJourney != 'login.php' && $urlJourney != 'register.php' && $urlJourney != 'index.php') {
// 	header('Location: index.php');
// 	die();
// }
?>
<!DOCTYPE html>
<html lang="en-gb">
<title>Personalise - <?php echo $username; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
</div>
<div class="w3-container w3-content" style="max-width:1400px;min-height:600px;margin-top:80px"> 
    <!-- The Grid -->
    <div class="w3-row">
      <!-- Left Column -->
      <div class="w3-col m3">
        <!-- Profile -->
        <div class="w3-card-2 w3-round w3-333">
          <div class="w3-container">
            <h4 class="w3-center">My Profile</h4>
            <?php
              include 'includes/user_info.php';
              $date = date_create($userInfo['dateCreated']);
              $username = isset($userInfo['userName']) ? $userInfo['userName'] : "data_username" . $user_id;
              $email = isset($userInfo['userEmail']) ? $userInfo['userEmail'] : "data_email" . $user_id;
              $dateCreated = isset($userInfo['userName']) ? date_format($date, 'jS F Y') : date("h:i:sa");
              echo '<p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i><b>Username</b>: ' . $username . '</p>';
              echo '<p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i><b>E-mail</b>: ' . $email . '</p>';
              echo '<p><i class="fa fa-clock-o fa-fw w3-margin-right w3-text-theme"></i><b>Date Created</b>: ' . $dateCreated . '</p>';
            ?>
          </div>
        </div>
        <!-- End Left Column -->
      </div><!-- Middle Column -->
      <div class="w3-col m5">
        <div id="uploadArticlesBox" class="w3-row-padding">
          <div class="w3-col m12">
            <div class="w3-card-2 w3-round w3-333">
              <div class="w3-container w3-padding">
                <h4 class="">Add New Ratings</h4>
                <form action="addRating.php" method="post">
                  <div class="w3-row w3-margin-bottom">
                    <div class="w3-col m10 w3-center ui-widget">
                      <input class="w3-input w3-border" id="movieToRate" placeholder="Enter movie title" name='movieTitle' required>
                      <input id="userID" name='userID' value="<?php echo $user_id; ?>" style='display:none' required>
                    </div>
                    <div class="w3-col m2" style="text-align:right">
                      <button class="w3-btn w3-theme" type="button" onclick="rateOpen()" style="padding-top: 9px;padding-bottom: 9px;" id="postButton">Next</button>
                    </div>
                  </div>
                  <div class="w3-margin" id='rating' class='j-rating' style='display:none;'>
                    <label class="w3-label">Rate the movie</label><br>
                    <input type="radio" name="rate" required value="1"><label class='w3-margin-left w3-margin-right'>1</label>
              			<input type="radio" name="rate" required value="2"><label class='w3-margin-left w3-margin-right'>2</label>
              			<input type="radio" name="rate" required value="3"><label class='w3-margin-left w3-margin-right'>3</label>
              			<input type="radio" name="rate" required value="4"><label class='w3-margin-left w3-margin-right'>4</label>
              			<input type="radio" name="rate" required value="5"><label class='w3-margin-left w3-margin-right'>5</label>
                    <br><br>
                    <button class="w3-btn w3-theme" type="submit" style="padding-top: 9px;padding-bottom: 9px;"><i class="fa fa-check"></i> &nbsp;Submit</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="w3-card-2 w3-round w3-333">
              <div class="w3-container w3-padding w3-margin-top w3-margin-bottom">
                <h4 class="">Recommendations</h4>
                  <?php
                    $countQuery = "SELECT COUNT(rating) FROM ratings WHERE user_id=$user_id;";
                    $count = mysqli_fetch_array(mysqli_query($con, $countQuery), MYSQLI_ASSOC);
                    $entries = $count['COUNT(rating)'];

                    if ($entries > 10) {
                      echo "<ol>";
                        include 'includes/rec_api.php';
                        foreach ($recommendations as $movie) {
                        	echo "<li>" . $movie->title . "</li>";
                        }
                      echo "</ol>";
                    } else {
                      echo "You need to add " . (10 - $entries) . " more entries to see your recommmendations.";
                    }
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div><!-- Right Column -->
      <div class="w3-col m4">
        <div class="w3-card-2 w3-round w3-333">
          <div class="w3-container w3-padding-bottom-big w3-margin-bottom">
            <h4 class="">Your Ratings</h4>
            <?php
              if ($entries == 0) {
                echo "<center><img src='images/User-invisible.svg.png' width='200px' style='opacity:0.8;margin-left:auto;margin-right:auto'>";
                echo "<br>";
                echo "No entries yet.</center>";
              } else {
                include 'includes/history.php';
                while ($row = mysqli_fetch_array($historyQuery, MYSQLI_ASSOC)){
                  echo $row['movie_title'] . ' || Rate: ' . $row['rating'];
                  echo "<br>";
                }
              }
            ?>
          </div>
        </div><!-- End Right Column -->
      </div><!-- End Grid -->
    </div><!-- End Page Container -->
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
var user_id = <?php echo $_GET['id']; ?>;

if (loggedIn == 'true') {
  $('#userarea').text('Dashboard');
  $('#userarea').attr('href', 'dashboard.php');
}

function rateOpen() {
  if ($('#movieToRate').val() != '') {
    $('#rating').show();
  } else {
    alert('Enter movie title');
  }
}

function showValue() {
  var sliderValue = $('#rateSlider').val();
  $('#value').html = sliderValue;
}
</script>
<script>
$(function() {
  var availableTags = [
    <?php
    include 'includes/dbConnection.php';
    $search = "SELECT * FROM recommendationDB.movie_info";
    $searchQuery = mysqli_query($con, $search);
    $searchMovies = mysqli_fetch_array($searchQuery, MYSQLI_ASSOC);
    echo json_encode($searchMovies['movie_title']);
    while ($searchMovies = mysqli_fetch_array($searchQuery, MYSQLI_ASSOC)){
      echo ',' . json_encode(utf8_encode($searchMovies['movie_title']));
    }
    ?>
  ];
  $( "#movieToRate" ).autocomplete({
    source: availableTags
  });
});
</script>
<script src="scripts/loggedIn.js"></script>
</html>
