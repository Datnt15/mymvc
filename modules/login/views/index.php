<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container">
		
		<form class="form-horizontal">
			<fieldset>

				<!-- Form Name -->
				<legend class="text-center">Login Form</legend>

				<!-- Username -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="username">Username</label>  
					<div class="col-md-5">
						<input id="username" name="username" type="text" placeholder="john_name" class="form-control input-md" required="">

					</div>
				</div>

				<!-- Password -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="password">Password</label>
					<div class="col-md-5">
						<input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="">

					</div>
				</div>

				<!-- Button (Double) -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="login"></label>
					<div class="col-md-8">
						<button id="login" name="login" class="btn btn-primary">
							Login
						</button>
						<a href="<?= base_url ?>register" class="btn btn-primary">
							Register
						</a>
					</div>
				</div>

			</fieldset>
		</form>
	</div>

</body>
</html>

