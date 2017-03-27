if (loggedIn == 'true' && username != 'false') {
	$('#loggedIn').show();
	$('#loggedIn').append(" " + username.toUpperCase());
	
	$("#loggedIn").mouseenter(function(){
		$('#loggedIn').html("Log Out");
	});
	$("#loggedIn").mouseleave(function(){
			$('#loggedIn').html('<i class="fa fa-user"></i> ' + username.toUpperCase());
	});
}