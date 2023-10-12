<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>

        <?php if(!empty($success)){?>
            <p style="width: 300px; padding: 8px; background-color: green;color: #fff; margin: 5px 100px;"><?php echo $success;?></p>
        <?php } elseif(!empty($warning)){?>
            <p style="width: 300px; padding: 8px; background-color: yellow;color: #fff; margin: 5px 100px;"><?php echo $warning;?></p>
        <?php }?>

        <div class="block">
            <table class="data display datatable" id="example" style="text-align: center;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Danh mục</th>
                        <th>Hãng</th>
                        <th>Giá sản phẩm</th>
                        <th>Nôi dung</th>
                        <th>Thể loại</th>
                        <th>Quản lí</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if(!empty($data)):
                        $i=0;
                        foreach($dataPro as $key => $pro):   
                            $i++; 
                    ?>

                    <tr class="odd gradeX">
                        <td><?= $i;?></td>
                        <td><?= $pro['proName'];?></td>
                        <td>
                            <img src="<?php echo _WEB_ROOT?>/public/uploads/<?php echo $pro['image'];?>" style="width:100px; height:100px; margin-top:20px">
                        </td>
                        <td><?php 
                            foreach($dataCate as $keyCate => $cate){
                                if($pro['idCategory'] == $cate['idCategory']){
                                    echo $cate['catName'];
                                }
                            }
                        ?></td>
                        <td><?php
                            foreach($dataBrands as $keyBrand => $brand){
                                if($pro['idBrand'] == $brand['idBrand']){
                                    echo $brand['brandName'];
                                }
                            }
                        ?></td>
                        <td><?php echo number_format($pro['proPrice']) . ' VND';?></td>
                        <td>
                            <p><?php echo mb_substr($pro['description'], 0, 100, 'UTF-8') ;?></p>
                        </td>
                        <td><?php
                            if($pro['type'] == '1'){
                                echo 'Featured';
                            } elseif($pro['type'] == '2'){
                                echo 'Non-Featured';
                            }
                        ?></td>
                        <td><a href="<?php echo _WEB_ROOT?>/admin/products/editProduct/<?= $pro['idProduct'];?>">Edit</a> ||
                            <a onclick="return confirm('Do you want to delete this?');" href="<?php echo _WEB_ROOT?>/admin/products/deleteProduct/<?= $pro['idProduct'];?>">Delete</a>
                        </td>
                    </tr>

                    <?php endforeach; endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>