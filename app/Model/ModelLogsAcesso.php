<?php
namespace App\Model;

/**
 * @Table(name=tblogacesso)
 */
class ModelLogsAcesso extends ModelAbstract {
    
    /**
     * @FK
     */
    protected $Usuario;

    /**
     * @PK
     * @Serial
     * @Column(name=acssequencia)
     */
    protected $sequencia;

    /**
     * @Column(name=acsdatahora)
     */
    protected $datahora;

    /**
     * @Column(name=acsip)
     */
    protected $ip;

    /**
     * @Column(name=acsdescricao)
     */
    protected $descricao;
    
    /**
     * @Column(name=acspathapp)
     */
    protected $pathapp;

    public function getUsuario(){
        if(!isset($this->Usuario)){
            $this->Usuario = new ModelUsuario();
        }
        return $this->Usuario;
    }

    public function jsonSerialize(){
        return [
            'usuario'       => $this->getUsuario(),
            'sequencia'     => $this->getSequencia(),
            'datahora'      => $this->getdataHora(),
            'ip'            => $this->getIp(),
            'descricao'     => $this->getDescricao()
        ];
    }

}