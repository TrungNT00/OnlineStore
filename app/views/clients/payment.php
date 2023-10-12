<style type="text/css">
	.main .box_left {
		width: 50%;
		float: left;
		box-sizing: border-box;
		padding: 10px;
	}

	.main .box_right {
		width: 48%;
		float: right;
		box-sizing: border-box;
		padding: 10px;
	}

	.main .box_right a {
		display: block;
		color: #fff;
		width: 100px;
		padding: 10px;
		background: red;
		margin: 10px auto;
		text-align: center;
	}

	.main .btn_success {
		display: block;
		padding: 20px;
		width: 10%;
		background: green;
		text-align: center;
		color: #fff;
		border-radius: 20px;
		margin: 0 auto;
	}
</style>
<div class="main">
	<div class="content">
		<div class="section group">
			<form action="<?php echo _WEB_ROOT;?>/payment/addOrder" method="post">
				<div class="box_left">
					<table class="tblone">
						<tr>
							<th width="10%">ID</th>
							<th width="20%">Product Name</th>
							<th width="20%">Price</th>
							<th width="15%">Quantity</th>
							<th width="20%">Total Price</th>
						</tr>
						<?php if(!empty($datas)):
							$i = 0;
							$totalPrice = 0;
							$totalProduct = 0;
							foreach($datas as $key => $cart):
								$i++;
								$totalPrice = $cart['proPrice'] * $cart['quantity'];
								$totalProduct += $totalPrice;
						?>
						<tr>
							<input type="hidden" name="idProduct[]" value="<?= $cart['idProduct'];?>">
							<input type="hidden" name="quantity[]" value="<?= $cart['quantity'];?>">
							<td width="10%"><?= $i;?></td>
							<td width="20%"><?=$cart['proName'];?></td>
							<td width="20%"><?php echo number_format($cart['proPrice']) . ' VND';?></td>
							<td width="15%"><?= $cart['quantity'];?></td>
							<td width="20%"><?php  echo number_format($totalPrice) . ' VND';?></td> 
						</tr>		
						<?php endforeach;?>
						<tr>
							<td colspan="5" style="color: red; font-weight: bold; text-align: right;">Tổng: <span><?php echo number_format($totalProduct) . ' VND';?></span></td>
						</tr>
						<?php else: ?>
							<td class="failed" colspan="5">Your cart is empty! Please shopping now</td>
						<?php endif;?>
					</table>
				</div>
				<div class="box_right">
					<table class="tblone">
						<?php if(!empty($dataCus)):?>
						<tr>
							<th colspan="2">Thông tin khách hàng</th>
						</tr>
						<tr>
							<input type="hidden" name="idCustomer" value="<?= $dataCus['idCustomer'];?>">
							<td>Tên khách hàng</td>
							<td><?php echo $dataCus['cusName'];?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $dataCus['cusEmail'];?></td>
						</tr>
						<tr>
							<td>Địa chỉ</td>
							<td><?php echo $dataCus['address'];?></td>
						</tr>
						<tr>
							<td>Tỉnh/Thành Phố</td>
							<td><?php echo $dataCus['country'];?></td>
						</tr>
						<tr>
							<td>Số điện thoại</td>
							<td><?php echo $dataCus['phone'];?></td>
						</tr>
					</table>
				<?php endif;?>
				</div>
				<div style="clear: both;"></div>
				<button type="submit" class="btn_success" >Order Now</button>
			</form>
		</div>
	</div>
</div>