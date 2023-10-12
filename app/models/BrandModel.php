<?php
//BrandModel Model 
class BrandModel extends Model{
     public function tableFill(){
        return 'tbl_brand';
    }

    public function fieldFill(){
        return '*';
    }

    public function primaryId(){
        return 'idBrand';
    }

    public function getAllBrands(){
        $data = $this->db->table($this->tableFill())->get();
        return $data;
    }

    public function getBrand($id){
        $data = $this->db->table($this->tableFill())->where($this->primaryId(), '=', $id)->first();
        return $data;
    }

    public function insertBrand($data){
        $status = $this->db->insertData($this->tableFill(), $data);
        return $status;
    }

    public function updateBrand($id, $data){
        $status = $this->db->table($this->tableFill())->where($this->primaryId(), '=', $id)->update($data);
        return $status;
    }

    public function deleteBrand($id){
        $status = $this->db->table($this->tableFill())->where($this->primaryId(), '=', $id)->delete();
        return $status;
    }
}