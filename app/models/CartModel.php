<?php
//CartModel Model 
class CartModel extends Model{
     public function tableFill(){
        return 'tbl_cart';
    }

    public function fieldFill(){
        return '*';
    }

    public function primaryId(){
        return 'idCart';
    }

    public function getAllCarts($session_id){
        $data = $this->db->table($this->tableFill())->where('idSession', '=', $session_id)->get();
        return $data;
    }

    public function getCart($id){
        $data = $this->db->table($this->tableFill())->where($this->primaryId(), '=', $id)->first();
        return $data;
    }

    public function getCartByPro($id, $session_id){
        $data = $this->db->table($this->tableFill())->where('idProduct', '=', $id)->where('idSession', '=', $session_id)->first();
        return $data;
    }

    public function insertCart($data){
        $status = $this->db->table($this->tableFill())->insert($data);
        return $status;
    }

    public function updateCart($session_id, $id, $data){
        $status = $this->db->table($this->tableFill())->where('idProduct', '=', $id)->where('idSession', '=', $session_id)->update($data);
        return $status;
    }

    public function deleteCart($session_id, $id){
        $status = $this->db->table($this->tableFill())->where('idProduct', '=', $id)->where('idSession', '=', $session_id)->delete();
        return $status;
    }
}