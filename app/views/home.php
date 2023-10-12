<?php
$this->view('blocks/header_home', $header);
$this->view('blocks/slider',$sub_data);
?>
<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<h3>Feature Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">

			<?php if(!empty($dataProducts)):
				foreach($dataProducts as $key => $product):	
			?>

			<div class="grid_1_of_4 images_1_of_4">
				<a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $product['idProduct'];?>"><img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $product['image'];?>" alt="" /></a>
				<h2><?php echo $product['proName'];?></h2>	
				<p><?php echo mb_substr($product['description'], 0, 20) . '...';?></p>
				<p><span class="price"><?php echo number_format($product['proPrice']) . ' VND';?></span></p>
				<div class="button"><span><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $product['idProduct'];?>" class="details">Details</a></span></div>
			</div>
			
			<?php endforeach; endif;?>

		</div>
		<div class="content_bottom">
			<div class="heading">
				<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?idpro=16"><img src="public/assets/images/new-pic1.jpg" alt="" /></a>
				<h2>Oneplus 11</h2>
				<p><span class="price">19,000,000 VND</span></p>
				<div class="button"><span><a href="details.php?idpro=16" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?idpro=15"><img src="public/assets/images/new-pic1.jpg" alt="" /></a>
				<h2>PC Dell</h2>
				<p><span class="price">12,000,000 VND</span></p>
				<div class="button"><span><a href="details.php?idpro=15" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?idpro=14"><img src="public/assets/images/new-pic1.jpg" alt="" /></a>
				<h2>Bếp nướng </h2>
				<p><span class="price">7,000,000 VND</span></p>
				<div class="button"><span><a href="details.php?idpro=14" class="details">Details</a></span></div>
			</div>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?idpro=13"><img src="public/assets/images/new-pic1.jpg" alt="" /></a>
				<h2>Máy giặt </h2>
				<p><span class="price">6,000,000 VND</span></p>
				<div class="button"><span><a href="details.php?idpro=13" class="details">Details</a></span></div>
			</div>
		</div>
	</div>
</div>
<?php
$this->view('blocks/footer_home');
?>