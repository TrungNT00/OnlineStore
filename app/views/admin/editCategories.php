<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">
            <form action="<?php echo _WEB_ROOT; ?>/admin/categories/handleEditCategory/<?php echo $category['idCategory']; ?>" method="post">
                <table class="form">
                    <tr>
                        <td>
                            <input type="hidden" name="idCategory" value="<?php echo $category['idCategory']; ?>"/>
                            <input type="text" name="catName" value="<?php echo !empty($category['catName']) ? $category['catName']: false;?>" class="medium" />
                            <p style="color: red; font-weight: bold;"><?php echo !empty($error['catName']) ? $error['catName']: false;?></p>
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