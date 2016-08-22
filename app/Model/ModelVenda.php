<?php
class ModelVenda {

    #PK
    private $Cliente;
    #PK
    private $Produto;

    #PK
    private $data;
    private $quantidade;
    private $dataPagamento;
    private $valorPago;

    public function getCliente(){
        if(!isset($this->Cliente)){
            $this->Cliente = new ModelCliente();
        }
        return $this->Cliente;
    }

    public function setCliente($cliente){
        $this->Cliente = $cliente;
    }

    public function getProduto(){
        if(!isset($this->Produto)){
            $this->Produto = new ModelProduto();
        }
        return $this->Produto;
    }

    public function setProduto($produto){
        $this->Produto = $produto;
    }

    public function getData(){
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }

    public function getDataPagamento(){
        return $this->dataPagamento;
    }

    public function setDataPagamento($data){
        $this->dataPagamento = $data;
    }

    public function getValorPago(){
        return $this->valorPago;
    }

    public function setValorPago($valor){
        $this->valorPago = $valor;
    }

}
