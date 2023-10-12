<?php $this->view('blocks/header_home'); ?>
<div class="main">
    <div class="content">
        <div class="section group">
            <?php if(!empty($data)):?>

            <div class="cont-desc span_1_of_2">
                <div class="grid images_3_of_2">
                    <img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $data['image'];?>" />
                </div>
                <div class="desc span_3_of_2">
                    <h2><?php echo $data['proName'];?></h2>
                    <p><?php echo $data['description'];?></p>
                    <div class="price">
                        <p>Price: <span>35,000,000 VND</span></p>
                        <p>Category: <span>
                            <?php foreach($dataCates as $key => $cate){
                                if($cate['idCategory'] == $data['idCategory']){
                                    echo $cate['catName'];
                                }    
                            }?>
                        </span></p>
                        <p>Brand:<span>
                            <?php foreach($dataBrands as $key => $brand){
                                if($brand['idBrand'] == $data['idBrand']){
                                    echo $brand['brandName'];
                                }
                            }?>
                        </span></p>
                    </div>
                    <div class="add-cart">
                        <form action="<?php echo _WEB_ROOT;?>/cart/add" method="post">
                            <input type="hidden" name="idProduct" value="<?php echo $data['idProduct'];?>">
                            <input type="number" class="buyfield" name="proQuantity" value="1" />
                            <p style="color: red; font-weight: bold;"><?php echo !empty($error_order['proQuantity']) ? $error_order['proQuantity'] : false;?></p>
                            <input type="submit" class="buysubmit" name="submit" value="Buy Now" />
                        </form>
                    </div>
                </div>
                <div class="product-desc">
                    <!-- <h2>Product Details</h2>
                    <p>
                    <p>Macbook 14</p>
                    </p> -->
                </div>
            </div>

            <?php endif;?>

            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <?php if (!empty($dataCates)) :
                        foreach ($dataCates as $key => $cate) :
                    ?>
                        <li><a href="<?php echo _WEB_ROOT; ?>/categories/getCategory/<?php echo $cate['idCategory']; ?>"><?php echo $cate['catName']; ?></a></li>
                    <?php endforeach;
                    endif; ?>
                </ul>

            </div>
        </div>
    </div>
</div>
<?php echo $this->view('blocks/footer_home'); ?>