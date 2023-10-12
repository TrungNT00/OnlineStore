<style>
    .main .cartoption a {
        display: block;
        color: #fff;
        width: 100px;
        padding: 10px;
        background: red;
        margin: 10px auto;
        text-align: center;
    }
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Profile</h2>
                <table class="tblone">
                    <tr>
                        <th colspan="2"></th>
                    </tr>
                    <tr>
                        <td>Tên khách hàng:</td>
                        <td><?php echo !empty($customer['cusName']) ? $customer['cusName'] : false;?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo !empty($customer['cusEmail']) ? $customer['cusEmail'] : false;?></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ:</td>
                        <td><?php echo !empty($customer['address']) ? $customer['address'] : false;?></td>
                    </tr>
                    <tr>
                        <td>Tỉnh/Thành Phố</td>
                        <td><?php 
                        echo !empty($customer['country']) ? $customer['country'] : false;
                        ?></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td><?php echo !empty($customer['phone']) ? $customer['phone'] : false;?></td>
                    </tr>
                </table>
                <a href='<?php echo _WEB_ROOT;?>/user/profile/edit/<?php echo $customer['idCustomer'];?>'>Update</a>

            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>