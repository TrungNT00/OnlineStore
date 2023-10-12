<style>
    .main .cartpage .title {
        width: 200px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2 class="title">Order detail</h2>
                <table class="tblone">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="20%">Order Date</th>
                        <th width="10%">Status</th>
                        <th></th>
                    </tr>

                    <?php if(!empty($datas)):
                        $i = 0;
                        foreach($datas as $key => $order):  
                            $i++;  
                    ?>
                    <tr>
                        <td width="10%"><?= $i;?></td>
                        <td width="20%"><?= $order['proName'];?></td>
                        <td>
                            <img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $order['image'];?>" style="width: 100px; height: 100px;" />
                        </td>
                        <td width="10%"><?php echo number_format($order['orderPrice']) . ' VND';?></td>
                        <td width="15%"><?= $order['quantity'];?></td>
                        <td width="15%"><?php echo date($order['orderDate']);?></td>

                        <?php if($order['status'] == 0):?>
                        <td width="10%"> Pending... </td>

                        <?php else:?>  
                        <td width="10%">N/A</td>
                        <?php endif;?>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php else: ?>
                    <p></p>
                <?php endif;?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>