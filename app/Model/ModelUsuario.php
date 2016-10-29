<?php
namespace App\Model;

/**
 * @Table(name=tbusuario)
 */
class ModelUsuario extends ModelAbstract {

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
    protected $Cliente;

    /**
     * @PK
     * @Serial
     * @Column(name=usucodigo)
     */
    protected $codigo;

    /**
     * @Column(name=usulogin)
     */
    protected $login;

    /**
     * @Column(name=ususenha)
     */
    protected $senha;

    /**
     * @Column(name=usuemail)
     */
    protected $email;

    /**
     * @Column(name=usuativo)
     */
    protected $ativo;

    /**
     * @Column(name=usutipo)
     */
    protected $tipo;
    
    /**
     * @Column(name=ususenhaexpiracao)
     */
    protected $senhaExpiracao;
    
    /**
     * @Column(name=usutentativalogin)
     */
    protected $tentativaLogin;

    public function getCliente(){
        if(!isset($this->Cliente)){
            $this->Cliente = new ModelCliente();
        }
        return $this->Cliente;
    }

    public function jsonSerialize(){
        return [
            'codigo'  => $this->getCodigo(),
            'login'   => $this->getLogin(),
            'email'   => $this->getEmail(),
            'ativo'   => $this->getAtivo(),
            'tipo'    => $this->getTipo(),
            'senhaexpiracao' => $this->getSenhaExpiracao(),
            'cliente'        => $this->getCliente()->jsonSerialize()
        ];
    }

}
