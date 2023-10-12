<style>
    .main .cartoption .save {
        display: block;
        color: #fff;
        width: 100px;
        padding: 10px;
        background: green;
        margin: 10px auto;
        text-align: center;
        cursor: pointer;
    }
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Profile</h2>
                <form action="<?php echo _WEB_ROOT?>/user/handleEditProfile/<?php echo !empty($customer['idCustomer']) ? $customer['idCustomer'] : false;?>" method="POST">
                    <table class="tblone">
                        <tr>
                            <th colspan="2"></th>
                            <input type="hidden" name="idCus" value="<?php echo $customer['idCustomer'];?>">
                        </tr>
                        <tr>
                            <td>Tên khách hàng:</td>
                            <td><input type="text" name="cusName" value="<?php echo !empty($customer['cusName']) ? $customer['cusName'] : false;?>"></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><input type="text" name="cusEmail" value="<?php echo !empty($customer['cusEmail']) ? $customer['cusEmail'] : false;?>"></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ:</td>
                            <td><input type="text" name="address" value="<?php echo !empty($customer['address']) ? $customer['address'] : false;?>"></td>
                        </tr>
                        <tr>
                            <td>Tỉnh/Thành Phố</td>
                            <td>
                                <select name="country">
                                    <?php
                                        if(!empty($customer['country'])):
                                    ?>
                                    <option value="<?= $customer['country'];?>" ><?= $customer['country'];?></option>

                                    <?php endif;?>
                                    <option value="HCM">Hồ Chí Minh</option>
                                    <option value="HN">Hà Nội</option>
                                    <option value="LA">Long An</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Số điện thoại:</td>
                            <td><input type="text" name="phone" value="<?php echo !empty($customer['phone']) ? $customer['phone'] : false;?>"></td>
                        </tr>
                    </table>
                    <input type="submit" value="Save" name="save" class="save">
                </form>

            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>