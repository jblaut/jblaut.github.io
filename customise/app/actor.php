<?php 
	session_start();
	
	$searchQuery = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en-gb">
<title>Customise - <?php echo strtoupper($searchQuery); ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="icon" type="image/png" href="images/favicon.png">
<script src="bower_components/jquery/dist/jquery.js"></script>
<script src="scripts/main.js"></script>
<body class="w3-light-grey">

<!-- Navigation Bar -->
<ul class="w3-navbar w3-black w3-border-bottom w3-large">
  <li><a class="w3-text-white w3-red"><b><i class="fa fa-arrows w3-margin-right"></i>Customise</b></a></li>
  <li><a href="/" class="w3-text-white w3-hover-blue-grey">Home</a></li>
  <li><a href="features.html" class="w3-text-white w3-hover-blue-grey">Features</a></li>
  <li><a href="user-area.html" class="w3-text-white w3-hover-blue-grey">User Area</a></li>
</ul>


<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:20px">    
  <div class="w3-center">
		<i class="fa fa-refresh fa-spin" style="font-size:48px" id="loadingIcon"></i>
	</div>
	<!-- The Grid -->
  <div class="w3-row" id="results">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card-2 w3-round w3-white">
        <div class="w3-container">
         <h3 class="w3-center" id="name"></h4>
         <p class="w3-center" id="photo"></p>
         <hr>
         <p id="placeOfBirth"><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> </p>
         <p id="dateOfBirth"><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> </p>
        </div>
      </div>
      <br>
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m5">
      <div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="margin-top:0 !important;">
        <h4 id="filmographyTitle">Biography</h1>
				<p id="bio"></p>
      </div> 
      
    <!-- End Middle Column -->
    </div>
		
    <!-- Right Column -->
    <div class="w3-col m4">
      <div class="w3-container w3-card-2 w3-white w3-round">
				<h4 id="filmographyTitle">Filmography</h1>
				<ul id="filmographyList"></ul>
      </div> 
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>

<!-- Footer -->
<footer class="w3-container w3-center w3-opacity w3-margin-bottom">
	<hr>
  <h5>Find Us On</h5>
  <div class="w3-xlarge w3-padding-16">
    <i class="fa fa-facebook-official w3-hover-text-indigo"></i>
    <i class="fa fa-instagram w3-hover-text-purple"></i>
    <i class="fa fa-snapchat w3-hover-text-yellow"></i>
    <i class="fa fa-pinterest-p w3-hover-text-red"></i>
    <i class="fa fa-twitter w3-hover-text-light-blue"></i>
    <i class="fa fa-linkedin w3-hover-text-indigo"></i>
  </div>
  <!-- <p>Powered by <a href="http://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">w3.css</a></p> -->
</footer>

<script>
	var searchQuery = <?php echo json_encode($searchQuery); ?>;
	searchQuery = searchQuery.replace(" ", "+");
	searchQuery = searchQuery.toLowerCase();
	 
	var apiUrl = "http://www.myapifilms.com/imdb/idIMDB?name=" + searchQuery + "&token=72dff507-0f89-4d9a-b53b-6f83e8d7e6ac&format=json&language=en-us&filmography=1&exactFilter=0&limit=1&bornDied=0&starSign=0&uniqueName=0&actorActress=1&actorTrivia=0&actorPhotos=0&actorVideos=0&salary=0&spouses=0&tradeMark=0&personalQuotes=0&starMeter=0&fullSize=0";
	
	$.when(
		$.get(apiUrl, function(results) { }, 'jsonp')
	).then(function(results){
		document.getElementById("results").style.display = "block";
		var data = results.data.names[0];
	
		$("#name").append(data.name);
		$("#bio").append(data.bio);
		$("#placeOfBirth").append(data.placeOfBirth);
		$("#dateOfBirth").append(data.dateOfBirth);
		document.getElementById("photo").innerHTML = "<img src='" + data.urlPhoto + "' style='width:106px' />";
		document.getElementById("loadingIcon").style.display = "none";

		var filmography = data.filmographies[0];
		
		for (var i = 0; i < filmography.filmography.length; i++) {
			var films = filmography.filmography[i].title;
			films = films.split(" ").join("+");
			films = films.split("'").join("%27");
			films = films.split("&").join("%26");
			films = films.toLowerCase();

			$("#filmographyList").append("<li><a href='/movie.php?id=" + films + "'>" + filmography.filmography[i].title + "</a></li>");
		}
	});
	
	if (document.getElementById("name").innerHTML == "") {
		document.getElementById("loadingIcon").style.display = "block";
		document.getElementById("results").style.display = "none";
	}
</script>
<?php session_destroy(); ?>
</body>
</html>
