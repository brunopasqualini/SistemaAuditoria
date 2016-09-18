<?php
namespace App\Model;

/**
 * @Table(name=tbcliente)
 */
class ModelCliente extends ModelAbstract {

    /**
     * @FK
     */
    protected $Cidade;

    /**
     * @PK
     * @Serial
     * @Column(name=clicodigo)
     */
    protected $codigo;

    /**
     * @Column(name=clinome)
     */
    protected $nome;

    /**
     * @Column(name=cliendereco)
     */
    protected $endereco;

    /**
     * @Column(name=clisexo)
     */
    protected $sexo;

    /**
     * @Column(name=clidtnasc)
     */
    protected $nascimento;

    /**
     * @Column(name=clisaldo)
     */
    protected $saldoDevedor;

    /**
     * @Column(name=cliativo)
     */
    protected $ativo;

    public function getCidade(){
        if(!isset($this->Cidade)){
            $this->Cidade = new ModelCidade();
        }
        return $this->Cidade;
    }

}
