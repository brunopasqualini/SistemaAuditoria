<?php
namespace App\Core;

use App\Core\Database\Query;

class Session implements \SessionHandlerInterface {

    const TABLE_NAME = 'tbsession';
    const NAME       = 'user_token';
    const NATIVE     = 1;
    const DATABASE   = 2;

    private $Query;

    public static function init($iType){
        if(isEmpty(session_id())){
            session_name(self::NAME);
            if($iType == self::DATABASE){
                session_set_save_handler(new Session(), true);
            }
            session_start();
        }
    }

    public function open($sPath, $sSession_name){
        $this->Query = new Query();
        return true;
    }

    public function read($sId){
        $sData = '';
        $this->Query->setSql('SELECT sesinfo FROM '.self::TABLE_NAME.' WHERE SESID = ?');
        $this->Query->execute([$sId]);
        if(!$aSession = $this->Query->fetch()){
            $sSql = Query::getInsert(self::TABLE_NAME, [
                'sesid', 'sesinfo', 'sesip', 'sesactive', 'sesdtcreate', 'sesdtactivity'
            ]);
            $this->Query->setSql($sSql);
            $this->Query->execute([$sId, $sData, getClientIp(), 1, now(), now()]);
        }
        else{
            $sData = base64_decode($aSession['sesinfo']);
        }
        return $sData;
    }

    public function write($sId, $sData){
        $sData   = base64_encode($sData);
        $sUpdate = Query::getUpdate(self::TABLE_NAME, [
            'sesinfo', 'sesdtactivity'
        ]);
        $this->Query->setSql($sUpdate . ' WHERE sesid = ?');
        $this->Query->execute([$sData, now(), $sId]);
        return true;
    }

    public function destroy($sId){
        $this->Query->setSql('DELETE FROM '.self::TABLE_NAME.' WHERE SESID = ?');
        $this->Query->execute([$sId]);
        return true;
    }

    public function close(){
        $this->Query = null;
    }

    public function gc($maxlifetime){

    }

    public static function set($sKey, $xVal, $bSerialize = false){
        $_SESSION[$sKey] = $bSerialize ? serialize($xVal) : $xVal;
    }

    public static function get($sKey, $xDefault = '', $bUnserialize = false){
        if(!isset($_SESSION[$sKey])){
            return $xDefault;
        }
        return $bUnserialize ? unserialize($_SESSION[$sKey]) : $_SESSION[$sKey];
    }

}
