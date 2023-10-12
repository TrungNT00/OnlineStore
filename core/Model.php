<?php
abstract class Model extends Database
{
   protected $db;
   public function __construct()
   {
      $this->db = new Database();
   }

   abstract public function tableFill();
   abstract public function fieldFill();

   // lấy tất cả dữ liệu
   public function get()
   {
      $tableName = $this->tableFill();
      $fieldName = $this->fieldFill();
      if (empty($fieldName)) {
         $fieldName = '*';
      }
      $sql = "SELECT $fieldName FROM $tableName";

      $query = $this->db->query($sql, [], true);
      if ($query) {
         return $query->fetchAll(PDO::FETCH_ASSOC);
      }

      return false;
   }

   //lấy 1 dữ liệu
   public function first()
   {
      $tableName = $this->tableFill();
      $fieldName = $this->fieldFill();
      if (empty($fieldName)) {
         $fieldName = '*';
      }
      $sql = "SELECT $fieldName FROM $tableName";
      $query = $this->db->query($sql, [], true);
      if ($query) {
         return $query->fetch(PDO::FETCH_ASSOC);
      }

      return false;
   }
}
