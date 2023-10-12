<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>

        <?php if(!empty($success)){?>
            <p style="width: 300px; padding: 8px; background-color: green;color: #fff; margin: 5px 100px;"><?php echo $success;?></p>
        <?php } elseif(!empty($warning)){?>
            <p style="width: 300px; padding: 8px; background-color: yellow;color: #fff; margin: 5px 100px;"><?php echo $warning;?></p>
        <?php }?>
        
        <div class="block">
            <form action="<?php echo _WEB_ROOT;?>/admin/products/handleAddProduct" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="proName" placeholder="Enter Product Name..." class="medium"  value="<?php echo !empty($oldData['proName']) ? $oldData['proName'] : false;?>"/>
                            <p style="color: red; font-weight: bold;"><?php echo !empty($errors['proName']) ? $errors['proName']: false;?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="idCate">
                                <option value="">Select Category</option>

                                <?php if(!empty($dataCate)):
                                    foreach($dataCate as $key => $cate): 
                                ?>

                                <option value="<?= $cate['idCategory'];?>"><?= $cate['catName'];?></option>

                                <?php endforeach; endif; ?>
                                
                            </select>
                            <p style="color: red; font-weight: bold;"><?php echo !empty($errors['idCate']) ? $errors['idCate']: false;?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="idBrand">
                                <option value="">Select Brand</option>

                                <?php if(!empty($dataBrand)):
                                    foreach($dataBrand as $key => $brand):
                                ?>

                                <option value="<?= $brand['idBrand'];?>"><?= $brand['brandName'];?></option>

                                <?php endforeach; endif;?>
                            </select>
                            <p style="color: red; font-weight: bold;"><?php echo !empty($errors['idBrand']) ? $errors['idBrand']: false;?></p>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="description"><?php echo !empty($oldData['description']) ? $oldData['description'] : false;?></textarea>
                            <p style="color: red; font-weight: bold;"><?php echo !empty($errors['description']) ? $errors['description']: false;?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="proPrice" placeholder="Enter Price..." class="medium"  value="<?php echo !empty($oldData['proPrice']) ? $oldData['proPrice'] : false;?>"/>
                            <p style="color: red; font-weight: bold;"><?php echo !empty($errors['proPrice']) ? $errors['proPrice']: false;?></p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="upload" />
                            <p style="color: red; font-weight: bold;"><?php echo !empty($errors['upload']) ? $errors['upload']: false;?></p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option value="">Select Type</option>
                                <option value="1" >Featured</option>
                                <option value="2">Non-Featured</option>
                            </select>
                            <p style="color: red; font-weight: bold;"><?php echo !empty($errors['type']) ? $errors['type']: false;?></p>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>