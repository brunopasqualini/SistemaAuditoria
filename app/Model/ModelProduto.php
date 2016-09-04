<?php
namespace App\Model;

/**
 * @Table(name=tbproduto)
 */
class ModelProduto {

    /**
     * @PK
     * @Serial
     * @Column(name=procodigo)
     */
    private $codigo;

    /**
     * @Column(name=prodescricao)
     */
    private $descricao;

    /**
     * @Column(name=propreco)
     */
    private $preco;

    /**
     * @Column(name=proestoque)
     */
    private $estoque;

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($iCodigo){
        $this->codigo = $iCodigo;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($sDescricao){
        $this->descricao = $sDescricao;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function setPreco($fPreco){
        $this->preco = $fPreco;
    }

    public function getEstoque(){
        return $this->estoque;
    }

    public function setEstoque($iEstoque){
        $this->estoque = $iEstoque;
    }

}
