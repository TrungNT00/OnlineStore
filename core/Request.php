<?php
class Request{
    /**
     * 1. Method
     * 2. Body
     */

    private $__rules = [], $__messages = [], $__errors = [];
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getMethod(){
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost(){
        if($this->getMethod() == 'post'){
            return true;
        }
        return false;
    }

    public function isGet(){
        if($this->getMethod() == 'get'){
            return true;
        }
        return false;
    }

    public function getFields(){
        $dataFields = [];
        if($this->isGet()){
            //Xử lí lấy dữ liệu với phương thức Get
            if(!empty($_GET)){
                foreach($_GET as $key => $value){
                    if(is_array($value)){
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }
        }

        if($this->isPost()){
            //Xử lí lấy dữ liệu với phương thức POST
            if(!empty($_POST)){
                foreach($_POST as $key => $value){
                    if(is_array($value)){
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                    } else {
                        $dataFields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                    }
                }
            }

            if(!empty($_FILES)){
                foreach($_FILES as $key => $value){
                    $dataFields[$key] = array_filter($value);
                }
            }

        }

        return $dataFields;
    }

    // Thiết lập rules
    public function rules($rules= []){
        $this->__rules = $rules;
    }

    // thiết lập message
    public function message($messages = []){
        $this->__messages = $messages;
    }

    // Run validate
    public function validate(){
        $this->__rules = array_filter($this->__rules);
        $check = true;

        if(!empty($this->__rules)){
            $dataField = $this->getFields();
           
            foreach($this->__rules as $fieldName => $ruleItem){
                $ruleItemArr = explode('|', $ruleItem);
                foreach($ruleItemArr as $rules){
                    $ruleName = null;
                    $ruleValue = null;
                    $ruleArr = explode(':', $rules);

                    $ruleName = reset($ruleArr);
                    if(count($ruleArr) > 1){
                        $ruleValue = end($ruleArr);
                    }

                    if($ruleName == 'required'){
                        if(empty($dataField[$fieldName])){
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if($ruleName == 'min'){
                        if(strlen(trim($dataField[$fieldName])) < $ruleValue){
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if($ruleName == 'max'){
                        if(strlen(trim($dataField[$fieldName])) > $ruleValue){
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if($ruleName == 'minNum'){
                        if(is_numeric($dataField[$fieldName])){
                            if($dataField[$fieldName] < $ruleValue){
                                $this->setError($fieldName, $ruleName);
                                $check = false;
                            }
                        }
                    }

                    if($ruleName == 'maxNum'){
                        if(is_numeric($dataField[$fieldName])){
                            if($dataField[$fieldName] > $ruleName){
                                $this->setError($fieldName, $ruleName);
                                $check = false;
                            }
                        }
                    }

                    if($ruleName == 'uniqueExisted'){
                        $tableName = null;
                        $fieldCheck = null;
                        if(!empty($ruleArr[1])){
                            $tableName = $ruleArr[1];
                        }

                        if(!empty($ruleArr[2])){
                            $fieldCheck = $ruleArr[2];
                        }

                        if(!empty($tableName) && !empty($fieldCheck)){
                            $dataField[$fieldName] = trim($dataField[$fieldName]);
                            if(count($ruleArr) == 3){
                                $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataField[$fieldName]'",[], true)->rowCount();
                            } else if(count($ruleArr) == 4){
                                if(!empty($ruleArr[3]) && preg_match('~.+?\=.+?~is', $ruleArr[3])){
                                    $conditionWhere = $ruleArr[3];
                                    $conditionWhere = str_replace('=', '<>', $conditionWhere);
                                    $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataField[$fieldName]' AND $conditionWhere",[], true)->rowCount();
                                }
                            }
                            if(!empty($checkExist)){
                                $this->setError($fieldName,$ruleName);
                                $check = false;
                            }
                        }
                    }

                    if($ruleName == 'uniqueLogin'){
                        $tableName = null;
                        $fieldCheck = null;
                        if(!empty($ruleArr[1])){
                            $tableName = $ruleArr[1];
                        }

                        if(!empty($ruleArr[2])){
                            $fieldCheck = $ruleArr[2];
                        }

                        if(!empty($tableName) && !empty($fieldCheck)){
                            $dataField[$fieldName] = trim($dataField[$fieldName]);
                            if(count($ruleArr) == 3){
                                $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataField[$fieldName]'",[], true)->rowCount();
                            } else if(count($ruleArr) == 4){
                                if(!empty($ruleArr[3]) && preg_match('~.+?\=.+?~is', $ruleArr[3])){
                                    $conditionWhere = $ruleArr[3];
                                    $conditionWhere = str_replace('=', '<>', $conditionWhere);
                                    $checkExist = $this->db->query("SELECT $fieldCheck FROM $tableName WHERE $fieldCheck = '$dataField[$fieldName]' AND $conditionWhere",[], true)->rowCount();
                                }
                            }
                            if(empty($checkExist)){
                                $this->setError($fieldName,$ruleName);
                                $check = false;
                            }
                        }
                    }

                    if($ruleName == 'check'){
                        $tableName = null;
                        $fieldCheck = null;
                        if(!empty($ruleArr[1])){
                            $tableName = $ruleArr[1];
                        }

                        if(!empty($ruleArr[2])){
                            $fieldCheck1 = $ruleArr[2];
                        }

                        if(!empty($ruleArr[3])){
                            $fieldCheck2 = $ruleArr[3];
                        }

                        if(!empty($ruleArr[4])){
                            $valueCheck = $ruleArr[4];
                        }

                        if(!empty($tableName) && !empty($fieldCheck1) && !empty($fieldCheck2) && !empty($valueCheck)){
                            $valueCheck1 = trim($dataField[$valueCheck]);
                            $valueCheck2 = md5(trim($dataField[$fieldName]));
                            $checkExist = $this->db->query("SELECT $fieldCheck1 FROM $tableName WHERE $fieldCheck2 = '$valueCheck1' AND $fieldCheck1 = '$valueCheck2'",[], true)->rowCount();
                            
                            if(empty($checkExist)){
                                $this->setError($fieldName,$ruleName);
                                $check = false;
                            }
                        }
                    }

                    if($ruleName == 'email'){
                        if(!filter_var(trim($dataField[$fieldName]),FILTER_VALIDATE_EMAIL)){
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if($ruleName == 'matched'){
                        if(trim($dataField[$fieldName]) != trim($dataField[$ruleValue])){
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if($ruleName == 'phone'){
                        if(!preg_match('~^(0)\d{9}$~',trim($dataField[$fieldName]))){
                            $this->setError($fieldName, $ruleName);
                            $check = false;
                        }
                    }

                    if($ruleName == 'file'){
                        $ext = ['jpg', 'png', 'jpeg'];
                        if($ruleValue == 'required') {
                            if(empty($_FILES[$fieldName]['name'])){
                                $this->setError($fieldName, $ruleValue);
                                $check = false;
                            } else {
                                $nameFile = $_FILES[$fieldName]['name'];
                            }
                        }

                        
                        if($ruleValue == 'extend'){
                            $nameFileArr = explode('.', $nameFile);
                            $extFile = end($nameFileArr);

                            if(!in_array($extFile,$ext)){
                                $this->setError($fieldName, $ruleValue);
                                $check = false;
                            }
                        } 

                        
                        if($ruleValue == 'size'){
                            if($_FILES[$fieldName]['size'] < 0 && $_FILES[$fieldName]['size'] > 5000000){
                                $this->setError($fieldName, $ruleValue);
                                $check = false;
                            }
                        }

                        if($ruleValue == 'error'){
                            if($_FILES[$fieldName]['error'] == 4){
                                $this->setError($fieldName, $ruleValue);
                                $check = false;
                            }
                        }
                    }

                    if(preg_match('~^callback_(.+)~is', $ruleName, $callbackArr)){
                        $callbackName = $callbackArr[1];
                        $controller = App::$app->getCurrentController();

                        if(method_exists($controller,$callbackName)){
                            $checkCallback = call_user_func_array([$controller,$callbackName],[trim($dataField[$fieldName])]);
                            if(!$checkCallback){
                                $this->setError($fieldName, $ruleName);
                                $check = false;
                            }
                        }
                    }
                }
            }
        }

        $sessionKey = Session::isInvalid();
        Session::flashData($sessionKey . '_error', $this->getErrors());
        Session::flashData($sessionKey . '_old', $this->getFields());
        
        return $check;

    }

    // Lấy lỗi
    public function getErrors($fileName = ''){
        if(!empty($this->__errors)){
            if(empty($fileName)){
                $errorsArr = [];
                foreach($this->__errors as $key => $error){
                    $errorsArr[$key] = reset($error);
                }
                return $errorsArr;
            }

            return reset($this->__errors[$fileName]);
        } 
    }

    //Thiết lập cú pháp lỗi
    private function setError($fieldName, $ruleName){
        $this->__errors[$fieldName][$ruleName] = $this->__messages[$fieldName.'.'.$ruleName];
    }
}