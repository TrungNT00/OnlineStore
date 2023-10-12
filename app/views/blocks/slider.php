<div class="header_bottom">
<?php
	// echo '<pre>';
	// print_r($dataProLaptop);
	// echo '</pre>';
	// echo '<pre>';
	// print_r($dataProPhone);
	// echo '</pre>';
	// echo '<pre>';
	// print_r($dataProLaptop);
	// echo '</pre>';
	// echo '<pre>';
	// print_r($dataProLaptop);
	// echo '</pre>';
?>
	<div class="header_bottom_left">
		<div class="section group">
			<?php if(!empty($dataProLaptop)):?>
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					<a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $dataProLaptop['idProduct']?>"> <img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $dataProLaptop['image'];?>" style="width: 100px;height: 100px;" /></a>
				</div>
				<div class="text list_2_of_1">
					<h2><?php echo $dataProLaptop['proName'];?></h2>
					<p>
					<p><?php echo mb_substr($dataProLaptop['description'], 0, 10) . '...'?></p>
					<div class="button"><span><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $dataProLaptop['idProduct']?>">Add to cart</a></span></div>
				</div>
			</div>
			<?php endif;?>

			<?php if(!empty($dataProPhone)):?>
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					<a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $dataProPhone['idProduct']?>"> <img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $dataProPhone['image'];?>" style="width: 100px;height: 100px;" /></a>
				</div>
				<div class="text list_2_of_1">
					<h2><?php echo $dataProPhone['proName'];?></h2>
					<p><?php echo mb_substr($dataProPhone['description'], 0, 10) . '...'?></p>
					<div class="button"><span><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $dataProPhone['idProduct']?>">Add to cart</a></span></div>
				</div>
			</div>
			<?php endif;?>
		</div>
		<div class="section group">
			<?php if(!empty($dataProTV)):?>
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					<a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $dataProTV['idProduct']?>"> <img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $dataProTV['image'];?>" style="width: 100px;height: 100px;" /></a>
				</div>
				<div class="text list_2_of_1">
					<h2><?php echo $dataProTV['proName'];?></h2>
					<p><?php echo mb_substr($dataProTV['description'], 0, 10) . '...'?></p>
					<div class="button"><span><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $dataProTV['idProduct']?>">Add to cart</a></span></div>
				</div>
			</div>
			<?php endif;?>

			<?php if(!empty($dataProHouseWare)):?>
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					<a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $dataProHouseWare['idProduct']?>"> <img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $dataProHouseWare['image'];?>" style="width: 100px;height: 100px;" /></a>
				</div>
				<div class="text list_2_of_1">
					<h2><?php echo $dataProHouseWare['proName'];?></h2>
					<p><?php echo mb_substr($dataProHouseWare['description'], 0, 10) . '...'?></p>
					<div class="button"><span><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $dataProHouseWare['idProduct']?>">Add to cart</a></span></div>
				</div>
			</div>
			<?php endif;?>
		</div>
		<div class="clear"></div>
	</div>
	<div class="header_bottom_right_images">
		<!-- FlexSlider -->

		<section class="slider">
			<div class="flexslider">
				<ul class="slides">
					<li><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/1.jpg" alt="" /></li>
					<li><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/2.jpg" alt="" /></li>
					<li><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/3.jpg" alt="" /></li>
					<li><img src="<?php echo _WEB_ROOT; ?>/public/assets/clients/images/4.jpg" alt="" /></li>
				</ul>
			</div>
		</section>
		<!-- FlexSlider -->
	</div>
	<div class="clear"></div>
</div>