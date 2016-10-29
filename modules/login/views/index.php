<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
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
				<?php if ( isset( $this->data['message'] )): ?>
					<div class="alert alert-success" style="margin: 20px;">
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                    <?php echo $this->data['message']; ?>
	                </div>
	            <?php endif; ?>
				<h1 class="text-center"><b>Login</b></h1>
				<p class="des text-center"><i>to your account</i></p>
				<input type="checkbox" class="hidden" id="toggle-form" name="toggle-form">
				<form id="login-form" method="POST" action="<?= base_url . 'login/check_login' ?>" >

					<!-- Username -->
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control"  data-toggle="tooltip" data-placement="top" title="">
					</div>

					<!-- Password -->
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control"  data-toggle="tooltip" data-placement="top" title="">
					</div>


					<!-- Remember me checkbox -->
					<div class="checkbox">
					  	<label>
					  		<input type="checkbox" name="remember" id="remember" value="">Remember me
					  	</label>
					</div>

					<!-- Access Token -->
					<input type="hidden" name="access_token" id="access_token" value="<?php echo $this->data["access_token"]; ?>">

					<input type="submit" id="login-btn" value="LOG IN" class="btn-login">
				</form>
				
				
	            <form id="forgot-pass-form" method="POST" action="<?= base_url;?>login/forgot_pass" >

					<!-- Username -->
					<div class="form-group">
						<label for="email">Your Email</label>
						<input type="email" name="email" id="email" class="form-control"  data-toggle="tooltip" data-placement="top" title="">
					</div>
					<!-- Access Token -->
					<input type="hidden" name="access_token" id="access_token" value="<?php echo $this->data["access_token"]; ?>">
					<input type="submit" value="Send me" class="btn-login">

				</form>
				
				<label for="toggle-form" class="forgot-pass text-center">
					<i>Forgot Password?</i>
				</label>
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
				<p class="dont-have-account"><i>Don't have account?</i></p>
				<a href="<?= base_url?>register" class="register-redirect"><i>Register</i></a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
</body>
</html>