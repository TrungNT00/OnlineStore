<?php $this->view('blocks/header_home', $sub_data); ?>
<div class="main">
    <div class="content">
        <div class="section group">
            <?php if(!empty($data)):
                foreach($data as $key => $pro):
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $pro['idProduct'];?>"><img src="<?php echo _WEB_ROOT;?>/public/uploads/<?php echo $pro['image'];?>" alt="" /></a>
                <h2><?php echo $pro['proName'];?></h2>
                <p><?php echo mb_substr($pro['description'],0,20) . '...';?></p>
                <p><span class="price"><?php echo number_format($pro['proPrice']) . ' VND';?></span></p>
                <div class="button"><span><a href="<?php echo _WEB_ROOT;?>/detailProduct-<?php echo $pro['idProduct'];?>" class="details">Details</a></span></div>
            </div>
            <?php endforeach; else:?>
                <p style="color: red; font-size: 20;font-weight: bold;text-align: center;">Không có sản phẩm như bạn tìm. Vui lòng thử lại sau!</p>
            <?php endif;?>
        </div>
    </div>
</div>
<?php $this->view('blocks/footer_home'); ?>