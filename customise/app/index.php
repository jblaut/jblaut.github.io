<?php
  session_start();
  
  $loggedIn = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
  $username = isset($_SESSION['username']) ? $_SESSION['username'] : 'false';
?>
<!DOCTYPE html>
<html lang="en-gb">
<title>Customise - Home</title>
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
    <a class="w3-text-white w3-button" style="background-color:#283142"><b><i class="fa fa-arrows w3-margin-right"></i>Customise</b></a>
    <a href="index.php" class="w3-text-white j-hover-darkish-blue w3-button">Home</a>
    <a href="user-area.php" class="w3-text-white j-hover-darkish-blue w3-button" id="userarea">User Area</a>
    <a href="logout.php" id="loggedIn" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red w3-button" style="display:none">
      <i class="fa fa-user"></i>
    </a>
  </div>
  <!-- Navigation Bar -->

  <div class="w3-container w3-content j-search-box">
    <div class="w3-row">
      <div class="w3-col m1">
        <br>
      </div>
      <div class="w3-col m10">
        <div class="j-search-border">
          <h3>Search by Actor or Movie Title</h3>
          <div class="w3-row-padding" style="margin:0 -16px;">
          	<form action="results.php" method="get">
          		<div class="w3-threequarter" style="padding-left:10px">
          			<input class="w3-input" name="search" type="text" placeholder="Search for movies or actors">
                <div class="j-radio-buttons">
            			<input type="radio" name="searchType" required value="movie"><label>Movie</label>
            			<input type="radio" name="searchType" required value="person"><label>Person</label>
                </div>
          		</div>
          		<div class="w3-quarter w3-center" style="padding-left:10px">
          			<button class="w3-btn w3-center w3-dark-grey">Search</button>
          		</div>
          	</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="j-features-1">
  <div class="w3-container w3-content">
    <div class="w3-row">
      <div class="w3-col m5">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tortor risus, consectetur eu erat ut, pretium vestibulum urna. Cras at venenatis felis. Maecenas id quam sit amet lectus tincidunt auctor. Vivamus hendrerit fermentum massa, vel facilisis metus tristique et. Curabitur consectetur ex nec imperdiet bibendum. Ut suscipit id libero eu dignissim. Cras a mattis elit, non elementum ipsum.
      </div>
      <div class="w3-col m7">

      </div>
    </div>
  </div>
</div>
<div class="j-features-2">
  <div class="w3-container w3-content">
    <div class="w3-row">
      <div class="w3-col m6">
        <br>
      </div>
      <div class="w3-col m5">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tortor risus, consectetur eu erat ut, pretium vestibulum urna. Cras at venenatis felis. Maecenas id quam sit amet lectus tincidunt auctor. Vivamus hendrerit fermentum massa, vel facilisis metus tristique et. Curabitur consectetur ex nec imperdiet bibendum. Ut suscipit id libero eu dignissim. Cras a mattis elit, non elementum ipsum.
      </div>
    </div>
  </div>
</div>
<div class="j-features-1">
  <div class="w3-container w3-content">
    <div class="w3-row">
      <div class="w3-col m5">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tortor risus, consectetur eu erat ut, pretium vestibulum urna. Cras at venenatis felis. Maecenas id quam sit amet lectus tincidunt auctor. Vivamus hendrerit fermentum massa, vel facilisis metus tristique et. Curabitur consectetur ex nec imperdiet bibendum. Ut suscipit id libero eu dignissim. Cras a mattis elit, non elementum ipsum.
      </div>
      <div class="w3-col m7">

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
}
</script>
<script src="scripts/loggedIn.js"></script>
</html>
