<?php
//CustomerModel Model 
class CustomerModel extends Model{
     public function tableFill(){
        return 'tbl_customer';
    }

    public function fieldFill(){
        return '*';
    }

    public function primaryId(){
        return 'idCustomer';
    }

    public function getCustomers(){
        $data = $this->db->table('tbl_customer')->get();
        return $data;
    }

    public function getCustomer($id){
        $data = $this->db->table($this->tableFill())->where($this->primaryId(), '=', $id)->first();
        return $data;
    }

    public function insertCustomer($dataInsert=[]){
        $status = $this->db->insertData($this->tableFill(), $dataInsert);

        return $status;
    }

    public function updateCustomer($id, $data){
        $status = $this->db->table($this->tableFill())->where($this->primaryId(), '=', $id)->update($data);
        return $status;
    }
}