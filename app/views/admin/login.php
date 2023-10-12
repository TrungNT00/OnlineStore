<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo _WEB_ROOT?>/public/assets/admin/css/stylelogin.css" media="screen" />
</head>

<body>
    <div class="container">
        <section id="content">
            <form action="<?php echo _WEB_ROOT;?>/admin/handleLogin" method="post" autocomplete="off">
                <h1>Admin Login</h1>
                <span>
                </span>
                <div>
                    <input type="text" placeholder="Username" name="adminName" />
                    <p style="color: red;"><?php echo !empty($error_login['adminName']) ? $error_login['adminName'] : false;?></p>
                </div>
                <div>
                    <input type="password" placeholder="Password" name="adminPass" />
                    <p style="color: red;"><?php echo !empty($error_login['adminPass']) ? $error_login['adminPass'] : false;?></p>
                </div>
                <div>
                    <input type="submit" value="Log in" name="adminLogin" />
                </div>
            </form>
        </section>
    </div>
</body>

</html>