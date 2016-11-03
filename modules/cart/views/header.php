<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="<?= BASE_URL;?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<title><?php echo $this->data['title'] ?></title>
	<link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>assets/css/dashboard.css">
    <script type="text/javascript" src="<?= BASE_URL; ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?= BASE_URL; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= BASE_URL; ?>assets/js/main.js"></script>
	
</head>
<body>
	<?php $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $page = end(explode('/', $url)); ?>
	<div id="nav">
	  	<div class="user-banner">
	  		<img <?php if ($this->data['avatar'] == NULL)
	  				echo 'src="'.BASE_URL.'assets/images/default-avatar.png"';
	  			else 
	  				echo 'src="'.$this->data['avatar'].'"';?>/>
	    	<h5 class="username">
	    		<?php echo $this->data['username'];?>
    		</h5>
		</div>
	  	<ul>
		    <li class="<?= ($page == 'profile') ? 'active' : NULL ?>">
		    	<a href="<?= BASE_URL;?>cart/profile">
		    		<i class="fa fa-home" aria-hidden="true"></i>
		    		<span>Hồ sơ</span>
		    	</a>
		    </li>
		    <li class="<?= ($page == 'add_product') ? 'active' : NULL ?>">
		    	<a href="<?= BASE_URL;?>cart/add_product">
			    	<i class="fa fa-cart-plus" aria-hidden="true"></i>
			    	<span class="swatch light-grey">Thêm sản phẩm</span>
		    	</a>
	    	</li>
		    <li class="<?= ($page == 'cart' || $page == '') ? 'active' : NULL ?>">
		    	<a href="<?= BASE_URL;?>cart">
		    		<i class="fa fa-shopping-basket" aria-hidden="true"></i>
		    		<span>Giỏ hàng</span>
		    	</a>
		    </li>
		    <li class="<?= ($page == 'orders') ? 'active' : NULL ?>">
		    	<a href="<?= BASE_URL;?>cart/orders">
		    		<i class="fa fa-list-alt" aria-hidden="true"></i>
		    		<span>Đơn hàng</span>
	    		</a>
			</li>
		    <li class="<?= ($page == 'history') ? 'active' : NULL ?>">
		    	<a href="<?= BASE_URL;?>cart/history">
		    		<i class="fa fa-rss" aria-hidden="true"></i>
		    		<span>Lịch sử</span>
		    	</a>
		    </li>
	  	</ul>
	</div>
	<div id="main">
		<!-- Header -->
		<header>
		  	<div class="noti">
		  		<a href="">
		  			<i class="fa fa-user" aria-hidden="true"></i>
		  		</a>
		  		<a href="">
		  			<i class="fa fa-commenting-o" aria-hidden="true"></i>
		  		</a>
		  		<a href="">
		  			<i class="fa fa-bell-o" aria-hidden="true"></i>
		  			<span class="new-noti">2</span>
		  		</a>
		  		<button href="#cart-popover" data-toggle="popover" data-placement="bottom">
		  			<i class="fa fa-shopping-cart" aria-hidden="true"></i>
		  			<span class="new-noti">
		  				<?= count($this->data['number_cart']);?>
	  				</span>
		  		</button>
		  		<button href="#order-popover" data-toggle="popover" data-placement="bottom">
		  			<i class="fa fa-list-alt" aria-hidden="true"></i>
		  			<span class="new-noti">
		  				<?= count($this->data['number_order']);?>
	  				</span>
		  		</button>

		  		<!-- Popover Cart content -->
				<div id="cart-popover" class="hidden">
					<table class="table">
					<?php foreach ($this->data['number_cart'] as $cart): ?>
						<tr>
							<td>
								<img width="60" height="60" src="<?= $cart['img']; ?>" alt="<?= $cart['name'] ?>">
							</td>
							<td>
								<a href="<?= $cart['url']?>">
									<?php echo implode( ' ', array_slice( preg_split( '/(?<!^)(?!$)/u', $cart['name'], 7, PREG_SPLIT_DELIM_CAPTURE ), 0, 6 ) ); ?> ...
								</a>
							</td>
							<!-- <td>
								<form action="" method="POST">
									<input type="hidden" name="cid" value="<?= $cart['cid']; ?>">
									<input type="hidden" name="image" value="<?= $cart['img']; ?>">
									<button type="submit" name="delete" class="btn btn-danger" >
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</button>
								</form>
							</td> -->
						</tr>
					<?php endforeach; ?>
					</table>
				</div>

				<!-- Popover Order content -->
				<div id="order-popover" class="hidden">
					<table class="table">
					<?php foreach ($this->data['number_order'] as $order): ?>
						<tr>
							<td>
								<img width="60" height="60" src="<?= $order['img']; ?>" alt="<?= $order['name'] ?>">
							</td>
							<td>
								<a href="<?= $order['url']?>">
									<?php echo implode( ' ', array_slice( preg_split( '/(?<!^)(?!$)/u', $order['name'], 7, PREG_SPLIT_DELIM_CAPTURE ), 0, 6 ) ); ?> ...
								</a>
							</td>
							<!-- <td>
								<form action="" method="POST">
									<input type="hidden" name="cid" value="<?= $order['oid']; ?>">
									<button type="submit" name="delete" class="btn btn-danger" >
										<i class="fa fa-trash-o" aria-hidden="true"></i>
									</button>
								</form>
							</td> -->
						</tr>
					<?php endforeach; ?>
					</table>
				</div>
		  	</div>
		  	<div class="search">
			    <input type="text" id="search_key" class="searchTerm" placeholder="Type of search">
			    <button id="cart_search" class="searchButton">
			        <i class="fa fa-search"></i>
			    </button>
			    <div class="clearfix"></div>
			</div>
		    <img src="<?= BASE_URL; ?>assets/images/logo.png" class="logo-dashboard">
		</header>
		<!-- Main Content -->
		<div id="content">
	