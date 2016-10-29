<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Resetting Password</title>
	<base href="<?php echo base_url; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<!-- <link rel="icon" href="favicon.ico" type="image/gif">
	<link rel="icon" href="favicon.ico" type="image/x-icon" /> -->
	<link rel="stylesheet" href="<?= base_url; ?>assets/css/animate.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>assets/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url; ?>assets/css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&subset=cyrillic,latin-ext,vietnamese" rel="stylesheet">
	<script src="<?= base_url; ?>assets/js/jquery-1.11.0.js"></script>
	<script src="<?= base_url; ?>assets/js/bootstrap.min.js"></script>
	<script src="<?= base_url; ?>assets/js/login.js"></script>

</head>
<body>
	<div id="login-page">
		<div class="form-login col-md-7 col-sm-9 col-xs-11">
			<div class="login col-md-6 col-sm-6 col-xs-12">
				
				<h1 class="text-center"><b>Reset password</b></h1>
				
				
	            <form id="reset-pass-form" method="POST" >

					<!-- Username -->
					<div class="form-group">
						<label for="password">Your password</label>
						<input type="password" name="password" id="password" class="form-control" data-toggle="popover" title="Password Strength" data-content="Enter Password...">
					</div>
					<!-- Access Token -->
					<input type="hidden" name="access_token" id="access_token" value="<?php echo $this->data; ?>">
					<input type="submit" name="reset" value="Reset" class="btn-login">

				</form>
				
				
				<div class="row">
	            	<div class="col-md-12" id="results">
	            		
	            	</div>
	            </div>
			</div>
			<div class="block-or">or</div>
			<div class="sign-in-social col-md-6 col-sm-6 col-xs-12 text-center">
				<h1><b>Sign In</b></h1>
				<p class="des"><i>with one of your social<br>profile</i></p>
				<div class="list-btn-social">
					<a href="" class="btn-social">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
					<a href="" class="btn-social">
						<i class="fa fa-facebook" aria-hidden="true"></i>
					</a>
					<a href="" class="btn-social">
						<i class="fa fa-google-plus" aria-hidden="true"></i>
					</a>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
</body>
</html>