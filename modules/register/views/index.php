<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Đăng ký tài khoản</title>
	<base href="<?php echo BASE_URL; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<!-- <link rel="icon" href="favicon.ico" type="image/gif">
	<link rel="icon" href="favicon.ico" type="image/x-icon" /> -->
	<link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/animate.min.css">
	<link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/login.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&subset=cyrillic,latin-ext,vietnamese" rel="stylesheet">
	<script src="<?= BASE_URL; ?>assets/js/jquery-1.11.0.js"></script>
	<script src="<?= BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	<script src="<?= BASE_URL; ?>assets/js/login.js"></script>

</head>
<body>
	
	<div id="login-page">
		<div class="form-login col-md-7 col-sm-9 col-xs-11">
			<div class="sign-up-social col-md-4 col-sm-4 col-xs-12 text-center">

				<!-- Intro -->
				<h1><b>Đăng ký</b></h1>

				<p class="des"><i>tài khoản mới</i></p>
				
				<p class="intro-sign-up">
					Et habitant ullamcorper adipiscing cubilia phasellus proin sagittis consequat suspendisse laoreet scelerisque.
				</p>
			</div>
			<div class="login register col-md-8 col-sm-8 col-xs-12">

				<!-- Registration form -->
				<form id="register-form" method="POST" action="<?= BASE_URL . 'register/register' ?>">
					
					<!-- Username -->
					<div class="form-group">
						<label for="username">Tên đăng nhập</label>
						<input type="text" name="username" id="username" class="form-control">
					</div>
					

					<!-- Email -->
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control">
					</div>


					<!-- Password -->
					<div class="form-group">
						<label for="password">Mật khẩu</label>
						<input type="password" name="password" id="password" class="form-control">
					</div>


					<!-- Terms and Conditions checkbox -->
					<div class="checkbox">
					  	<label>
					  		<input type="checkbox" value="">Tôi đã đọc và đồng ý với các 
					  		<a href="">điều khoản</a>
					  	</label>
					</div>


					<!-- Submit button -->
					<input id="register-btn" type="submit" value="Đăng ký" class="btn-register">
					
					
					<!-- Login link -->
					<span class="span-or">or</span>
					<a href="<?= BASE_URL;?>login" class="have-account"><i>Đã có tài khoản?</i></a>

					<!-- Results message -->
					<div class="row">
	                	<div class="col-md-12" id="results">
	                		
	                	</div>
	                </div>

				</form>
				
			</div>
			<div class="clearfix"></div>
		</div>
	</div>	

</body>
</html>