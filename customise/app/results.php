<?php 
	session_start();
	
	$searchQuery = $_GET['search'];
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
					 <div class='w3-center w3-hide' id='personfave'>
						 <a id='addToFavesLinkPerson'>
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
		
		<div class="w3-row" id="movieresults">
			<div class="w3-col m3">
				<div class="w3-card-2 j-results-border">
					<div class="w3-container">
					 <h3 class="w3-center j-results-title" id="title"></h4>
					 <p class="w3-center j-results-image" id="poster"></p>
					 <div class='w3-center w3-hide' id='moviefave'>
						 <a id='addToFavesLinkMovie'>
							 <i class="fa fa-plus-square-o addtofaves" aria-hidden="true" style="display:inline"></i>
							 <p id="movielabel" class="favouriteslabel" style="display:none">Add to Favourites</p>
						 </a>
					 </div>
					 <hr>
					 <p id="place"><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> </p>
					 <p id="date"><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> </p>
					</div>
				</div>
				<br>
			</div>
		
			<div class="w3-col m5">
				<div class="w3-container w3-card-2 w3-white w3-round w3-margin" style="margin-top:0 !important;">
					<h4 id="bioTitle">Description</h4>
					<p id="plot"></p>
				</div> 
			</div>
		
			<div class="w3-col m4">
				<div class="w3-card-2 j-results-border_filmography">
					<h3 class="j-results-filmography-title" id="filmographyTitle">Cast</h3>
					<ul class="j-results-filmography" id="actorsList"></ul>
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
	var type = <?php echo json_encode($_GET['searchType']); ?>;
	var searchQuery = <?php echo json_encode($searchQuery); ?>;
	searchQuery = searchQuery.replace(" ", "+");
	searchQuery = searchQuery.toLowerCase();
	
	if (type == 'person') {
		var apiUrl = "http://www.myapifilms.com/imdb/idIMDB?name=" + searchQuery + "&token=72dff507-0f89-4d9a-b53b-6f83e8d7e6ac&format=json&language=en-us&filmography=1&exactFilter=0&limit=1&bornDied=0&starSign=0&uniqueName=0&actorActress=1&actorTrivia=0&actorPhotos=0&actorVideos=0&salary=0&spouses=0&tradeMark=0&personalQuotes=0&starMeter=0&fullSize=0";
	} else {
		apiUrl = "http://www.myapifilms.com/imdb/idIMDB?title=" + searchQuery + "&token=72dff507-0f89-4d9a-b53b-6f83e8d7e6ac&format=json&language=en-us&aka=0&business=0&seasons=0&seasonYear=1&technical=0&filter=2&exactFilter=0&limit=1&forceYear=0&trailers=1&movieTrivia=0&awards=0&moviePhotos=0&movieVideos=0&actors=1&biography=0&uniqueName=0&filmography=0&bornAndDead=0&starSign=0&actorActress=0&actorTrivia=0&similarMovies=0&adultSearch=0&goofs=0&keyword=0&quotes=0&fullSize=0&companyCredits=0&filmingLocations=0";
	}
	
	$.when(
		$.get(apiUrl, function(results) { }, 'jsonp')
	).then(function(results){
		if (type == 'person') {
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
			
			if (filmography.filmography.length < 20 && data.bio.length < 2000) {
				$('.j-results').css('padding-top','200px');
				$('.j-results').css('padding-bottom','200px');
			}
			var name = data.name;
			var addToFavesLink = 'favourite.php?id=' + data.idIMDB + '&name=' + name.replace(/ /g, "+");
			
			$('#addToFavesLinkPerson').attr('href', addToFavesLink);
		} else {
			document.getElementById("movieresults").style.display = "block";
			function dateFormat(dateAPI) {
				var date = dateAPI;
				date = date.toString();
				var year = date.substr(0,4);
				var month = date.substr(4,2);
				var day = date.substr(6,2);
				var monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

				if (day.endsWith("1") && !day.startsWith("1")) {
					var indicator = "st";
				} else if (day.endsWith("2") && !day.startsWith("1")) {
					var indicator = "nd";
				} else if (day.endsWith("3") && !day.startsWith("1")) {
					var indicator = "rd";
				} else {
					var indicator = "th";
				}

				if (day.startsWith("0")) {
					day = day.substr(1,1);
				}

				var fullDate = day + indicator + " " + monthNames[month - 1] + " " + year;
				return fullDate;
			}

			var data = results.data.movies[0];
			var date = dateFormat(data.releaseDate);
			
			$("#title").append(data.title);
			$("#plot").append(data.plot);
			$("#date").append(date);
			$("#place").append(data.countries[0]);
			document.getElementById("poster").innerHTML = "<img src='" + data.urlPoster + "' style='width:106px' />";
			document.getElementById("loadingIcon").style.display = "none";

			var actors = data.actors[0];

			for (var i = 0; i < data.actors.length; i++) {
				var actors = data.actors[i].actorName;
				actors = actors.split(" ").join("+");
				actors = actors.split("'").join("%27");
				actors = actors.split("&").join("%26");
				actors = actors.toLowerCase();

				$("#actorsList").append("<li><a href='actor.php?id=" + actors + "'>" + data.actors[i].actorName + "</a></li>");
			}
			
			if (data.actors.length < 20 && data.plot.length < 2000) {
				$('.j-results').css('padding-top','200px');
				$('.j-results').css('padding-bottom','200px');
			}
			
			var title = data.title;
			var addToFavesLink = 'favourite.php?id=' + data.idIMDB + '&name=' + title.replace(/ /g, "_"); 
			
			$('#addToFavesLinkMovie').attr('href', addToFavesLink);
		}
	});
	
	if (document.getElementById("name").innerHTML == "") {
		document.getElementById("loadingIcon").style.display = "block";
		document.getElementById("personresults").style.display = "none";
		document.getElementById("movieresults").style.display = "none";
	}
	
	var loggedIn = <?php echo json_encode($loggedIn); ?>;
	var username = <?php echo json_encode($username); ?>;

	if (loggedIn == 'true') {
		if (type == 'movie') {
			$('#moviefave').show();
		} else if (type == 'person') {
			$('#personfave').show();
		}
	}
	
	$("#movielabel").hide();
	$("#moviefave").mouseenter(function(){
			$("#movielabel").show('slow');
	});
	$("#moviefave").mouseleave(function(){
			$("#movielabel").hide('slow');
	});
	
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
