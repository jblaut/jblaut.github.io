<?php 
	session_start();
	
	$searchQuery = $_GET['id'];
	$loggedIn = isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : 'false';
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'false';
?>
<!DOCTYPE html>
<html lang="en-gb">
<title>Customise - <?php echo strtoupper($searchQuery); ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
<body>

<div class="j-intro">
	<div class="w3-bar" id="myNavbar">
    <a class="w3-text-white w3-button" style="background-color:#283142"><b><i class="fa fa-arrows w3-margin-right"></i>Customise</b></a>
    <a href="index.php" class="w3-text-white j-hover-darkish-blue w3-button">Home</a>
    <a href="user-area.php" class="w3-text-white j-hover-darkish-blue w3-button">User Area</a>
    <a href="logout.php" id="loggedIn" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red w3-button" style="display:none">
      <i class="fa fa-user"></i>
    </a>
  </div>
	<div class="w3-container w3-content j-results" style="max-width:1400px;margin-top:20px">
	  <div class="w3-center j-spinner-padding" id="loadingIcon">
			<i class="fa fa-refresh fa-spin" style="font-size:48px"></i>
		</div>
		
	  <div class="w3-row" id="personresults">
	    <div class="w3-col m3">
	      <div class="w3-card-2 j-results-border">
	        <div class="w3-container">
	         <h3 class="w3-center j-results-title" id="name"></h4>
	         <p class="w3-center j-results-image" id="photo"></p>
					 <div class='w3-center' id='personfave'>
						 <a id="addToFavesLinkPerson">
							 <i class="fa fa-plus-square-o addtofaves" aria-hidden="true" style="display:inline"></i>
							 <p id="personlabel" class="favouriteslabel" style="display:none">Add to Favourites</p>
						 </a>
					 </div>
	         <hr>
	         <p id="placeOfBirth"><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> </p>
	         <p id="dateOfBirth"><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> </p>
	        </div>
	      </div>
	    </div>
    
	    <div class="w3-col m5">
	      <div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="margin-top:0 !important;">
	        <h4 id="filmographyTitle">Biography</h4>
					<p id="bio"></p>
	      </div> 
	    </div>
		
	    <div class="w3-col m4">
	      <div class="w3-card-2 j-results-border_filmography">
					<h3 id="filmographyTitle" class="j-results-filmography-title">Filmography</h3>
					<ul class="j-results-filmography" id="filmographyList"></ul>
	      </div> 
	    </div>
	  </div>
	</div>
</div>

<footer>
  <div class="w3-center">
    Created by J. Blaut
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="scripts/main.js"></script>
<script>
	var loggedIn = <?php echo isset($_SESSION['logged_in']) ? json_encode($_SESSION['logged_in']) : 'bkasdas'; ?>;
	var searchQuery = <?php echo json_encode($searchQuery); ?>;
	searchQuery = searchQuery.replace(" ", "+");
	searchQuery = searchQuery.toLowerCase();

	var apiUrl = "http://www.myapifilms.com/imdb/idIMDB?name=" + searchQuery + "&token=72dff507-0f89-4d9a-b53b-6f83e8d7e6ac&format=json&language=en-us&filmography=1&exactFilter=0&limit=1&bornDied=0&starSign=0&uniqueName=0&actorActress=1&actorTrivia=0&actorPhotos=0&actorVideos=0&salary=0&spouses=0&tradeMark=0&personalQuotes=0&starMeter=0&fullSize=0";
	
	$.when(
		$.get(apiUrl, function(results) { }, 'jsonp')
	).then(function(results){
		document.getElementById("personresults").style.display = "block";
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
		
			$("#filmographyList").append("<li><a href='movie.php?id=" + films + "'>" + filmography.filmography[i].title + "</a></li>");
		}
		
		console.log(filmography.filmography.length);
		console.log(data.bio.length);
		
		if (filmography.filmography.length < 20 && data.bio.length < 2000) {
			$('.j-results').css('padding-top','200px');
			$('.j-results').css('padding-bottom','200px');
		}
	});
	
	var addToFavesLink = 'favourite.php?id=' + data.idIMDB;
	
	$('#addToFavesLinkMovie').attr('href', addToFavesLink);
	
	if (document.getElementById("name").innerHTML == "") {
		document.getElementById("loadingIcon").style.display = "block";
		document.getElementById("personresults").style.display = "none";
	}
	
	var loggedIn = <?php echo json_encode($loggedIn); ?>;
	var username = <?php echo json_encode($username); ?>;

	if (loggedIn == 'true') {
		$('#personfave').show();
	}
	
	$("#personlabel").hide();
	$("#personfave").mouseenter(function(){
			$("#personlabel").show('slow');
	});
	$("#personfave").mouseleave(function(){
			$("#personlabel").hide('slow');
	});
</script>
<script src="scripts/loggedIn.js"></script>
</body>
</html>
