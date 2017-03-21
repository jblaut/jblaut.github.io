<script>
var id = <?php echo json_encode($movie); ?>;
var apiUrl = 'http://www.omdbapi.com/?i=' + id;
$.when(
	$.get(apiUrl, function(results) { }, 'jsonp')
).then(function(results){
$('#movies').append(
	"<div class='w3-row w3-margin-top'>" +
		"<div class='w3-col m6 w3-center'>" +
			"<h4 class='w3-center'>" + results.Title + "</h4>" + 
			"<img src='" + results.Poster + "' width=150px>" +
		"</div>" +
		"<div class='w3-col m6'>" +
			"<p>" + results.Plot + "</p>" + 
			"<a href='http://www.imdb.com/title/" + results.imdbID + "' class='w3-btn' target='_blank'>More</a>" + 
		"</div>" + 
	"</div>" +
	"<hr class='divider'>"
);
});
</script>