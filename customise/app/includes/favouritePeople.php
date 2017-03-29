<script>
var id = <?php echo json_encode($person); ?>;
var apiUrl = 'http://www.myapifilms.com/imdb/idIMDB?idName=' + id + '&token=72dff507-0f89-4d9a-b53b-6f83e8d7e6ac&format=json&language=en-us&filmography=1&bornDied=0&starSign=0&uniqueName=0&actorActress=0&actorTrivia=0&actorPhotos=0&actorVideos=0&salary=0&spouses=0&tradeMark=0&fullSize=0'

$.when(
	$.get(apiUrl, function(results) { }, 'jsonp')
).then(function(results){
$('#people').append("<div class='w3-row w3-margin-top'>" +
		"<div class='w3-col m6 w3-center'>" +
			"<h4 class='w3-center'>" + results.data.names[0].name + "</h4>" + 
			"<img src='" + results.data.names[0].urlPhoto + "' width=150px>" +
		"</div>" +
		"<div class='w3-col m6'>" +
			"<p id='replace'>" + results.data.names[0].bio + "</p>" + 
			"<h4>Latest Projects</h4>" +
				"<ul>" +
					"<li><a href='http://www.imdb.com/title/" + results.data.names[0].filmographies[0].filmography[0].imdbid + "'>" + results.data.names[0].filmographies[0].filmography[0].title + "</a></li>" +
					"<li><a href='http://www.imdb.com/title/" + results.data.names[0].filmographies[0].filmography[1].imdbid + "'>" + results.data.names[0].filmographies[0].filmography[1].title + "</a></li>" +
					"<li><a href='http://www.imdb.com/title/" + results.data.names[0].filmographies[0].filmography[2].imdbid + "'>" + results.data.names[0].filmographies[0].filmography[2].title + "</a></li>" +
				"</ul>" +
				"<a href='http://www.imdb.com/name/" + results.data.names[0].idIMDB + "' class='w3-btn' target='_blank'>More</a>" + 
		"</div>" + 
	"</div>" +
	"<hr class='divider'>"
);
$('#loadingIcon').hide();
});
</script>