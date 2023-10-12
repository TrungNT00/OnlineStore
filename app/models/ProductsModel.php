<?php
//ProductsModel Model 
class ProductsModel extends Model{
    public function tableFill(){
        return 'tbl_product';
    }

    public function fieldFill(){
        return '*';
    }

    public function primaryId(){
        return 'idProduct';
    }

    public function getAllProducts(){
        $data = $this->db->table($this->tableFill())->get();
        return $data;
    }

    public function getProduct($id){
        $data = $this->db->table($this->tableFill())->where($this->primaryId(), '=', $id)->first();
        return $data;
    }

    public function insertProduct($data){
        $status = $this->db->table($this->tableFill())->insert($data);
        return $status;
    }

    public function updateProduct($id, $data){
        $status = $this->db->table($this->tableFill())->where($this->primaryId(), '=', $id)->update($data);
        return $status;
    }

    public function deleteProduct($id){
        $status = $this->db->table($this->tableFill())->where($this->primaryId(), '=', $id)->delete();
        return $status;
    }

    // Clients section
    public function getProductByCate($cateName){
        $data = $this->db->table($this->tableFill())->join('tbl_category', 'tbl_product.idCategory = tbl_category.idCategory')->where('catName' , '=', $cateName)->orderBy($this->primaryId(), 'DESC')->first();
        return $data;
    }

    public function searchProduct($search){
        $data = $this->db->table($this->tableFill())->wherLike('proName', $search)->get();
        return $data;
    }
}