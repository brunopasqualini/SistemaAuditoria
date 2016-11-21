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
    
    public static function getDataExpiracaoPadrao(){
        $sDataUs = date('Y/m/d h:i:s');
        return date('d/m/Y h:i:s', strtotime($sDataUs .  ' + 10 days'));
    }
	
    public function jsonSerialize(){
        return [
            'codigo'  => $this->getCodigo(),
            'login'   => $this->getLogin(),
            'email'   => $this->getEmail(),
            'ativo'   => $this->getAtivo(),
            'tipo'    => $this->getTipo(),
            'tentativaLogin' => $this->getTentativaLogin(),
            'ativoString'    => $this->getAtivoString(),
            'tipoString'     => $this->getTipoString(),
            'senhaexpiracao' => $this->getSenhaExpiracao(),
            'senha'          => $this->getSenha(),
            'cliente'        => $this->getCliente()->jsonSerialize()
        ];
    }
    
    public function getTipoString(){
        return $this->tipo == self::TIPO_ADMIN ? 'Administrador' : 'Normal';
    }
    
    public function getAtivoString(){
        return $this->ativo == true ? 'Sim' : 'Não';
    }

}
