<?php
namespace App\Model;

/**
 * @Table(name=tbcidade)
 */
class ModelCidade {

    /**
     * @PK
     * @Column(name=cidcep)
     */
    private $cep;

    /**
     * @Column(name=cidnome)
     */
    private $nome;

    /**
     * @Column(name=cidestado)
     */
    private $estado;

    public function getCep(){
        return $this->cep;
    }

    public function setCep($sCep){
        $this->cep = $sCep;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($sNome){
        $this->nome = $sNome;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($sEstado){
        $this->estado = $sEstado;
    }

}
