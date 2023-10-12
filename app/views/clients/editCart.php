<?php 
    echo '<pre>';
    print_r($datas);
    echo '</pre>';
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <table class="tblone">
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="20%">Image</th>
                        <th width="15%">Price</th>
                        <th width="10%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="20%">Action</th>
                    </tr>

                    <?php if(!empty($data)): 
                        $totalPrice = $data['quantity'] * $data['proPrice'];    
                    ?>
                    <tr>
                        <td width="20%"><?php echo $data['proName'];?></td>
                        <td width="20%">
                            <img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $data['image'];?>" alt="" style="width: 100%;height: auto;">
                        </td>
                        <td width="15%"><?php echo number_format($data['proPrice']) . ' VND';?></td>
                        <td width="10%">
                            <input type="number" name="proQuantity" value="<?php echo $data['quantity'];?>">
                        </td>
                        <td width="20%"><?php echo number_format($totalPrice) . ' VND';?></td>
                        <td width="20%">
                            <a href="<?php echo _WEB_ROOT;?>/cart/edit/<?php echo $data[''];?>">Edit</a>|
                            <a href="">Delete</a>
                        </td>
                    </tr>
                    <?php endif;?>
                </table>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>