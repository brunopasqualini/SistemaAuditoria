<?php
namespace App\Model;

class ModelCliente {

    private $Cidade;

    #PK
    private $codigo;
    private $nome;
    private $endereco;
    private $sexo;
    private $nascimento;
    private $saldoDevedor;
    private $ativo;

    public function getCidade(){
        if(!isset($this->Cidade)){
            $this->Cidade = new ModelCidade();
        }
        return $this->Cidade;
    }

    public function setCidade($cidade){
        $this->Cidade = $cidade;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getSexo(){
        return $this->sexo;
    }

    public function setSexo($sexo){
        $this->sexo = $sexo;
    }

    public function getNascimento(){
        return $this->nascimento;
    }

    public function setNascimento($nascimento){
        $this->nascimento = $nascimento;
    }

    public function getSaldoDevedor(){
        return $this->saldoDevedor;
    }

    public function setSaldoDevedor($saldo){
        $this->saldoDevedor = $saldo;
    }

    public function getAtivo(){
        return $this->ativo;
    }

    public function setAtivo($ativo){
        $this->ativo = $ativo;
    }

}
