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

}
