<?php
namespace App\Controller;

use App\Core\Session;
use App\Model\ModelUsuario;
use App\Core\Exception\Session\NotLoggedInException;
use App\Core\Exception\Session\InsufficientRightsException;

abstract class ControllerUserSession extends Controller {
    
    public function __construct(){
        parent::__construct();
        $this->checkAuth();
    }
    
    protected function checkAuth(){
        if(!$this->checkLogin()){
            return;
        }
        if(!$this->checkPrivileges(self::getUser())){
            throw new InsufficientRightsException();
        }
        $this->logAcess();
    }
    
    protected function logAcess(){
        $oLogAcesso = new \App\Model\ModelLogsAcesso();
        $oLogAcesso->setUsuario(self::getUser());
        $oLogAcesso->setDataHora(now());
        $oLogAcesso->setIp(getClientIp());
        $oLogAcesso->setPathApp($this->getPath());
        $oLogAcesso->setDescricao($this->getDescriptionLog());
        $oLogAcesso->insert();
    }
    
    protected function getDescriptionLog(){
        return '';
    }
    
    protected function checkLogin(){
        return true;
    }
    
    protected function checkPrivileges(ModelUsuario $oUser){
        return $oUser->getTipo() == ModelUsuario::TIPO_ADMIN;
    }
    
    public static function isAuth(){
        $oUser = Session::get('user', false, true);
        return $oUser instanceof ModelUsuario;
    }
    
    public static function getUser(){
        if(!self::isAuth())
            throw new NotLoggedInException();
        return Session::get('user', false, true);
    }
    
    public static function update(ModelUsuario $oUser){
        Session::set('user', $oUser, true);
    }
    
    public static function login(ModelUsuario $oUser){
        self::update($oUser);
    }
    
    public static function logout(){
        Session::del('user');
        Session::finish();
    }
    
}