<?php
namespace App\Model;

/**
 * @Table(name=tbcidade)
 */
class ModelCidade extends ModelAbstract {

    /**
     * @PK
     * @Column(name=cidcep)
     */
    protected $cep;

    /**
     * @Column(name=cidnome)
     */
    protected $nome;

    /**
     * @Column(name=cidestado)
     */
    protected $estado;

}
