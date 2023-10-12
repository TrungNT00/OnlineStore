<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>

        <?php if(!empty($success)){?>
            <p style="width: 300px; padding: 8px; background-color: green;color: #fff; margin: 5px 100px;"><?php echo $success;?></p>
        <?php } elseif(!empty($warning)){?>
            <p style="width: 300px; padding: 8px; background-color: yellow;color: #fff; margin: 5px 100px;"><?php echo $warning;?></p>
        <?php }?>
        
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($data)):
                        $i = 0;
                        foreach($data as $key => $brand):
                            $i++;
                    ?>
                        
                    <tr class="odd gradeX">
                        <td><?= $i;?></td>
                        <td><?= $brand['brandName']?></td>
                        <td><a href="<?php echo _WEB_ROOT;?>/admin/brands/editBrand/<?= $brand['idBrand'];?>">Edit</a> || <a onclick="return confirm('Are you want to delete this?')" href="<?php echo _WEB_ROOT;?>/admin/brands/deleteBrand/<?= $brand['idBrand'];?>">Delete</a></td>
                    </tr>

                    <?php endforeach; endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>