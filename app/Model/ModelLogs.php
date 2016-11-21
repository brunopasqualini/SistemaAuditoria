<?php
namespace App\Model;

/**
 * @Table(name=tblogbd)
 */
class ModelLogs  extends ModelAbstract {
    
    /**
     * @FK
     */
    protected $Usuario;

    /**
     * @PK
     * @Serial
     * @Column(name=lbdsequencia)
     */
    protected $sequencia;

    /**
     * @Column(name=lbddatahora)
     */
    protected $dataHora;

    /**
     * @Column(name=lbdip)
     */
    protected $ip;

    /**
     * @Column(name=lbdtabela)
     */
    protected $tabela;

    /**
     * @Column(name=lbddadoatual)
     */
    protected $dadoAtual;

    /**
     * @Column(name=lbddadoanterior)
     */
    protected $dadoAnterior;

    /**
     * @Column(name=lbddescricao)
     */
    protected $descricao;

    public function getUsuario(){
        if(!isset($this->Usuario)){
            $this->Usuario = new ModelUsuario();
        }
        return $this->Usuario;
    }

    public function jsonSerialize(){
        return [
            'usuario'       => $this->getUsuario(),
            'datahora'      => $this->getDataHora(),
            'ip'            => $this->getIp(),
            'tabela'        => $this->getTabela(),
            'dadoatual'     => $this->getDadoAtual(),
            'dadoanterior'  => $this->getDadoAnterior(),
            'descricao'     => $this->getDescricao()
        ];
    }
    
    protected function logModel($sDescricao, $aDadoAtual, $aDadoAnterior){}

}