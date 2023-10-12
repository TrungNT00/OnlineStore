<?php
//PaymentModel Model 
class PaymentModel extends Model{
     public function tableFill(){
        return 'tbl_order';
    }

    public function fieldFill(){
        return '*';
    }

    public function primaryId(){
        return 'idOrder';
    }

    public function getAllOrders(){
        $data = $this->db->table($this->tableFill())->get();
        return $data;
    }

    public function getOrder($id){

    }

    public function getOrderByCustomer($id){
        $data = $this->db->table($this->tableFill())->where('idCustomer', '=', $id)->get();
        return $data;
    }

    public function insertOrder($data){
        $status = $this->db->table($this->tableFill())->insert($data);
        return $status;
    }

    public function updateOrder($id, $data){

    }

    public function deleteOrder($id){

    }
}