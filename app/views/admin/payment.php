<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name Customer</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    <?php if(!empty($dataCuss)) :
                        $i = 0;
                        foreach($dataCuss as $key => $cus):
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i;?></td>
                        <td><?= $cus['cusName'];?></td>
                        <td><?= $cus['cusEmail'];?></td>
                        <td><?= $cus['address'];?></td>
                        <td><?= $cus['phone'];?></td>
                        <td>
                            <a href="<?php echo _WEB_ROOT;?>/admin/detailOrder/<?php echo $cus['idCustomer'];?>">show</a>
                        </td>
                    </tr>

                    <?php endforeach; endif;?>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>