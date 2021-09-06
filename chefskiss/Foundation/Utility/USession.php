<?php

class USession{

    public function __construct(){
        session_start();
    }

    static function setValue(String $key, $value){
        $_SESSION[$key] = $value;
    }

    static function destroyValue(String $key){
        unset($_SESSION[$key]);
    }

    function readValue(String $key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        else return false;
    }

    static function destroySession(){
        session_destroy();
    }
}


?>