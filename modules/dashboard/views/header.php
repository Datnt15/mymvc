<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="<?= base_url;?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<title><?php echo $this->data['title'] ?></title>
	<link rel="stylesheet" href="<?= base_url; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url; ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url; ?>assets/css/dashboard.css">
    <script type="text/javascript" src="<?= base_url; ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url; ?>assets/js/main.js"></script>
	
</head>
<body>
	<?php $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $page = end(explode('/', $url)); ?>
	<div id="nav">
	  	<div class="user-banner">
	  		<img <?php if ($this->data['avatar'] == NULL)
	  				echo 'src="'.base_url.'assets/images/default-avatar.png"';
	  			else 
	  				echo 'src="'.$this->data['avatar'].'"';?>/>
	    	<h5 class="username">
	    		<?php echo $this->data['username'];?>
    		</h5>
		</div>
	  	<ul>
		    <li class="<?= ($page == 'profile') ? 'active' : NULL ?>">
		    	<a href="<?= base_url;?>cart/profile">
		    		<i class="fa fa-home" aria-hidden="true"></i>
		    		<span>Profile</span>
		    	</a>
		    </li>
		    <li class="<?= ($page == 'add_product') ? 'active' : NULL ?>">
		    	<a href="<?= base_url;?>cart/add_product">
			    	<i class="fa fa-cart-plus" aria-hidden="true"></i>
			    	<span class="swatch light-grey">Add product</span>
		    	</a>
	    	</li>
		    <li class="<?= ($page == 'cart' || $page == '') ? 'active' : NULL ?>">
		    	<a href="<?= base_url;?>cart">
		    		<i class="fa fa-shopping-basket" aria-hidden="true"></i>
		    		<span>Cart</span>
		    	</a>
		    </li>
		    <li class="<?= ($page == 'orders') ? 'active' : NULL ?>">
		    	<a href="<?= base_url;?>cart/orders">
		    		<i class="fa fa-list-alt" aria-hidden="true"></i>
		    		<span>Orders</span>
	    		</a>
			</li>
		    <li class="<?= ($page == 'history') ? 'active' : NULL ?>">
		    	<a href="<?= base_url;?>cart/history">
		    		<i class="fa fa-rss" aria-hidden="true"></i>
		    		<span>Order History</span>
		    	</a>
		    </li>
	  	</ul>
	</div>
	<div id="main">
		<!-- Header -->
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
		<!-- Main Content -->
		<div id="content">
	