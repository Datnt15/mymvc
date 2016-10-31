<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
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
			<div class="login col-md-6 col-sm-6 col-xs-12">
				<?php if ( isset( $this->data['message'] )): ?>
					<div class="alert alert-success" style="margin: 20px;">
	                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	                    <?php echo $this->data['message']; ?>
	                </div>
	            <?php endif; ?>
				<h1 class="text-center"><b>Đăng nhập</b></h1>
				<p class="des text-center"><i>vào tài khoản của bạn</i></p>
				<input type="checkbox" class="hidden" id="toggle-form" name="toggle-form">
				<form id="login-form" method="POST" action="<?= BASE_URL . 'login/check_login' ?>" >

					<!-- Username -->
					<div class="form-group">
						<label for="username">Tên đăng nhập</label>
						<input type="text" name="username" id="username" class="form-control"  data-toggle="tooltip" data-placement="top" title="">
					</div>

					<!-- Password -->
					<div class="form-group">
						<label for="password">Mật khẩu</label>
						<input type="password" name="password" id="password" class="form-control"  data-toggle="tooltip" data-placement="top" title="">
					</div>


					<!-- Remember me checkbox -->
					<div class="checkbox">
					  	<label>
					  		<input type="checkbox" name="remember" id="remember" value="">Lưu đăng nhập
					  	</label>
					</div>

					<!-- Access Token -->
					<input type="hidden" name="access_token" id="access_token" value="<?php echo $this->data["access_token"]; ?>">

					<input type="submit" id="login-btn" value="Đăng nhập" class="btn-login">
				</form>
				
				
	            <form id="forgot-pass-form" method="POST" action="<?= BASE_URL;?>login/forgot_pass" >

					<!-- Username -->
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control"  data-toggle="tooltip" data-placement="top" title="">
					</div>
					<!-- Access Token -->
					<input type="hidden" name="access_token" id="access_token" value="<?php echo $this->data["access_token"]; ?>">
					<input type="submit" value="Gửi email cho tôi" class="btn-login">

				</form>
				
				<label for="toggle-form" class="forgot-pass text-center">
					<i>Quên mật khẩu?</i>
				</label>
				<div class="row">
	            	<div class="col-md-12" id="results">
	            		
	            	</div>
	            </div>
			</div>
			<div class="block-or">Hoặc</div>
			<div class="sign-in-social col-md-6 col-sm-6 col-xs-12 text-center">
				<h1><b>Đăng ký</b></h1>
				<p class="des"><i>Với một trang các tài khoản<br>mạng xa hội</i></p>
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
				<p class="dont-have-account"><i>Không có tài khoản?</i></p>
				<a href="<?= BASE_URL?>register" class="register-redirect"><i>Đăng ký</i></a>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
</body>
</html>