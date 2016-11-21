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
    protected $dataHora;

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
    protected $pathApp;

    public function getUsuario(){
        if(!isset($this->Usuario)){
            $this->Usuario = new ModelUsuario();
        }
        return $this->Usuario;
    }

    public function jsonSerialize(){
        return [
            'usuario'   => $this->getUsuario()->jsonSerialize(),
            'datahora'  => $this->getDataHora(),
            'ip'        => $this->getIp(),
            'descricao' => $this->getDescricao(),
            'pathapp'   => $this->getPathApp()
        ];
    }
    
    protected function logModel($sDescricao, $aDadoAtual, $aDadoAnterior){}

}