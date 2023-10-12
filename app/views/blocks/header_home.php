<!DOCTYPE HTML>
<head>
	<title><?php echo $title;?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="<?php echo _WEB_ROOT;?>/public/assets/clients/css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/jquerymain.js"></script>
	<script src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/nav.js"></script>
	<script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/move-top.js"></script>
	<script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/easing.js"></script>
	<script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/clients/js/nav-hover.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
</head>

<body>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="<?php echo _WEB_ROOT;?>"><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/logo.png" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form action="<?php echo _WEB_ROOT;?>/products/searchProduct" method="POST">
						<input type="text" name="nameSearch" placeholder="Search for Products" value="<?php echo (!empty($old['nameSearch'])) ? $old['nameSearch'] : false;?>">
						<p style="color: red;"><?php echo (!empty($errors['nameSearch'])) ? $errors['nameSearch'] : false;?></p>
						<input type="submit" value="SEARCH" name="search">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="cart" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<?php if(!empty($totalPrice)):?>
								<span class="no_product"><?php echo number_format($totalPrice) . ' VND';?></span>
							<?php  else: ?>
								<span class="no_product">empty</span>
							<?php endif;?>
						</a>
					</div>
				</div>
				<div class="login">
					<?php if(empty(Session::data('customer_login'))){?>
					<a href='<?php echo _WEB_ROOT;?>/user/login'>Login</a>
					<?php } else {?>
					<a href="<?php echo _WEB_ROOT;?>/user/logout">Logout</a>
					<?php }?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="menu">
				<ul id="dc_mega-menu-orange" class="dc_mm-orange">
					<li><a href="<?php echo _WEB_ROOT?>">Home</a></li>
					<li><a href="<?php echo _WEB_ROOT?>/products">Products</a></li>
					<li><a href="<?php echo _WEB_ROOT?>/cart">Cart</a></li>
					<li><a href="<?php echo _WEB_ROOT?>/categories">Categories</a></li>

					<?php if(!empty(Session::data('customer_login'))){?>
					<li><a href="<?php echo _WEB_ROOT;?>/payment/orderDetails">Order Details</a></li>
					<?php }?>

					<li><a href="<?php echo _WEB_ROOT?>/contact">Contact</a></li>

					<?php if(!empty(Session::data('customer_login'))){?>
					<li><a href="<?php echo _WEB_ROOT;?>/user/profile">Profile</a></li>
					<?php }?>

					<?php if(!empty(Session::data('customer_login'))){?>
					<li style="float: right;"><a href="#">Chào, <?php echo !empty($customer['cusName']) ?  $customer['cusName']: false;?></a></li>
					<?php }?>

					<div class="clear"></div>
				</ul>
			</div>