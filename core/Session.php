<?php
class Session{
    /**
     * data($key, $value) => set Session
     * data($key) => get Session
     */
    public static function data($key, $value = ''){
        $sessionKey = self::isInvalid();
        if(!empty($value)){
            // set session
            if(!empty($key)){
                $_SESSION[$sessionKey][$key] = $value;
                return true;
            }
            
        } else {
            if(empty($key)){
                if(isset($_SESSION[$sessionKey])){
                    // get all session
                    return $_SESSION[$sessionKey];  
                }
            } else {
                if(isset($_SESSION[$sessionKey][$key])){
                    // get session
                    return $_SESSION[$sessionKey][$key];
                }
            }
        }
        
    }
    /**
     * delete($key) =>  xóa session vs key
     * delete() => xóa hết session 
     */

    public static function delete($key=''){
        $sessionKey = self::isInvalid();
        if(!empty($key)){
            if(isset($_SESSION[$sessionKey][$key])){
                unset($_SESSION[$sessionKey][$key]);
                return true;
            } 
            return false;
        } else {
            unset($_SESSION[$sessionKey]);
            return true;
        }

        return false;   
    }

    /**
     * Flash Data
     * set flash data  => giống như set session
     * get flash data => giống như get session , rồi xóa session sau khi get
     */
    public static function flashData($key='', $value=''){
        $dataSession = self::data($key, $value);
        
        if(empty($value)){
            self::delete($key);
        } 
        return $dataSession;
    }

    public static function showErr($message){
        App::$app->loadErr('exception',['message' => $message]);
        die();
    }

    public static function isInvalid(){
        global $config;
        if(!empty($config['session'])){
            $session_config = $config['session'];    
            if(!empty($session_config['session_key'])){
                $sessionKey = $session_config['session_key'];
                return $sessionKey;
            } else{
                self::showErr('Thiếu cấu hình session. Vui lòng kiểm tra File configs/session.php');
            }
        } else {
            self::showErr('Thiếu cấu hình session. Vui lòng kiểm tra File configs/session.php');
        }
    }
}