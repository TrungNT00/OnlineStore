<?php
//AdminModel Model 
class AdminModel extends Model{
    public function tableFill(){
        return 'tbl_admin';
    }

    public function fieldFill(){
        return '*';
    }

    public function primaryId(){
        return 'id_admin';
    }

    public function getAdmins(){
        $data = $this->db->table($this->tableFill())->get();
        return $data;
    }

    public function updateAdmin($id, $dataUpdate){
        $status = $this->db->updateData($this->tableFill(), $dataUpdate, $this->primaryId() . " = $id");
        return $status;
    }
}