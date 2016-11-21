<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;

class ViewGridVenda extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Histórico de Compra');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridVenda');
        $oGrid->addField(new GridField('produto.descricao', 'Produto'));
        $oGrid->addField(new GridField('valorpago',         'Valor Pago'));
        $oGrid->addField(new GridField('quantidade',        'Quantidade'));
        $oGrid->addField(new GridField('data',              'Data da Venda'));
        $oGrid->addField(new GridField('datapagamento',     'Data do Pagamento'));
        $oGrid->addField(new GridField('cliente.nome',      'Cliente'));
    }

}
