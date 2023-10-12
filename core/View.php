<?php
class View{
    public static $dataShare = null;

    public static function share($data){
        self::$dataShare = $data;
    }
}