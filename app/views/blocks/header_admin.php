<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="<?php echo _WEB_ROOT;?>/public/assets/admin/css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo _WEB_ROOT;?>/public/assets/admin/css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo _WEB_ROOT;?>/public/assets/admin/css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo _WEB_ROOT;?>/public/assets/admin/css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo _WEB_ROOT;?>/public/assets/admin/css/nav.css" media="screen" />
    <link href="<?php echo _WEB_ROOT;?>/public/assets/admin/css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/table/table.js"></script>
    <script src="<?php echo _WEB_ROOT;?>/public/assets/admin/js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>
</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="<?php echo _WEB_ROOT;?>/public/assets/admin/img/admin-logo.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
                    <h1>Welcome to Admin Page</h1>
				</div>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="<?php echo _WEB_ROOT;?>/public/assets/admin/img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo $adminName;?></li>
                            <li><a href="<?php echo _WEB_ROOT;?>/admin/logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="<?php echo _WEB_ROOT;?>/admin"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href=""><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="<?php echo _WEB_ROOT?>/admin/changepassword"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="<?php echo _WEB_ROOT?>/admin/showOrders"><span>Payment Customer</span></a></li>
                <li class="ic-charts"><a href=""><span>Visit Website</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>
    