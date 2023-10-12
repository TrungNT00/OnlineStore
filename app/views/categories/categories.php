<?php $this->view('blocks/header_home'); ?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Category: <?php echo (!empty($catName)) ? $catName['catName'] : false;?></h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
           <?php if(!empty($data)):
                foreach($data as $key => $pro):
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $pro['idProduct'];?>"><img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $pro['image'];?>" alt="" /></a>
                <h2><?php echo $pro['proName'];?></h2>
                <p><?php echo mb_substr($pro['description'], 0,20) . '...';?></p>
                <p><span class="price"><?php echo number_format($pro['proPrice']) . ' VND';?></span></p>
                <div class="button"><span><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $pro['idProduct'];?>" class="details">Details</a></span></div>
            </div>
            <?php endforeach; endif;?>
        </div>
    </div>
</div>
<?php $this->view('blocks/footer_home'); ?>