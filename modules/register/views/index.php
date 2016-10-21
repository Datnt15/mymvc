<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<base href="<?php echo base_url; ?>">
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
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
	            <div class="wrap">
	                <p class="form-title">
	                    Login</p>
	                <form class="login" id="login-form" method="POST" action="<?= base_url . 'login/check_login' ?>" >
	                	<div class="form-group">
			                <i class="fa fa-lg fa-user" aria-hidden="true"></i>
			                <input type="text" name="username" id="username" placeholder="Username or Email" pattern="[A-Za-z_0-9-]{3,15}[^'\x22\s@!]+" title="Chỉ chứa số, chữ hoa, chữ thường, gạch dưới '_', gạch nối '-' dài tối thiểu 3 đến 15 ký tự và không được chứa dấu @, !, ', '' hay khoảng trắng" required />
	                	</div>

	                	<div class="form-group">
	                		<i class="fa fa-lg fa-lock" aria-hidden="true"></i>
		                	<input type="password" name="password" id="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}[^'\x22\s@!]+" title="Chứa ít nhât một số, chữ hoa, chữ thường và dài tối thiểu 4 ký tự và không được chứa dấu @, !, ', '' hay khoảng trắng" required />
		                </div>
		                <input type="submit" value="Login" id="login-btn" class="btn btn-danger btn-lg" />

		                <div class="row">
                            <div class="col-md-6 col-xs-6 col-sm-6">
                            	<a href="<?= base_url?>login" class="transparent pull-left">Have an account</a>
                           	</div>
                            <div class="col-md-6 col-xs-6 col-sm-6">
                            	<a href="<?= base_url?>" class="transparent pull-right">Pass this</a>
                            </div>		                        
		                </div>
		                <div class="row">
		                	<div class="col-md-12" id="results">
		                		
		                	</div>
		                </div>
	                </form>
	            </div>
	        </div>
	    </div>
	    <div class="clearfix"></div>
	</div>
</body>
</html>