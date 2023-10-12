<?php
trait QueryBuilder{
    protected $tableName = '';
    protected $where = '';
    protected $operator = '';
    protected $selectField = '*';
    protected $limit = '';
    protected $orderBy = '';
    protected $innerJoin = '';

    public function table($tableName){
        $this->tableName = $tableName;
        return $this;
    }

    // điều kiện AND
    public function where($field, $compare, $value){
        if(empty($this->where)){
            $this->operator =  " WHERE ";
        } else {
            $this->operator = " AND ";
        }
        $this->where .= "$this->operator $field $compare '$value'";
        return $this;
    }

    // điều kiện OR
    public function orWhere($field, $compare, $value){
        if(empty($this->where)){
            $this->operator = " WHERE ";
        } else {
            $this->operator = " OR ";
        }

        $this->where .= "$this->operator $field $compare '$value'";
        return $this;
    }

    // điều kiện LIKE AND
    public function wherLike($field, $value){
        if(empty($this->where)){
            $this->operator = " WHERE ";
        } else {
            $this->operator = " AND ";
        }

        $this->where .= "$this->operator $field LIKE '%$value%'";
        return $this;
    }

    // chọn trường
    public function select($field = '*'){
        $this->selectField = $field;
        return $this;
    }

    // giới hạn
    public function limit($offset, $number=0){
        $this->limit = "LIMIT $offset, $number";
        return $this;
    }

    // sắp xếp theo ...
    public function orderBy($field, $type = 'ASC'){
        $fieldArr = array_filter(explode(',', $field));
        if(empty($fieldArr) && count($fieldArr) >= 2){
            // nhiều orderBY 
            $this->orderBy = "ORDER BY". implode(',', $fieldArr);
        } else {
            $this->orderBy = "ORDER BY $field $type";
        }
        return $this;
    }

    // inner join
    public function join($tableName, $relationship){
        $this->innerJoin .= "INNER JOIN ".$tableName. " ON " . $relationship;
        return $this;
    }

    // thêm dữ liệu
    public function insert($data){
        $tableName = $this->tableName;
        $insertStatus = $this->insertData($tableName, $data);
        return $insertStatus;
    }

    // lấy id vừa thêm dữ liệu
    public function lastId(){
        return $this->lastInsertId();
    }

    // cập nhật dữ liệu
    public function update($data){
        $whereUpdate = str_replace('WHERE', '', $this->where);
        $whereUpdate = trim($whereUpdate);
        $tableName = $this->tableName;
        $updateStatus = $this->updateData($tableName, $data, $whereUpdate);
        return $updateStatus;
    }

    // xóa dữ liệu
    public function delete(){
        $delWhere = str_replace("WHERE", '', $this->where);
        $delWhere = trim($delWhere);
        $tableName = $this->tableName;
        $deleteStatus = $this->deleteData($tableName,$delWhere);
        return $deleteStatus;
    }

    // lấy tất cả bản ghi
    public function get(){
        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where $this->orderBy $this->limit";
        $this->resetQuery();
        $query = $this->query($sqlQuery,[], true);
        if($query){
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } 
        return false;
    }

    // lấy 1 bản ghi
    public function first(){
        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->innerJoin $this->where $this->orderBy $this->limit";
        $this->resetQuery();
        $query = $this->query($sqlQuery,[], true);
        if($query){
            return $query->fetch(PDO::FETCH_ASSOC);
        }
        
        return false;
    }

    // reset query
    private function resetQuery(){
        $this->tableName = '';
        $this->where = '';
        $this->operator = '';
        $this->selectField = '*';
        $this->limit = '';
        $this->orderBy = '';
        $this->innerJoin = '';
    }
}