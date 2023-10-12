<?php
class Connection{
    private static $instance = null, $conn = null;
    private function __construct($config){
        try{
            if(class_exists('PDO')){ 
                $dns = $config['driver'].":host=".$config['host']."; dbname=".$config['db_name'];
                $options = [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // thiết lập utf-8
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //đẩy lỗi vào exception
                ];
                $con = new PDO($dns,$config['user'], $config['pass'],$options);
            } 
            self::$conn = $con;
        }catch(Exception $ex){
            $mess = $ex->getMessage();
            $line = $ex->getLine();
            $file = $ex->getFile();
            $data = [
                'mess' => $mess,
                'line' => $line,
                'file' => $file
            ];
            App::$app->loadErr('database', $data);
            die();
        }
    }

    public static function getInstance($config){
        if(self::$instance == null){
            $connection = new Connection($config);
            self::$instance = self::$conn;  
        }

        return self::$instance;
    }
}