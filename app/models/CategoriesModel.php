<?php
//CategoriesModel Model 
class CategoriesModel extends Model{
     public function tableFill(){
        return 'tbl_category';
    }

    public function fieldFill(){
        return '*';
    }

    public function primaryId(){
        return 'idCategory';
    }
    
    public function getAllCategories(){
        $data = $this->db->table($this->tableFill())->get();
        return $data;
    }

    public function getCategory($id){
        $data = $this->db->table($this->tableFill())->where('idCategory', '=', $id)->first();
        return $data;
    }

    public function addCategories($dataInsert){
        $status = $this->db->insertData($this->tableFill(), $dataInsert);
        return $status;
    }

    public function updateCategory($id, $dataUPdate){
        $status = $this->db->updateData($this->tableFill(), $dataUPdate, $this->primaryId() . "=$id");
        return $status;
    }

    public function deleteCategory($id){
       $status = $this->db->table($this->tableFill())->where('idCategory', '=', $id)->delete();
       return $status;
    }
}