<?php
class Sessao implements SessionHandlerInterface {

    const NATIVE   = 1;
    const DATABASE = 2;

    public static function init($type){
        if(isEmpty(session_id())){
            if($type == self::DATABASE){
                session_set_save_handler(new Sessao(), true);
            }
            session_start();
        }
    }

    public function open($path, $session_name){

    }

    public function read($id){

    }

    public function write($id, $data){

    }

    public function close(){

    }

    public function destroy($id){

    }

    public function gc($maxlifetime){

    }

    public static function set($key, $val, $serialize = false){
        $_SESSION[$key] = $serialize ? serialize($val) : $val;
    }

    public static function get($key, $default = '', $unserialize = false){
        if(!isset($_SESSION[$key])){
            return $default;
        }
        return $unserialize ? unserialize($_SESSION[$key]) : $_SESSION[$key];
    }
    
}
