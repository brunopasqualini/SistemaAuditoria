<?php
namespace App\Model;

/**
 * @Table(name=tbusuario)
 */
class ModelUsuario {

    /**
     * Usuário normal
     */
    const TIPO_NORMAL = 1;

    /**
     * Usuário administrador
     */
    const TIPO_ADMIN  = 2;

    /**
     * @FK
     */
    private $Cliente;

    /**
     * @PK
     * @Serial
     * @Column(name=usucodigo)
     */
    private $codigo;

    /**
     * @Column(name=usulogin)
     */
    private $login;

    /**
     * @Column(name=ususenha)
     */
    private $senha;

    /**
     * @Column(name=usuemail)
     */
    private $email;

    /**
     * @Column(name=usuativo)
     */
    private $ativo;

    /**
     * @Column(name=usutipo)
     */
    private $tipo;

    public function getCliente(){
        if(!isset($this->Cliente)){
            $this->Cliente = new ModelCliente();
        }
        return $this->Cliente;
    }

    public function setCliente($oCliente){
        $this->Cliente = $oCliente;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($iCodigo){
        $this->codigo = $iCodigo;
    }

    public function getLogin(){
        return $this->login;
    }

    public function setLogin($sLogin){
        $this->login = $sLogin;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($sSenha){
        $this->senha = $sSenha;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($sEmail){
        $this->email = $sEmail;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setAtivo($bAtivo){
        $this->ativo = $bAtivo;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($iTipo){
        $this->tipo = $iTipo;
    }

}
