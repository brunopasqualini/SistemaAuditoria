<?php
namespace App\Model;

/**
 * @Table(name=tbvenda)
 */
class ModelVenda extends ModelAbstract {

    /**
     * @PK
     * @FK
     */
    protected $Cliente;

    /**
     * @PK
     * @FK
     */
    protected $Produto;

    /**
     * @PK
     * @Column(name=vendata)
     */
    protected $data;

    /**
     * @Column(name=venqtd)
     */
    protected $quantidade;

    /**
     * @Column(name=vendtpagto)
     */
    protected $dataPagamento;

    /**
     * @Column(name=venvalorpago)
     */
    protected $valorPago;

    public function getCliente(){
        if(!isset($this->Cliente)){
            $this->Cliente = new ModelCliente();
        }
        return $this->Cliente;
    }

    public function getProduto(){
        if(!isset($this->Produto)){
            $this->Produto = new ModelProduto();
        }
        return $this->Produto;
    }

    public function jsonSerialize(){
        return [
            'data'          => $this->getData(),
            'quantidade'    => $this->getQuantidade(),
            'datapagamento' => $this->getDataPagamento(),
            'valorpago'     => $this->getValorPago(),
            'cliente'       => $this->getCliente()->jsonSerialize(),
            'produto'       => $this->getProduto()->jsonSerialize()
        ];
    }

}
