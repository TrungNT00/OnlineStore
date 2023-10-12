<?php
class Database{
    private $__conn;
    use QueryBuilder;
    public function __construct(){
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    //truy vấn sql
    function query($sql, $data=[], $statementStt = false){
        $query = false;
    
        try{
            $statement = $this->__conn->prepare($sql);
    
            if(empty($data)){
                $query = $statement->execute();
            } else {
                $query = $statement->execute($data);
            }
    
        }catch(Exception $ex){
            $mess = $ex->getMessage();
            $line = $ex->getLine();
            $file = $ex->getFile();
            $data = [
                'mess' => $mess,
                'line' => $line,
                'file' => $file
            ];
            App::$app->loadErr('database', $data);
            die();
        }
    
        if($statementStt == true && $query == true){
            return $statement;
        }
    
        return $query;
    }
    
    // chèn dữ liệu vào database
    function insertData($table,$dataInsert){
        if(!empty($dataInsert)){
            $keyArr = array_keys($dataInsert);
            $keyStr = implode(',', $keyArr);
            $valueStr = ':'.implode(',:', $keyArr);
    
            $sql = "INSERT INTO $table(".$keyStr.") VALUES(".$valueStr.")";
            return $this->query($sql, $dataInsert);
        } else {
            return false;
        }
    }
    
    // cập nhật dữ liệu trong database
    function updateData($table, $dataUpdate, $condition=''){
        if(!empty($dataUpdate)){
            $updateStr = '';
            foreach($dataUpdate as $key => $value){
                $updateStr .= $key.'=:'.$key.', ';
            }
            
            $updateStr = rtrim($updateStr, ', ');
            
            if(!empty($condition)){
                $sql = 'UPDATE '. $table .' SET '. $updateStr .' WHERE '. $condition;
            } else {
                $sql = 'UPDATE '. $table .' SET '. $updateStr;
            }
    
            return $this->query($sql, $dataUpdate);
        } else {
            echo false;
        }
    }
    
    //xóa dữ liệu trong datbase
    function deleteData($table, $condition=''){
        if(empty($condition)){
            $sql = "DELETE FROM $table ";
        } else {
            $sql = "DELETE FROM $table WHERE $condition";
        }
        
        return $this->query($sql);
    }
    

    // lấy id cuối cùng khi thêm mới
    function getLastId(){
        return $this->__conn->lastInsertId();
    }
}