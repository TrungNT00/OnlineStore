<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>

        <?php if(!empty($successUpdate)){?>
            <p style="width: 300px; padding: 8px; background-color: green;color: #fff; margin: 5px 100px;"><?php echo $successUpdate;?></p>
        <?php } elseif(!empty($warning_cate)){?>
            <p style="width: 300px; padding: 8px; background-color: yellow;color: #fff; margin: 5px 100px;"><?php echo $warning_cate;?></p>
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
                    <?php if(!empty($categories)):
                        $i = 0;
                        foreach($categories as $key => $cate):
                            $i++;
                    ?>
                    <tr class="odd gradeX" >
                        <td><?= $i;?></td>
                        <td><?= $cate['catName'];?></td>
                        <td><a href="<?php echo _WEB_ROOT;?>/admin/categories/editCategory/<?php echo $cate['idCategory'];?>">Edit</a> || <a onclick="return confirm('Do you want to delete this?')" href="<?php echo _WEB_ROOT;?>/admin/categories/deleteCategory/<?php echo $cate['idCategory'];?>">Delete</a></td>
                    </tr>
                    <?php endforeach; endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>