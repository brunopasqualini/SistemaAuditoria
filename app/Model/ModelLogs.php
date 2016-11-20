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
    protected $datahora;

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
    protected $dadoatual;

    /**
     * @Column(name=lbddadoanterior)
     */
    protected $dadoanterior;

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
            'sequencia'     => $this->getSequencia(),
            'datahora'      => $this->getdataHora(),
            'ip'            => $this->getIp(),
            'tabela'        => $this->getTabela(),
            'dadoatual'     => $this->getDadoatual(),
            'dadoaanterior' => $this->getDadoanterior(),
            'descricao'     => $this->getDescricao()
        ];
    }

}