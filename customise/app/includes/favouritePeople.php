<script>
var id = <?php echo json_encode($person); ?>;
var apiUrl = 'http://imdb.wemakesites.net/api/' + id + '?api_key=755ead82-2b16-4cbe-9a1a-36d741e7b5cd'

$.when(
	$.get(apiUrl, function(results) { }, 'jsonp')
).then(function(results){
var bio = results.data.description;
var IMDBLink = "http://www.imdb.com/name/" + results.data.id + "/bio";
var bioLink = bio.replace(" See full bio &raquo;", "<a href='" + IMDBLink + "'>See full bio &raquo</a>");
console.log(bioLink);

$('#people').append("<div class='w3-row w3-margin-top'>" +
		"<div class='w3-col m6 w3-center'>" +
			"<h4 class='w3-center'>" + results.data.title + "</h4>" + 
			"<img src='" + results.data.image + "' width=150px>" +
		"</div>" +
		"<div class='w3-col m6'>" +
			"<p id='replace'>" + bioLink + "</p>" + 
			"<a href='http://www.imdb.com/name/" + results.data.id + "' class='w3-btn' target='_blank'>More</a>" + 
		"</div>" + 
	"</div>" +
	"<hr class='divider'>"
);
});
</script>