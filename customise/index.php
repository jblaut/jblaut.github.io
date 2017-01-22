<?php ?>
<html>
	<head>
		<title>Customise</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet" integrity="sha384-+ENW/yibaokMnme+vBLnHMphUYxHs34h9lpdbSLuAwGkOKFRl4C34WkjazBtb7eT" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="main.css">
	</head>
	<body>
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <a class="navbar-brand" href="#">CUSTOMISE</a>
			    </div>
			  </div>
			</nav>
			<div class="main">
				<div class="jumbotron">
				  <h1>Customise</h1>

				  <p>Customisable TV recommendation service.</p>

					<div class="registration-login-panels">
						<div class="panel panel-primary panel-login">
						  <div class="panel-heading">
						    <h3 class="panel-title">Login</h3>
						  </div>
							
						  <div class="panel-body">
								<form class="form-horizontal" name="login" onsubmit="return validateForm()" action="" method="post">
								  <fieldset>
								    <div class="form-group">
								      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
								      <div class="col-lg-10">
									        <input type="text" class="form-control email-address" id="inputEmail" name="email" placeholder="Email">
													<span id="incorrect-email" class="help-block hidden-by-default">E-mail format is incorrect.</span>
													<span id="missing-email" class="help-block hidden-by-default">Please enter your e-mail.</span>
								      </div>
								    </div>
										
								    <div class="form-group">
								      <label for="inputPassword" class="col-lg-2 control-label">Password</label>
								      <div class="col-lg-10">
								        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
								      </div>
								    </div>
										
								    <div class="form-group">
								      <div class="col-lg-10 col-lg-offset-2">
								        <button type="submit" class="btn btn-link">Forgotten Password</button>
								        <button type="submit" class="btn btn-default">Register</button>
								        <button type="submit" class="btn btn-primary">Submit</button>
								      </div>
								    </div>
								  </fieldset>
								</form>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
			<script>
				var hiddenByDefault = $('.hidden-by-default');
				var email = $('.email-address');
				var incorrectEmail = $('#incorrect-email');
				var missingEmail = $('#missing-email');
				hiddenByDefault.hide();
				
				email.focusout('input', function() {					
						if (email.val() == "" || email.val() == null) {
								email.parent().addClass("has-error");
								missingEmail.show();
								incorrectEmail.hide();
						} else {
								missingEmail.hide();
								var pattern = /[a-z]+[A-Z]*[0-9]*\b@\b\b[a-z]+\b\b.\b[a-z]+/;
								if (pattern.test(email.val())) {
									email.parent().removeClass("has-error");
									incorrectEmail.hide();
								} else {
									email.parent().addClass("has-error");
									incorrectEmail.show();
								}
						}
				});
			</script>
	</body>
</html>