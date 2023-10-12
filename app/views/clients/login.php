<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <form action="<?php echo _WEB_ROOT;?>/user/handleLogin" method="POST" id="member">
                <input type="text" name="email_login" class="field" placeholder="Enter your email..." value="<?php echo empty($errors['email_login']) ? $oldData['email_login'] : false ;?>">
                <p style="color: red;font-weight: bold;"><?php echo !empty($errors['email_login']) ? $errors['email_login'] : false;?></p>
                <input type="password" name="password_login" class="field" placeholder="Enter password...">
                <p style="color: red;font-weight: bold;"><?php echo !empty($errors['password_login']) ? $errors['password_login'] : false;?></p>
                <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                <div class="buttons"><input class="grey" type="submit" value="Sign In" name="login"></div>
            </form>
        </div>
        <div class="register_account">
            <?php if(!empty($success)){?>
                <p style="width: 300px; padding: 10px; background-color: green;color: #fff"><?php echo $success;?></p>
            <?php }?>
            
            <h3>Register New Account</h3>
            <form action="<?php echo _WEB_ROOT;?>/user/signup" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="cusName" placeholder="Name" value="<?php echo empty($errors_signup['cusName']) ? $oldData_signup['cusName'] : false;?>">
                                    <p style="color: red; margin-left: 5px;font-weight: bold;"><?php echo !empty($errors_signup['cusName']) ? $errors_signup['cusName'] : false;?></p>
                                </div>
                                <div>
                                    <input type="text" name="cusEmail" placeholder="Email" value="<?php echo empty($errors_signup['cusEmail']) ? $oldData_signup['cusEmail'] : false;?>">
                                    <p style="color: red; margin-left: 5px;font-weight: bold;"><?php echo !empty($errors_signup['cusEmail']) ? $errors_signup['cusEmail'] : false;?></p>
                                </div>
                            </td>
                            <td style="margin-left: 10px;">
                                <div>
                                    <input type="text" name="address" placeholder="Address" value="<?php echo empty($errors_signup['address']) ? $oldData_signup['address'] : false;?>">
                                    <p style="color: red; margin-left: 5px;font-weight: bold;"><?php echo !empty($errors_signup['address']) ? $errors_signup['address'] : false;?></p>
                                </div>
                                <div>
                                    <select id="country" name="country" class="frm-field required">
                                        <option value="">Select a Country</option>
                                        <option value="HCM">Hồ Chí Minh</option>
                                        <option value="HN">Hà Nội</option>
                                        <option value="LA">Long An</option>
                                    </select> <br>
                                    <p style="color: red; margin-left: 5px;font-weight: bold;"><?php echo !empty($errors_signup['country']) ? $errors_signup['country'] : false;?></p>
                                </div>

                                <div>
                                    <input type="text" name="phone" placeholder="Phone">
                                    <p style="color: red; margin-left: 5px;font-weight: bold;"><?php echo !empty($errors_signup['phone']) ? $errors_signup['phone'] : false;?></p>
                                </div>

                                <div>
                                    <input type="password" name="password" placeholder="Password">
                                    <p style="color: red; margin-left: 5px;font-weight: bold;"><?php echo !empty($errors_signup['password']) ? $errors_signup['password'] : false;?></p>
                                </div>

                                <div>
                                    <input type="password" name="re_password" placeholder="Re_Password">
                                    <p style="color: red; margin-left: 5px;font-weight: bold;"><?php echo !empty($errors_signup['re_password']) ? $errors_signup['re_password'] : false;?></p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search"><input type="submit" name="submit" value="Create Account" class="grey"></input></div>
                <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
                <div class="clear"></div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>
</div>