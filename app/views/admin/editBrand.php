<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">
            <form action="<?php echo _WEB_ROOT;?>/admin/brands/handleEditBrand/<?= $data['idBrand'];?>" method="post">
                <table class="form">
                    <tr>
                        <input type="hidden" name="idBrand" value="<?= $data['idBrand'];?>">
                        <td>
                            <input type="text" name="brandName" value="<?= $data['brandName'];?>" class="medium" />
                            <p style="color: red; font-weight: bold;"><?php echo !empty($error_update['brandName']) ? $error_update['brandName'] : false;?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="update" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>