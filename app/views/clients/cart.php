<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <table class="tblone">
                    <tr>
                        <th>ID</th>
                        <th width="20%">Product Name</th>
                        <th width="20%">Image</th>
                        <th width="15%">Price</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="20%">Action</th>
                    </tr>

                    <?php if(!empty($data)) : 
                        $i = 0;
                        $totalPrice = 0;
                        foreach($data as $key => $cart): 
                            $totalPrice = $cart['proPrice'] * $cart['quantity'];
                            $i++;   
                    ?>
                    <tr>
                        <td><?= $i;?></td>
                        <td width="20%"><?= $cart['proName'];?></td>
                        <td width="20%">
                            <img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $cart['image'];?>" alt="" style="width: 100%;height: auto;">
                        </td>
                        <td width="15%"><?php echo number_format($cart['proPrice']) . ' VND';?></td>
                        <td width="10%">
                            <a href="<?php echo _WEB_ROOT;?>/cart/minusPro/<?php echo $cart['idProduct'];?>" style="margin-right: 3px;"><i class="fa-solid fa-minus"></i></a>
                            <?= $cart['quantity'];?>
                            <a href="<?php echo _WEB_ROOT;?>/cart/plusPro/<?php echo $cart['idProduct'];?>" style="margin-left: 3px;"><i class="fa-solid fa-plus"></i></a>
                        </td>
                        <td width="20%"><?php echo number_format($totalPrice) . ' VND';?></td>
                        <td width="20%">
                            <a href="<?php echo _WEB_ROOT;?>/cart/delete/<?php echo $cart['idProduct'];?>" onclick="return alert('Bạn muốn xóa sản phẩm này?');">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </table>
                    <?php else:?>
                <span class="failed">Your cart is empty! Please shopping now</span>
                    <?php endif;?>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="<?php echo _WEB_ROOT;?>/categories"><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="<?php echo _WEB_ROOT;?>/payment"><img src="<?php echo _WEB_ROOT;?>/public/assets/clients/images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>