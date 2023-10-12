<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <?php if(!empty($msg_pass)){?>
            <p style="width: 300px; padding: 10px; background-color: green;color: #fff"><?php echo $msg_pass;?></p>
        <?php }?>
        <div class="block">               
           <form action="<?php echo _WEB_ROOT;?>/adminHandle/handleChangePassword/<?php echo !empty($adminInfo['id_admin']) ? $adminInfo['id_admin'] : false;?>" method="POST">
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldPass" class="medium" />
                        <p style="color: red;"><?php echo !empty($errors_pass['oldPass']['isPass']) ? $errors_pass['oldPass']['isPass']: false;?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newPass" class="medium" />
                        <p style="color: red;"><?php echo !empty($errors_pass['newPass']['required']) ? $errors_pass['newPass']['required'] : false;?></p>
                        <p style="color: red;"><?php echo !empty($errors_pass['newPass']['min']) ? $errors_pass['newPass']['min'] : false;?></p>
                        <p style="color: red;"><?php echo !empty($errors_pass['newPass']['max']) ? $errors_pass['newPass']['max'] : false;?></p>
                    </td>
                </tr>


                <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="update" Value="Update" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</div>
