<?php
namespace App\Model;

/**
 * @Table(name=tbvenda)
 */
class ModelVenda {

    /**
     * @PK
     * @FK
     */
    private $Cliente;

    /**
     * @PK
     * @FK
     */
    private $Produto;

    /**
     * @PK
     * @Column(name=vendata)
     */
    private $data;

    /**
     * @Column(name=venqtd)
     */
    private $quantidade;

    /**
     * @Column(name=vendtpagto)
     */
    private $dataPagamento;

    /**
     * @Column(name=venvalorpago)
     */
    private $valorPago;

    public function getCliente(){
        if(!isset($this->Cliente)){
            $this->Cliente = new ModelCliente();
        }
        return $this->Cliente;
    }

    public function setCliente($oCliente){
        $this->Cliente = $oCliente;
    }

    public function getProduto(){
        if(!isset($this->Produto)){
            $this->Produto = new ModelProduto();
        }
        return $this->Produto;
    }

    public function setProduto($oProduto){
        $this->Produto = $oProduto;
    }

    public function getData(){
        return $this->data;
    }

    public function setData($sData){
        $this->data = $sData;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setQuantidade($iQuantidade){
        $this->quantidade = $iQuantidade;
    }

    public function getDataPagamento(){
        return $this->dataPagamento;
    }

    public function setDataPagamento($sData){
        $this->dataPagamento = $sData;
    }

    public function getValorPago(){
        return $this->valorPago;
    }

    public function setValorPago($fValor){
        $this->valorPago = $fValor;
    }

}
