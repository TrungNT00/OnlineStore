<?php
class App{
    private $__controller, $__action, $__params, $__routes, $__db;
    public static $app;

    public function __construct(){
        global $routes, $config;
        self::$app = $this;
        if(!empty($routes['default_controller'])){
            $this->__controller = $routes['default_controller'];
        }

        $this->__routes = new Route();
        $this->__action = 'index';
        $this->__params = [];

        if(class_exists('DB')){
            $dbObject = new DB();
            $this->__db = $dbObject->db;
        }
        /**
         * truy vấn query builder
         */
        $this->handleUrl();
    }

    public function getUrl(){
        if(!empty($_SERVER['PATH_INFO'])){
            $url = $_SERVER['PATH_INFO'];
        } else {
            $url = '/';
        }

        return $url;
    }

    private function handleUrl(){
        $url = $this->getUrl();
        $url = $this->__routes->handleRoute($url);

        // MiddleWare
        // $this->handleGlobalMiddleWare($this->__db);
        // $this->handleRouteMiddleWare($this->__routes->getUri(), $this->__db);

        // // Service Provider
        // $this->handleServiceProvider($this->__db);

        $urlArr = explode('/', $url);
        $urlArr = array_filter($urlArr);
        $urlArr = array_values($urlArr);

        $urlCheck = '';
        if(!empty($urlArr)){
            foreach($urlArr as $key => $item){
                $urlCheck .= $item . '/';
                $fileCheck = rtrim($urlCheck, '/');
    
                $fileArr = explode('/', $fileCheck);
    
                $fileArr[count($fileArr)-1] = ucfirst($fileArr[count($fileArr)-1]);
                $fileCheck = implode('/', $fileArr);
    
                if(!empty($urlArr[$key-1])){
                    unset($urlArr[$key-1]);
                }
    
                if(file_exists('app/controllers/' . ($fileCheck) . '.php')){
                    $urlCheck = $fileCheck;
                    break;
                }
            }

            $urlArr = array_values($urlArr);
        }

        //Xử lí controller
        if(!empty($urlArr[0])){
            $this->__controller = ucfirst($urlArr[0]);
        } else{
            $this->__controller = ucfirst($this->__controller);
        }

        //Xử lí khi url rỗng
        if(empty($urlCheck)){
            $urlCheck = $this->__controller;
        }

        if(file_exists('app/controllers/' . $urlCheck . '.php')){
            require_once 'app/controllers/' .$urlCheck . '.php';

            //kiểm tra class $this->__controller tồn tại
            if(class_exists($this->__controller)){
                $this->__controller = new $this->__controller;
                if(!empty($this->__db)){
                    $this->__controller->db = $this->__db;
                }
                unset($urlArr[0]);
            } else {
                $this->loadErr();
            }
        } else {
            $this->loadErr();
        }

        // Xử lí action
        if(!empty($urlArr[1])){
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }

        //Xử lí param
        $this->__params = array_values($urlArr);
        if(method_exists($this->__controller, $this->__action)){
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loadErr();
        }

    }

    public function getCurrentController(){
        return $this->__controller;
    }

    public function loadErr($err='404', $data =[]){
        extract($data);
        require_once 'app/errors/'.$err.'.php';
    }

    // MiddleWare app
    // public function handleRouteMiddleWare($routeKey, $db){
    //     global $config;
    //     $routeKey = trim($routeKey);
    //     if(!empty($config['app']['routeMiddleware'])){
    //         $routeMiddleWareArr = $config['app']['routeMiddleware'];
    //         if(!empty($routeMiddleWareArr)){
    //             foreach($routeMiddleWareArr as $key=> $middleWareItem){
    //                 if($routeKey == trim($key) && file_exists('app/middlewares/' . $middleWareItem . '.php')){
    //                     require_once 'app/middlewares/' . $middleWareItem . '.php';
    //                     if(class_exists($middleWareItem)){
    //                         $middleWareObject = new $middleWareItem();
    //                         if(!empty($db)){
    //                             $middleWareObject->db = $db;
    //                             $middleWareObject->handle();
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }

    // public function handleGlobalMiddleWare($db){
    //     global $config;
    //     if(!empty($config['app']['globalMiddleware'])){
    //         $globalMiddleWareArr = $config['app']['globalMiddleware'];
    //         if(!empty($globalMiddleWareArr)){
    //             foreach($globalMiddleWareArr as $middleWareItem){
    //                 if(file_exists('app/middlewares/' . $middleWareItem . '.php')){
    //                     require_once 'app/middlewares/' . $middleWareItem . '.php';
    //                     if(class_exists($middleWareItem)){
    //                         $middleWareObject = new $middleWareItem();
    //                         $middleWareObject->handle();
    //                     }
    //                 }
    //             }
    //         }
    //     }
    // }

    // public function handleServiceProvider($db){
    //     global $config;
    //     if(!empty($config['app']['boot'])){
    //         $serviceProviderArr = $config['app']['boot'];
    //         if(!empty($serviceProviderArr)){
    //             foreach($serviceProviderArr as $service){
    //                 if(file_exists('app/core/' . $service . '.php')){
    //                     require_once 'app/core/' . $service . '.php';
    //                     if(class_exists($service)){
    //                         $serviceObject = new $service();
    //                         if(!empty($db)){
    //                             $serviceObject->db = $db;
    //                             $serviceObject->boot();
    //                         }
    //                     }
    //                 }
    //             }
    //         }
    //     }

    // }
}