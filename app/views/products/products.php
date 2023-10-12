<?php
$this->view('blocks/header_home');
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Product from Laptop</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php if(!empty($laptops)):
                foreach($laptops as $key => $laptop):
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $laptop['idProduct']?>"><img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $laptop['image'];?>" alt=""/></a>
                <h2><?php echo $laptop['proName'];?></h2>
                <p><?php echo mb_substr($laptop['description'], 0, 20) .'...'?></p>
                <p><span class="price"><?php echo number_format($laptop['proPrice']) . ' VND';?></span></p>
                <div class="button"><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $laptop['idProduct']?>" class="details">Details</a></div>
            </div>
            <?php endforeach;  else:?>
                <div style="width: 100%; height:50px;color: red;text-align: center;padding: 10px 0;font-weight: bold;">Hiện tại không có sản phẩm nào!</div>
            <?php endif;?>
        </div>


        <div class="content_top">
            <div class="heading">
                <h3>Product from Desktop</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">

            <?php if(!empty($desktops)):
                foreach($desktops as $key => $desktop):
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $desktop['idProduct']?>"><img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $desktop['image'];?>" alt="" /></a>
                <h2><?php echo $desktop['proName'];?></h2>
                <p><?php echo mb_substr($desktop['description'], 0, 20) .'...'?></p>
                <p><span class="price"><?php echo number_format($desktop['proPrice']) . ' VND';?></span></p>
                <div class="button"><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $desktop['idProduct']?>" class="details">Details</a></div>
            </div>
            <?php endforeach; else:?>
                <div style="width: 100%; height:50px;color: red;text-align: center;padding: 10px 0;font-weight: bold;">Hiện tại không có sản phẩm nào!</div>
            <?php endif;?>

        </div>
        <div class="content_top">
            <div class="heading">
                <h3>Product from SmartPhone</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php if(!empty($phones)):
                foreach($phones as $key => $phone):
            ?>

            <div class="grid_1_of_4 images_1_of_4">
                <a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $phone['idProduct']?>"><img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $phone['image'];?>" alt="" /></a>
                <h2><?php echo $phone['phone'];?></h2>
                <p><?php echo mb_substr($phone['description'], 0, 20) . '...';?></p>
                <p><span class="price"><?php echo number_format($phone['proPrice']) . ' VND';?></span></p>
                <div class="button"><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $phone['idProduct']?>" class="details">Details</a></div>
            </div>

            <?php endforeach; else:?>
                <div style="width: 100%; height:50px;color: red;text-align: center;padding: 10px 0;font-weight: bold;">Hiện tại không có sản phẩm nào!</div>
            <?php endif;?>
        </div>

        <div class="content_top">
            <div class="heading">
                <h3>Product from Houseware</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">

            <?php if(!empty($housewares)):
                foreach($housewares as $key => $houseware):
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $houseware['idProduct']?>"><img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $houseware['image'];?>" alt="" /></a>
                <h2><?php echo $houseware['proName'];?></h2>
                <p><?php echo mb_substr($houseware['description'], 0, 20) . '...';?></p>
                <p><span class="price"><?php echo number_format($houseware['proPrice']) . ' VND';?></span></p>
                <div class="button"><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $houseware['idProduct']?>" class="details">Details</a></div>
            </div>

            <?php endforeach; else: ?>
                <div style="width: 100%; height:50px;color: red;text-align: center;padding: 10px 0;font-weight: bold;">Hiện tại không có sản phẩm nào!</div>
            <?php endif;?>
        </div>

        <div class="content_top">
            <div class="heading">
                <h3>Product from TV</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">

            <?php if(!empty($tvs)):
                foreach($tvs as $key => $tv):
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $tv['idProduct']?>"><img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $tv['image'];?>" alt="" /></a>
                <h2><?php echo $tv['proName'];?></h2>
                <p><?php echo mb_substr($tv['description'], 0, 20) . '...';?></p>
                <p><span class="price"><?php echo number_format($tv['proPrice']) . ' VND';?></span></p>
                <div class="button"><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $tv['idProduct']?>" class="details">Details</a></div>
            </div>

            <?php endforeach; else: ?>
                <div style="width: 100%; height:50px;color: red;text-align: center;padding: 10px 0;font-weight: bold;">Hiện tại không có sản phẩm nào!</div>
            <?php endif;?>
        </div>
    </div>
</div>
</div>
<?php $this->view('blocks/footer_home'); ?>