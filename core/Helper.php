<?php
$sessionKey = Session::isInvalid();
$errors = Session::flashData($sessionKey .'_error');
$old = Session::flashData($sessionKey . '_old');

if(!function_exists('form_error')){
    function form_error($fieldName){
        global $errors;
        if(!empty($errors) && array_key_exists($fieldName,$errors)){
            return '<span style="color:red; display:block;">'. $errors[$fieldName] .'</span>';
        }
    }
}

if(!function_exists('old')){
    function old($fieldName, $default=''){
        global $old;
        if(!empty($old[$fieldName])){
            return $old[$fieldName];
        } 

        return $default;
    }
}