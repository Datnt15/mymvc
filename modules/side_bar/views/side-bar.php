<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<title>User Home Page</title>
	<link rel="stylesheet" href="<?= base_url; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url; ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url; ?>assets/css/dashboard.css">
    <script type="text/javascript" src="<?= base_url; ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url; ?>assets/js/main.js"></script>
	
</head>
<body>
	
	<div id="nav">
	<?php $user = $this->data['user']; ?>
	  <div class="user-banner"><img src="<?= base_url; ?>assets/images/default-avatar.png"/>
	    <h5 class="username"><?= $user['username'];?></h5>
	  </div>
	  <ul>
	    <li class="active"><a href="#"><i class="fa fa-tachometer" aria-hidden="true"></i><span>DASHBOARD</span></a></li>
	    <li><a href="#"><i class="fa fa-calculator" aria-hidden="true"></i><span class="swatch light-grey">COURSE</span></a></li>
	    <li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><span>EXAM</span></a></li>
	    <li><a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i><span>Q&A</span></a></li>
	    <li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i><span>NEWS</span></a></li>
	  </ul>
	</div>
	<div id="main">
	  <header>
	  	<div class="noti">
	  		<a href=""><i class="fa fa-user" aria-hidden="true"></i></a>
	  		<a href=""><i class="fa fa-commenting-o" aria-hidden="true"></i></a>
	  		<a href=""><i class="fa fa-bell-o" aria-hidden="true"></i><span class="new-noti">2</span></a>
	  	</div>
	  	<div class="search">
		    <input type="text" class="searchTerm" placeholder="Type of search">
		    <button type="submit" class="searchButton">
		        <i class="fa fa-search"></i>
		    </button>
		    <div class="clearfix"></div>
		</div>
	    <img src="<?= base_url; ?>assets/images/logo.png" class="logo-dashboard">
	  </header>
	  <div id="content">
	    <div class="profile">
	    	<img src="<?= base_url; ?>assets/images/default-avatar.png">
	    	<div class="about-me">
	    		<h1 class="name-pro"><b><?= $user['username']; ?></b></h1>
	    		<div class="rating">
					<span><i class="fa fa-star" aria-hidden="true"></i></span>
					<span><i class="fa fa-star" aria-hidden="true"></i></span>
					<span><i class="fa fa-star" aria-hidden="true"></i></span>
					<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
					<span><i class="fa fa-star-o" aria-hidden="true"></i></span>
				</div>
				<div class="job-info">
		    		<p class="job-pro">Student</p>
		    		<p><a href="" class="learn-more">Learn more</a></p>
				</div>
	    		<p class="exp-pro"><i class="fa fa-cog" aria-hidden="true"></i> 8,782 exp</p>
	    	</div>
	    	<div class="setting-pro">
	    		<a href="" data-toggle="modal" data-target="#edit-modal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
	    		<a href=""><i class="fa fa-sign-in" aria-hidden="true"></i></a>
	    		<div class="clearfix"></div>
	    	</div>
	    </div>
	    <div class="tab-panel-info">
	    	<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Knowledge</a></li>
			  <li><a data-toggle="tab" href="#menu1">Course</a></li>
			  <li><a data-toggle="tab" href="#menu2">Exam</a></li>
			  <li><a data-toggle="tab" href="#menu3">Q&A</a></li>
			  <li><a data-toggle="tab" href="#menu4">New</a></li>
			  <li><a data-toggle="tab" href="#menu5">Activity</a></li>
			</ul>
			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active">
			  </div>
			  <div id="menu1" class="tab-pane fade">
			    <h3>Menu 1</h3>
			    <p>Some content in menu 1.</p>
			  </div>
			  <div id="menu2" class="tab-pane fade">
			    <h3>Menu 2</h3>
			    <p>Some content in menu 2.</p>
			  </div>
			  <div id="menu3" class="tab-pane fade">
			    <h3>Menu 3</h3>
			    <p>Some content in menu 3.</p>
			  </div>
			  <div id="menu4" class="tab-pane fade">
			    <h3>Menu 4</h3>
			    <p>Some content in menu 4.</p>
			  </div>
			  <div id="menu5" class="tab-pane fade">
			    <h3>Menu 5</h3>
			    <p>Some content in menu 5.</p>
			  </div>
			</div>
	    </div>
	  </div>
	</div>

    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	    <div class="modal-dialog">
			<div class="editmodal-container">
				<img src="<?= base_url; ?>assets/images/background-login.jpg" class="background-edit">
				<img src="<?= base_url; ?>assets/images/default-avatar.png" class="edit-avatar">
				<a href="" class="edit-img-pencil"><i class="fa fa-pencil" aria-hidden="true"></i></a>
				<div class="edit-profile">
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" name="phone" class="form-control" id="phone">
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" name="address" class="form-control" id="address">
					</div>
					<div class="form-group">
						<label for="birthday">Birthday</label>
						<input type="text" name="birthday" class="form-control" id="birthday">
					</div>
				</div>
				<button class="update">UPDATE</button>
				
			    
			</div>
		</div>
    </div>
</body>

</html>