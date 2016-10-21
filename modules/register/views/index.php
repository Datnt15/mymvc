<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
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
				<legend class="text-center">Register Form</legend>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="username">Username</label>  
					<div class="col-md-5">
						<input id="username" name="username" type="text" placeholder="john_name" class="form-control input-md" required="" pattern="[A-Za-z_0-9-]{3,15}[^'\x22\s@!]+">
					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="user_email">Email</label>  
					<div class="col-md-5">
						<input id="user_email" name="user_email" type="email" placeholder="eample@gmail.com" class="form-control input-md" required="">
					</div>
				</div>

				<!-- Password input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="password">Password</label>
					<div class="col-md-5">
						<input id="password" name="password" type="password" placeholder="" class="form-control input-md" required="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}[^'\x22\s@!]+">
					</div>
				</div>

				<!-- Button -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="register"></label>
					<div class="col-md-4">
						<button id="register" name="register" class="btn btn-primary">
							Register
						</button>
					</div>
				</div>
			</fieldset>
		</form>

	</div>

</body>
</html>

