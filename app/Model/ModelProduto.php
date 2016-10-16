<?php
namespace App\Model;

/**
 * @Table(name=tbproduto)
 */
class ModelProduto extends ModelAbstract {

    /**
     * @PK
     * @Serial
     * @Column(name=procodigo)
     */
    protected $codigo;

    /**
     * @Column(name=prodescricao)
     */
    protected $descricao;

    /**
     * @Column(name=propreco)
     */
    protected $preco;

    /**
     * @Column(name=proestoque)
     */
    protected $estoque;

    public function jsonSerialize(){
        return [
            'codigo'    => $this->getCodigo(),
            'descricao' => $this->getDescricao(),
            'preco'     => $this->getPreco(),
            'estoque'   => $this->getEstoque()
        ];
    }

}
