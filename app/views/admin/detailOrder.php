<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th width="10%">Id</th>
                        <th width="20%">Product Name</th>
                        <th width="15%">Image</th>
                        <th width="15%">Price</th>
                        <th width="10%">Order Date</th>
                        <th width="10%">Status</th>
                    </tr>
                    <?php if(!empty($dataOrders)):
                        $i = 0; 
                        foreach($dataOrders as $keyOrder => $order):
                            foreach($dataProducts as $keyPro => $pro):
                                if($order['idProduct'] == $pro['idProduct']):
                                    $i++;
                    ?>
                    <tr>
                        <td><?= $i;?></td>
                        <td><?= $pro['proName'];?></td>
                        <td>
                            <img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $pro['image'];?>" alt="" style="width: 100%;">
                        </td>
                        <td><?php echo number_format($order['orderPrice']) . ' VND';?></td>
                        <td><?php echo date($order['orderDate']);?></td>
                        
                        <?php if($order['status'] == 0):?>
                        <td>Pending...</td>
                        <?php elseif($order['status'] == 1):?>
                        <td>Delivering...</td>
                        <?php else:?>
                        <td style="color: green;">Success</td>
                        <?php endif;?>
                    </tr>
                    <?php endif; endforeach; endforeach; endif;?>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>