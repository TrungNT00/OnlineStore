<?php
//HomeModel Model 
class HomeModel extends Model{
     public function tableFill(){
        return 'table_name';
    }

    public function fieldFill(){
        return '*';
    }

    public function primaryId(){
        return 'id';
    }
}