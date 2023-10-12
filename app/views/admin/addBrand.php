<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Brand</h2>

        <?php if(!empty($success)){?>
            <p style="width: 300px; padding: 8px; background-color: green;color: #fff; margin: 5px 100px;"><?php echo $success;?></p>
        <?php } elseif(!empty($warning)){?>
            <p style="width: 300px; padding: 8px; background-color: yellow;color: #fff; margin: 5px 100px;"><?php echo $warning;?></p>
        <?php }?>

        <div class="block copyblock">
            <form action="<?php echo _WEB_ROOT; ?>/admin/brands/handleAddBrand" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="brandName" placeholder="Nhập thương hiệu sản phẩm" class="medium" />
                            <p style="color: red; font-weight: bold;"><?php echo !empty($errors['brandName']) ? $errors['brandName'] : false;?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>