<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Cập nhật lại mật khẩu</title>
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
				
				<h1 class="text-center"><b>Cập nhật mật khẩu</b></h1>
				
				
	            <form id="reset-pass-form" method="POST" >

					<!-- Username -->
					<div class="form-group">
						<label for="password">Mật khẩu mới</label>
						<input type="password" name="password" id="password" class="form-control" data-toggle="popover" title="Độ mạnh mật khẩu" data-content="Vui lòng nhập mật khẩu...">
					</div>
					<!-- Access Token -->
					<input type="hidden" name="access_token" id="access_token" value="<?php echo $this->data; ?>">
					<input type="submit" name="reset" value="Cập nhật" class="btn-login">

				</form>
				
				
				<div class="row">
	            	<div class="col-md-12" id="results">
	            		
	            	</div>
	            </div>
			</div>
			<div class="block-or">Hoặc</div>
			<div class="sign-in-social col-md-6 col-sm-6 col-xs-12 text-center">
				<h1><b>Đăng ký</b></h1>
				<p class="des"><i>với một trong các tài khoản<br></i></p>
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