<?php
namespace App\Model;

/**
 * @Table(name=tbcliente)
 */
class ModelCliente {

    /**
     * @FK
     */
    private $Cidade;

    /**
     * @PK
     * @Serial
     * @Column(name=clicodigo)
     */
    private $codigo;

    /**
     * @Column(name=clinome)
     */
    private $nome;

    /**
     * @Column(name=cliendereco)
     */
    private $endereco;

    /**
     * @Column(name=clisexo)
     */
    private $sexo;

    /**
     * @Column(name=clidtnasc)
     */
    private $nascimento;

    /**
     * @Column(name=clisaldo)
     */
    private $saldoDevedor;

    /**
     * @Column(name=cliativo)
     */
    private $ativo;

    public function getCidade(){
        if(!isset($this->Cidade)){
            $this->Cidade = new ModelCidade();
        }
        return $this->Cidade;
    }

    public function setCidade($oCidade){
        $this->Cidade = $oCidade;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($iCodigo){
        $this->codigo = $iCodigo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($sNome){
        $this->nome = $sNome;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($sEndereco){
        $this->endereco = $sEndereco;
    }

    public function getSexo(){
        return $this->sexo;
    }

    public function setSexo($sSexo){
        $this->sexo = $sSexo;
    }

    public function getNascimento(){
        return $this->nascimento;
    }

    public function setNascimento($sNascimento){
        $this->nascimento = $sNascimento;
    }

    public function getSaldoDevedor(){
        return $this->saldoDevedor;
    }

    public function setSaldoDevedor($fSaldo){
        $this->saldoDevedor = $fSaldo;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setAtivo($bAtivo){
        $this->ativo = $bAtivo;
    }

}
