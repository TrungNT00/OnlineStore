<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>

        <?php if(!empty($warning)){?>
            <p style="width: 300px; padding: 8px; background-color: yellow;color: #fff; margin: 5px 100px;"><?php echo $warning;?></p>
        <?php }?>

        <div class="block"> 
        <?php if(!empty($dataPro)):    
        ?>              
         <form action="<?php echo _WEB_ROOT?>/admin/products/handleEditProduct/<?= $dataPro['idProduct'];?>" method="post" enctype="multipart/form-data">
            <table class="form">

                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="proName" value="<?= $dataPro['proName'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="idCategory">
                            <?php foreach($dataCate as $key => $cate): ?>
                            <option value="<?= $dataPro['idCategory'];?>" <?php echo ($dataPro['idCategory'] == $cate['idCategory']) ? 'selected' : false;?> ><?php echo ($dataPro['idCategory'] == $cate['idCategory']) ? $cate['catName']: $cate['catName'];?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="idBrand">
                            <?php foreach($dataBrand as $key => $brand):?>
                            <option value="<?= $dataPro['idBrand'];?>" <?php echo ($dataPro['idBrand'] == $brand['idBrand']) ? 'selected' : false;?> ><?php echo ($dataPro['idBrand'] == $brand['idBrand']) ? $brand['brandName']: $brand['brandName'];?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="description"><?= $dataPro['description'];?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="proPrice" value="<?= $dataPro['proPrice'];?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                    	<img src="<?php echo _WEB_ROOT;?>/public/uploads/<?= $dataPro['image'];?>" style="display:block; width: 200px;">
                        <input type="file" name="upload"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <?php
                                if($dataPro['type'] == '1'):
                            ?>

                            <option selected value="1">Featured</option>
                            <option value="0">Non-Featured</option>

                            <?php
                                elseif($dataPro['type'] == '0'):
                            ?>

                            <option selected value="1">Featured</option>
                            <option value="0">Non-Featured</option>
                            
                            <?php endif;?>
                        </select>
                    </td>
                </tr>

                <?php endif;?>
				
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="update" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>