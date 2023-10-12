<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <?php if(!empty($success_cate)){?>
            <p style="width: 300px; padding: 8px; background-color: green;color: #fff; margin: 5px 100px;"><?php echo $success_cate;?></p>
        <?php } elseif(!empty($warning_cate)){?>
            <p style="width: 300px; padding: 8px; background-color: yellow;color: #fff; margin: 5px 100px;"><?php echo $warning_cate;?></p>
        <?php }?>
        <div class="block copyblock">
            <form action="<?php echo _WEB_ROOT; ?>/admin/categories/handleAddCategory" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="text" name="catName" placeholder="Nhập danh mục sản phẩm" class="medium" />
                            <p style="color: red; font-weight: bold;"><?php echo !empty($error_cate['catName']) ? $error_cate['catName'] : false; ?></p>
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