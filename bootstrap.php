<?php
define('_DIR_ROOT', __DIR__);

//Xử lí http root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'ON'){
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

$dir_root = str_replace('\\', '/', _DIR_ROOT);
$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower($dir_root));
$web_root = $web_root . $folder;
define('_WEB_ROOT', $web_root);

// Tự động load config
$config_dir = scandir('configs');
if(!empty($config_dir)){
    foreach($config_dir as $value){
        if($value !== '.' && $value !== '..' && file_exists('configs/'.$value)){
            require_once 'configs/' . $value;
        }
    }
}

if(!empty($config['app']['service'])){
    $allService = $config['app']['service'];
    if(!empty($allService)){
        foreach($allService as $service){
            if(file_exists('app/core/'. $service . '.php')){
                require_once 'app/core/' . $service . '.php';
            }
        }
    }
   
}

require_once './core/Load.php';

// load service provider
require_once './core/ServiceProvider.php';

// load view class
require_once './core/View.php';

// load middleware class
require_once './core/Middleware.php';

require_once './core/Route.php'; // load routes
require_once './core/Session.php';

// kiểm tra config và load database
if(!empty($config)){
    $db_config = $config['database'];
    if(!empty($db_config)){
        require_once './core/Connection.php';
        require_once './core/QueryBuilder.php';
        require_once './core/Database.php';
        require_once './core/DB.php';
    }
}

// load class Helper
require_once './core/Helper.php';

//load file helper
$allHelper = scandir('app/helpers');
if(!empty($allHelper)){
    foreach($allHelper as $key => $value){
        if($value !== '.' && $value !== '..' && file_exists('app/helpers/'.$value)){
            require_once 'app/helpers/' . $value;
        }
    }
}
require_once './app/App.php';


require_once './core/Model.php';
require_once './core/Template.php';
require_once './core/Controller.php';
require_once './core/Request.php';
require_once './core/Response.php';