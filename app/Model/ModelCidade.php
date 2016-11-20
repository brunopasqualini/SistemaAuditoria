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
    
    public static function getEstados(){
        return [
            'SC' => 'Santa Catarina',
            'AC' => 'Acred',
            'AM' => 'Amazonas',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espirito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mata Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grando do Norte',
            'RS' => 'Rio Grando do Sul',
            'RO' => 'Rondônia',
            'SC' => 'Santa Catarina',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        ];
    }

    public function jsonSerialize(){
        return [
            'cep'    => $this->getCep(),
            'nome'   => $this->getNome(),
            'estado' => $this->getEstado()
        ];
    }

}
