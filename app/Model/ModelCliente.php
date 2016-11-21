<?php
namespace App\Model;

/**
 * @Table(name=tbcliente)
 */
class ModelCliente extends ModelAbstract {
    
    const SEXO_MASCULINO = 1;
    const SEXO_FEMININO = 2;

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

    public function jsonSerialize(){
        return [
            'codigo'       => $this->getCodigo(),
            'nome'         => $this->getNome(),
            'endereco'     => $this->getEndereco(),
            'sexo'         => $this->getSexo(),
            'sexoString'   => $this->getSexoString(),
            'nascimento'   => $this->getNascimento(),
            'saldodevedor' => $this->getSaldoDevedor(),
            'ativo'        => $this->getAtivo(),
            'ativoString'  => $this->getAtivoString(),
            'cidade'       => $this->getCidade()->jsonSerialize()
        ];
    }
    
    public function getSexoString(){
        return $this->sexo == self::SEXO_MASCULINO ? 'Masculino' : 'Feminino';
    }
    
    public function getAtivoString(){
        return $this->ativo == true ? 'Sim' : 'Não';
    }

}